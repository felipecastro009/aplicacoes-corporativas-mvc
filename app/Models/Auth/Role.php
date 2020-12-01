<?php

namespace App\Models\Auth;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
  protected $fillable = [
    'name',
    'details',
    'guard_name'
  ];

  /**
   * Scopes
   */
  public function scopeByUser($query, $currentUser)
  {
    // Select
    $query->orderBy('id', 'ASC');

    // If user in role root
    if(!$currentUser->hasRole('root')):
      if ($currentUser->hasRole('gestor')):
        $query->where('name', '!=', 'root');
      // If user other roles
      else:
        $query->whereNotIn('name', ['root', 'gestor']);
      endif;
    endif;

    return $query;
  }

  public function scopeFindByName($query, $name)
  {
    return $query->where('name', $name);
  }
}
