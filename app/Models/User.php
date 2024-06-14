<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    public function consejosReaccionados()
    {
        return $this->belongsToMany(Consejo::class, 'reaccion_usuarios', 'id_usuario', 'id_consejo')
            ->withPivot('reaccion')
            ->withTimestamps();
    }
    public function consejosLikes()
    {
        return $this->belongsToMany(Consejo::class, 'reaccion_usuarios', 'id_usuario', 'id_consejo')
            ->withPivot('reaccion')
            ->wherePivot('reaccion', true); 
    }
    public function profesores()
    {
        return $this->belongsToMany(Profesor::class, 'profesor_like', 'id_usuario', 'id_profesor')->withTimestamps();
    }
    public function favoritos()
    {
        return $this->belongsToMany(Consejo::class, 'favoritos', 'id_usuario', 'id_consejo')->withTimestamps();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'avatar_path'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
