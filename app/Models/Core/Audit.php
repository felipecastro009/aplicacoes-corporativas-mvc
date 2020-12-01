<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Audit as AuditContract;
use OwenIt\Auditing\Audit as AuditTrait;
use Carbon\Carbon;

class Audit extends Model implements AuditContract
{
  use AuditTrait;

  protected $guarded = [];

  protected $casts = [
    'old_values' => 'json',
    'new_values' => 'json'
  ];

  /**
   * Scopes
  */
  public function scopeToday($query)
  {
    $query->whereDate('created_at', Carbon::today());
  }

  /**
   * Accesors
   */
  public function getTypeNameAttribute()
  {
    $auditableType = class_basename($this->auditable_type);

    // Get types
    $types = config('qualitare.audit.types');

    // Return type name
    return isset($types[$auditableType]) ? $types[$auditableType] : 'Indefinido';
  }

  public function getActionNameAttribute()
  {
    // Get actions
    $actions = config('qualitare.audit.actions');

    // Return action name
    return $actions[$this->event];
  }
}
