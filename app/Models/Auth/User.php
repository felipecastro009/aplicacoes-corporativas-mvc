<?php

namespace App\Models\Auth;

use App\Notifications\Budgets\NewAdminBudget;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;
use App\Notifications\Users\Welcome;
use App\Notifications\Users\ResetPasswordNotification;
use App\Notifications\Messages\Message as ContactNotification;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Image\Manipulations;
use App\Models\Franchise\Franchise;

class User extends Authenticatable implements HasMedia
{
  use Notifiable;
  use HasMediaTrait;
  use HasRoles;

  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'phone',
    'password',
    'receive_messages',
    'active',
    'latest_login'
  ];

  protected $hidden = [
    'password',
    'remember_token'
  ];

  protected $casts = [
    'receive_messages' => 'boolean',
    'active' => 'boolean'
  ];

  protected $dates = [
    'created_at',
    'updated_at',
    'latest_login'
  ];

  protected $appends = [
    'full_name'
  ];

  /**
   * MediaLibrary Config
   */
  public function registerMediaConversions(Media $media = null)
  {
    $this->addMediaConversion('photo')
         ->fit(Manipulations::FIT_CROP, 320, 320)
         ->quality(90)
         ->nonQueued();
  }

  /**
   * Notifications
   */
  public function sendWelcomeNotification($user)
  {
    $this->notify(new Welcome($user));
  }

  public function sendPasswordResetNotification($token)
  {
    $this->notify(new ResetPasswordNotification($token, $this));
  }

  public function sendContactNotification($message)
  {
    $this->notify(new ContactNotification($message, $this));
  }

  public function sendNewAdminBudgetNotification($result, $budget)
  {
    $this->notify(new NewAdminBudget($result, $budget));
  }

  /**
   * Scopes
   */
  public function findForPassport($identifier) {
    return $this->orWhere('email', $identifier)->where('active', true)->first();
  }

  public function scopeByRole($query, $roles)
  {
    return $query->with('roles')->whereHas('roles', function ($q) use ($roles) {
                  $q->whereIn('name', $roles);
               });
  }

  public function scopeIsRoot($query, $user) {
    if(!$user->hasRole('root')):
      return $this->whereHas('roles', function($q) {
        $q->where('name', '<>', 'root');
      });
    endif;
  }

  public function scopebyAsc($query)
  {
    return $query->orderBy('first_name', 'ASC');
  }

  public function scopeActive($query)
  {
    return $query->where('active', true);
  }

  /**
   * Relationships
   */
  public function franchises()
  {
    return $this->hasMany(Franchise::class, 'user_id');
  }

  /**
  * Mutators
  */
  public function setEmailAttribute($input)
  {
    if ($input)
      $this->attributes['email'] = mb_strtolower($input, 'UTF-8');
  }

  public function setPhoneAttribute($input)
  {
    if ($input)
      $this->attributes['phone'] = trim(preg_replace('#[^0-9]#', '', $input));
  }

  /**
   * Accesors
   */
  public function getLastLoginAttribute()
  {
    return ($this->latest_login) ? $this->latest_login->diffForHumans() : 'Não efetuou login';
  }

  public function getFullNameAttribute()
  {
    return "{$this->first_name} {$this->last_name}";
  }

  public function getRolesNameAttribute()
  {
    if ($this->roles->count() > 0)
      return "<span class='badge badge-success'>{$this->roles->pluck('details')->implode(', ')}</span>";
  }

  public function getStatusNameAttribute()
  {
    return $this->active ? "<span class='badge badge-primary'>Ativo</span" : "<span class='badge badge-danger'>Desativado</span>";
  }

  public function getPhotoAttribute()
  {
    $image = $this->getMedia('user')->first();
    return isset($image) ? $image->getUrl('photo') : asset('/assets/img/default.png');
  }
}
