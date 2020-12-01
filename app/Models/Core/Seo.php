<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Seo extends Model implements HasMedia
{
  use HasMediaTrait;

  protected $table = 'seo';

  protected $fillable = [
    'seoable_id',
    'meta_title',
    'meta_description',
    'meta_keywords',
    'og_title',
    'og_description',
    'og_type',
    'twitter_title',
    'twitter_description',
  ];

  /**
   * Booting
   */
  public static function boot()
  {
    parent::boot();

    static::creating(function ($model)
    {
      $model->setSocialTags();
    });

    static::updating(function ($model)
    {
      $model->setSocialTags();
    });
  }

  /**
   * MediaLibrary Config
   */
  public function registerMediaConversions(Media $media = null)
  {
    $this->addMediaConversion('facebook_share')
         ->width(1200)
         ->quality(90)
         ->performOnCollections('facebook_share')
         ->nonQueued();
  }

  /**
   * Relations
   */
  public function seoable()
  {
    return $this->morphTo();
  }

  /**
   * Scopes
   */
  protected function setSocialTags()
  {
    // Set attributes
    $this->attributes['og_title'] = $this->meta_title;
    $this->attributes['og_description'] = $this->meta_description;
    $this->attributes['twitter_title'] = $this->meta_title;
    $this->attributes['twitter_description'] = $this->meta_description;
  }

  /**
   * Accesors
   */
  public function getFacebookImageAttribute()
  {
    $image = $this->getMedia('facebook_share')->first();
    return isset($image) ? $image->getUrl('facebook_share') : asset('/assets/images/facebook.png');
  }
}
