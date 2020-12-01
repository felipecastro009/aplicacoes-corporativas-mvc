<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class SearchIndex extends Model
{
  protected $table = 'search_index';

  protected $fillable = [
    'searchable_type',
    'searchable_id',
    'data'
  ];

  public function searchable()
  {
    return $this->morphTo();
  }

  public static function formalizeData(array $data)
  {
    $index = [];

    foreach ($data as $key => $value):
      if (is_string($value)):
        $index []= strip_tags(html_entity_decode($value,ENT_COMPAT,'UTF-8'));
      endif;
    endforeach;

    $index = join('. ',$index);
    $index = preg_replace('/[\ ]+/',' ',$index);
    return $index;
  }
}
