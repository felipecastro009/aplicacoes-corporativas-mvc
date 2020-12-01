<?php

namespace App\Models\Product;

use Cknow\Money\Money;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;

class Product extends Model implements AuditableInterface
{
  use Sluggable, AuditableTrait;

  protected $fillable = [
    'name',
    'slug',
    'price',
    'description',
    'active',
    'category_id',
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
    'price',
    'description',
    'active',
    'category_id',
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
  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id');
  }

  /**
   * Mutators
   */
  public function setPriceAttribute($value)
  {
    $this->attributes['price'] = ($value != null) ? str_replace(['.', ','], ['', '.'], $value) : null;
  }

  /**
   * Accessors
   */
  public function getReferenceAttribute()
  {
    return str_pad($this->id, 5, '0', STR_PAD_LEFT);
  }

  public function getPriceBrAttribute()
  {
      return Money::parseByDecimal($this->price, 'BRL')->formatSimple();
  }

}
