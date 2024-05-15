<?php
  
namespace App\Models;
  
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
  
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
  
    // protected $guard_name = 'api';
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'contact',
        'city',
        'state',
        'country',
        'license_key',
        'is_approved',
        'is_online',
        'is_license_key_verified',
    ];
     
  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array

     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
        // banho me ajao
        // sapno me kho jao
        // jado ho tum ishq ka
        // mujh pe bhi ho jao
        // nacho phir sar charh k
        // ishq ka jin ho, 
        // be-qabo ho jao
        // yakeen e kamil na kron me
        // kisi peer ki akheer ho jao 
        // waqf e hal ho mera
        // wo muakal ho jao
        // chura k wqt ki qaid se mujhey
        // kisi saif-ul-malook ki dastaan ho jao
        // jado ho tum ishq ka
        // mujh pe bhi ho jao
        // tera sarh jaey shehar quboola
        // ghazal tha kisi ranjhey ki
        // A ishq tum bhi bharko
        // kisi qubooley ki aag ho jao
        // man chah raha hy milney ko
        // ghar matti ho to gharha ho jao
        // jado ho tum ishq ka
        // mujh pe bhi ho jao
        // teer chalaya hy shikari ne
        // hirn k qalb ka samei ho jao
        // kr bethey ho naraz 
        // gar shah anaeyt ko
        // pehan gungroo 
        // aor bhulla ho jao
        // jado ho tum ishq ka
        // mujh pe bhi ho jao
        // 

    /**
     * The attributes that should be cast.
     *
     * @var array

     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public $approved;

    public function songs()
    {
        return $this->hasMany(App\Models\Song::class);
    }
    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }
    public function recentlyPlayed()
    {
        return $this->hasMany(RecentlyPlayed::class, 'user_id');
    }
}

?>
