<?php

namespace App\Models\SRO\Shard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Guild extends Model
{
    use HasFactory;

    protected $connection = 'shard';

    public $timestamps = false;

    protected $table = 'dbo._Guild';

    protected $primaryKey = 'ID';

    protected $fillable = [];

    protected $dates = [
        'FoundationDate'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public static function getGuildRanking($limit = 25, $GuildID = 0, $Name = '')
    {
        return Cache::remember('ranking_guild_'.$limit.'_'.$GuildID.'_'.$Name, config('global.general.cache.data.ranking-guild'), function () use ($Name, $GuildID, $limit) {
            return self::select(
                '_Guild.ID',
                '_Guild.Name',
                '_Guild.Lvl',
                '_Guild.GatheredSP',
                '_Guild.FoundationDate',
                DB::raw("(SELECT CharID FROM _GuildMember WHERE GuildID = _Guild.ID AND MemberClass = 0) AS LeaderID"),
                DB::raw("(SELECT CharName FROM _GuildMember WHERE GuildID = _Guild.ID AND MemberClass = 0) AS LeaderName"),
                DB::raw("(SELECT COUNT(CharID) FROM _GuildMember WHERE GuildID = _Guild.ID) AS TotalMember"),
                DB::raw("ISNULL((
                    SUM(ISNULL(_BindingOptionWithItem.nOptValue, 0)) +
                    SUM(ISNULL(_Items.OptLevel, 0)) +
                    SUM(ISNULL(_RefObjCommon.ReqLevel1, 0)) +
                    SUM(ISNULL(CASE WHEN _RefObjCommon.CodeName128 LIKE '%_A_RARE%' THEN 5 ELSE 0 END, 0)) +
                    SUM(ISNULL(CASE WHEN _RefObjCommon.CodeName128 LIKE '%_B_RARE%' THEN 10 ELSE 0 END, 0)) +
                    SUM(ISNULL(CASE WHEN _RefObjCommon.CodeName128 LIKE '%_C_RARE%' THEN 15 ELSE 0 END, 0))
                ), 0) AS ItemPoints"))

                ->join('_GuildMember', '_GuildMember.GuildID', '=', '_Guild.ID')
                ->join('_Inventory', '_Inventory.CharID', '=', '_GuildMember.CharID')
                ->join('_Items', '_Items.ID64', '=', '_Inventory.ItemID')
                ->join('_RefObjCommon', '_RefObjCommon.ID', '=', '_Items.RefItemID')
                ->leftJoin('_BindingOptionWithItem', function ($join) {
                    $join->on('_BindingOptionWithItem.nItemDBID', '=', '_Items.ID64')
                        ->where('_BindingOptionWithItem.nOptValue', '>', 0)
                        ->where('_BindingOptionWithItem.bOptType', '=', 2);
                })
                ->where('_Inventory.Slot', '<', 13)
                ->where('_Inventory.Slot', '!=', 8)
                ->where('_Inventory.Slot', '!=', 7)
                ->where('_Inventory.ItemID', '>', 0)
                ->when($GuildID > 0, function ($query) use ($GuildID) {
                    $query->where('_Guild.ID', '=', $GuildID);
                })
                ->when(!empty($Name), function ($query) use ($Name) {
                    $query->where('_Guild.Name', 'like', "%{$Name}%");
                })
                ->whereNotIn('_Guild.Name', config('global.ranking.hidden_guilds'))
                ->groupBy(
                    '_Guild.ID',
                    '_Guild.Name',
                    '_Guild.Lvl',
                    '_Guild.GatheredSP',
                    '_Guild.FoundationDate',
                )
                ->orderByDesc('ItemPoints')
                ->orderByDesc('_Guild.Lvl')
                ->orderByDesc('_Guild.GatheredSP')
                ->limit($limit)
                ->get();

        });
    }

    public static function getFortressGuildRanking($limit = 25)
    {
        return Cache::remember('ranking_fortress_guild_'.$limit, config('global.general.cache.data.ranking_fortress_guild'), function () use ($limit) {
            return self::join('_GuildMember', '_Guild.ID', '=', '_GuildMember.GuildID')
                ->select(
                    '_Guild.ID',
                    '_Guild.Name',
                    DB::raw('(SELECT SUM(GuildWarKill) FROM _GuildMember WHERE GuildID = _Guild.ID) AS TotalKills'),
                    DB::raw('(SELECT SUM(GuildWarKilled) FROM _GuildMember WHERE GuildID = _Guild.ID) AS TotalDeath')
                )
                ->where('_Guild.ID', '>', 0)
                ->groupBy('_Guild.ID', '_Guild.Name')
                ->orderByDesc('TotalKills')
                ->limit($limit)
                ->get();
        });
    }

    public static function getGuildIDByName($GuildName)
    {
        return Cache::remember('guild_name_'.$GuildName, config('global.general.cache.data.guild'), function () use ($GuildName) {
            return self::select('ID')->where('Name', $GuildName)->first()->ID ?? null;
        });
    }

    public static function getGuildInfoAlliance($GuildID)
    {
        return Cache::remember('guild_alliance_'.$GuildID, config('global.general.cache.data.guild'), function () use ($GuildID) {
            return self::where('Alliance', function ($query) use ($GuildID) {
                $query->select('Alliance')
                    ->from('_Guild')
                    ->where('ID', $GuildID)
                    ->where('Alliance', '>', 0);
            })
            ->pluck('Name');
        });
    }
}
