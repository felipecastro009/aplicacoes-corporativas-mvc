<?php

namespace App\Models\Product;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;

class Category extends Model implements AuditableInterface
{
  use Sluggable, AuditableTrait;

  protected $fillable = [
    'name',
    'slug',
    'description',
    'active',
    'user_id'
  ];

  protected $casts = [
    'active'
  ];

  /**
   * Auditable Config
   */
  protected $auditInclude = [
    'name',
    'slug',
    'description',
    'active',
    'user_id'
  ];

  /**
   * Return the sluggable configuration array for this model.
   *
   * @return array
   */
  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'name'
      ]
    ];
  }

  /**
   * Scopes
   */
  public function scopeActive($query)
  {
    $query->whereActive(true);
  }

  public function scopeAsc($query)
  {
    $query->orderBy('name', 'ASC');
  }

  /**
   * Relationships
   */
  public function products()
  {
    return $this->hasMany(Product::class, 'category_id');
  }

  /**
   * Accessors
   */
  public function getReferenceAttribute()
  {
    return str_pad($this->id, 5, '0', STR_PAD_LEFT);
  }
}
