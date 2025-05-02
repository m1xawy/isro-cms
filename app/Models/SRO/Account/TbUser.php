<?php

namespace App\Models\SRO\Account;

use App\Models\SRO\Portal\MuUser;
use App\Models\SRO\Shard\Char;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TbUser extends Model
{
    use HasFactory;

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
    protected $table = 'dbo.TB_User';

    /**
     * The table primary Key
     *
     * @var string
     */
    protected $primaryKey = 'JID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'StrUserID',
        'Name',
        'password',
        'Status',
        'GMrank',
        'Email',
        'regtime',
        'reg_ip',
        'sec_primary',
        'sec_content',
        'AccPlayTime',
        'LatestUpdateTime_ToPlayTime'
    ];

    protected $hidden = [
        'password'
    ];

    public static function setGameAccount($username, $password, $email, $ip)
    {
        return self::create([
            'StrUserID' => strtolower($username),
            'Name' => $username,
            'password' => md5($password),
            'Status' => 1,
            'GMrank' => 0,
            'Email' => $email,
            'regtime' => now(),
            'reg_ip' => $ip,
            'sec_primary' => 3,
            'sec_content' => 3
        ]);
    }

    public static function getTbUserCount()
    {
        return Cache::remember('game_account_count', config('global.general.cache.data.account'), function () {
            return self::count();
        });
    }

    public function getSkSilk()
    {
        return $this->belongsTo(SkSilk::class, 'JID', 'JID');
    }

    public function getSkSilkHistory()
    {
        return $this->hasMany(SkSilkBuyList::class, 'UserJID', 'JID');
    }

    public function shardUser()
    {
        return $this->belongsToMany(Char::class, '_User', 'UserJID', 'CharID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'jid', 'JID');
    }
}
