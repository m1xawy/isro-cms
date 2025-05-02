<?php

namespace App\Models\SRO\Account;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ItemNameDesc extends Model
{
    /**
     * The Database connection name for the model.
     *
     * @var string
     */
    protected $connection = 'account';

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
    protected $table = 'dbo._ItemNameDesc';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Service',
        'ID',
        'StrID',
        'KOR',
        'UNK0',
        'UNK1',
        'UNK2',
        'UNK3',
        'VNM',
        'ENG',
        'UNK4',
        'UNK5',
        'UNK6',
        'TUR',
        'ARA',
        'ESP',
        'GER'
    ];

    public static function getItemRealName($CodeName128): string
    {
        return Cache::remember('ItemNameDesc_'.$CodeName128, now()->addMinutes(config('global.general.cache.data.character_items')), static function () use ($CodeName128) {
            return self::select('ENG')->where('StrID', $CodeName128)->first()->ENG ?? $CodeName128;
        });
    }
}
