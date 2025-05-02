<?php

namespace App\Models\SRO\Shard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CharTrijob extends Model
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
    protected $table = 'dbo._CharTrijob';

    public static function getJobRanking($limit = 25, $type = 0)
    {
        return Cache::remember("ranking_job_{$limit}_{$type}", now()->addMinutes(config('global.general.cache.data.ranking_job')), function () use ($type, $limit) {
            return self::join('_Char', '_Char.CharID', '=', '_CharTrijob.CharID')
                ->join('_User', '_User.CharID', '=', '_Char.CharID')
                ->select(
                    '_Char.CharID',
                    '_Char.CharName16',
                    '_Char.NickName16',
                    '_Char.RefObjID',
                    '_CharTrijob.JobType',
                    '_CharTrijob.Level',
                    '_CharTrijob.Exp',
                )
                ->where('_Char.deleted', 0)
                ->where('_Char.CharID', '>', 0)
                ->where('_CharTrijob.JobType', '!=', 0)
                ->when($type > 0, function ($query) use ($type) {
                    $query->where('_CharTrijob.JobType', '=', $type);
                })
                ->orderByDesc('_CharTrijob.Exp')
                ->limit($limit)
                ->get();
        });
    }
}
