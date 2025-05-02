<?php

namespace App\Models\SRO\Shard;

use App\Models\SRO\Account\TbUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Char extends Model
{
    use HasFactory;

    /**
     * The Database connection name for the model.
     *
     * @var string
     */
    protected $connection = 'shard';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dbo._Char';

    /**
     * The table primary Key
     *
     * @var string
     */
    protected $primaryKey = 'CharID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CharID',
        'Deleted',
        'RefObjID',
        'CharName16',
        'NickName16',
        'LastLogout',
        'RemainGold'
    ];

    protected $dates = [
        'LastLogout'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public static function getPlayerRanking($limit = 25, $CharID = 0, $CharName = '')
    {
        return Cache::remember("ranking_player_{$limit}_{$CharID}_{$CharName}", now()->addMinutes(config('global.general.cache.data.ranking-player')), function () use ($CharName, $CharID, $limit) {
            return self::select(
                '_Char.CharID',
                '_Char.CharName16',
                '_Char.CurLevel',
                '_Char.RefObjID',
                '_Guild.ID',
                '_Guild.Name',

                '_Char.NickName16',
                '_Char.HwanLevel',
                '_Char.HP',
                '_Char.MP',
                '_Char.Strength',
                '_Char.Intellect',
                '_CharTrijob.JobType',
                '_CharTrijob.Level',

                DB::raw("ISNULL((
                    SUM(ISNULL(_BindingOptionWithItem.nOptValue, 0)) +
                    SUM(ISNULL(_Items.OptLevel, 0)) +
                    SUM(ISNULL(_RefObjCommon.ReqLevel1, 0)) +
                    SUM(ISNULL(CASE WHEN _RefObjCommon.CodeName128 LIKE '%_A_RARE%' THEN 5 ELSE 0 END, 0)) +
                    SUM(ISNULL(CASE WHEN _RefObjCommon.CodeName128 LIKE '%_B_RARE%' THEN 10 ELSE 0 END, 0)) +
                    SUM(ISNULL(CASE WHEN _RefObjCommon.CodeName128 LIKE '%_C_RARE%' THEN 15 ELSE 0 END, 0))
                ), 0) AS ItemPoints"))

                ->join('_Guild', '_Char.GuildID', '=', '_Guild.ID')
                ->join('_Inventory', '_Inventory.CharID', '=', '_Char.CharID')
                ->join('_Items', '_Items.ID64', '=', '_Inventory.ItemID')
                ->join('_RefObjCommon', '_RefObjCommon.ID', '=', '_Items.RefItemID')
                ->leftJoin('_BindingOptionWithItem', function ($join) {
                    $join->on('_BindingOptionWithItem.nItemDBID', '=', '_Items.ID64')
                        ->where('_BindingOptionWithItem.nOptValue', '>', 0)
                        ->where('_BindingOptionWithItem.bOptType', '=', 2);
                })

                ->join('_User', '_User.CharID', '=', '_Char.CharID')
                ->leftJoin('_CharTrijob', function ($join) {
                    $join->on('_CharTrijob.CharID', '=', '_Char.CharID');
                })

                ->where('_Inventory.Slot', '<', 13)
                ->where('_Inventory.Slot', '!=', 8)
                ->where('_Inventory.Slot', '!=', 7)
                ->where('_Inventory.ItemID', '>', 0)
                ->where('_Char.deleted', '=', 0)
                ->when($CharID > 0, function ($query) use ($CharID) {
                    $query->where('_Char.CharID', '=', $CharID);
                })
                ->when(!empty($CharName), function ($query) use ($CharName) {
                    $query->where('_Char.CharName16', 'like', "%{$CharName}%");
                })
                ->whereNotIn('_Char.CharName16', config('global.ranking.hidden_characters'))
                ->groupBy(
                    '_Char.CharID',
                    '_Char.CharName16',
                    '_Char.CurLevel',
                    '_Char.RefObjID',
                    '_Guild.ID',
                    '_Guild.Name',

                    '_Char.NickName16',
                    '_Char.HwanLevel',
                    '_Char.HP',
                    '_Char.MP',
                    '_Char.Strength',
                    '_Char.Intellect',
                    '_CharTrijob.JobType',
                    '_CharTrijob.Level',
                )
                ->orderByDesc('ItemPoints')
                ->orderByDesc('_Char.CurLevel')
                ->limit($limit)
                ->get();
        });
    }

    public static function getCharIDByName($CharName)
    {
        return Cache::remember('character_name_'.$CharName, config('global.general.cache.data.character'), function () use ($CharName) {
            return self::select('CharID')->where('CharName16', $CharName)->first()->CharID ?? null;
        });
    }

    public static function getCharCount()
    {
        return Cache::remember('character_count', config('global.general.cache.data.character'), function () {
            return self::count();
        });
    }

    public static function getGoldSum()
    {
        return Cache::remember('character_gold_sum', config('global.general.cache.data.character'), function () {
            return self::all()->sum('RemainGold');
        });
    }

    public function getGuildMemberUser()
    {
        return $this->hasOne(GuildMember::class, 'CharID', 'CharID');
    }

    public function getGuildUser()
    {
        $query = $this->hasOne(Guild::class, 'ID', 'GuildID');
        $query->where('ID', '!=', 0);
        return $query;
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'CharID', 'CharID');
    }
}
