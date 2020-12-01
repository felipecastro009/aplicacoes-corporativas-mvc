<?php

namespace App\Services\MediaLibrary;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class MediaLibraryPathGenerator implements PathGenerator
{
  /**
   * Get the path for the given media, relative to the root storage path.
   *
   * @param \Spatie\MediaLibrary\Media $media
   *
   * @return string
   */
  public function getPath(Media $media) : string
  {
    return "{$media->collection_name}/{$media->id}/";
  }

  /**
   * Get the path for conversions of the given media, relative to the root storage path.
   *
   * @param \Spatie\MediaLibrary\Media $media
   *
   * @return string
   */
  public function getPathForConversions(Media $media) : string
  {
    return "{$media->collection_name}/{$media->id}/c/";
  }

  /**
   * Get the path for responsive images of the given media, relative to the root storage path.
   *
   * @param \Spatie\MediaLibrary\Models\Media $media
   *
   * @return string
   */
  public function getPathForResponsiveImages(Media $media) : string
  {
    return "{$media->collection_name}/{$media->id}/r/";
  }
}
