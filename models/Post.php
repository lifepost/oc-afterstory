<?php namespace Teb\AfterStory\Models;

use Illuminate\Support\Facades\Log;
use Model;

/**
 * Post Model
 */
class Post extends Model
{
  public $table = 'teb_afterstory_posts';

  public $belongsTo = [
    'category' => ['Teb\AfterStory\Models\Category'],
    'user' => ['RainLab\User\Models\User']
  ];

  public $rules = [
    'title'         => 'required|max:2',
    'content'      => 'required',
    'category_id' => 'required',
    'take_period' => 'required',
    'daily_dose' => 'required'
  ];

//  public $hasMany = [
//    'photos' => ['Teb\AfterStory\Models\Photo']
//  ];

//  public $attachMany = [
//    'photos' => 'System\Models\File'
//  ];

  public $hasMany = [ 'photos' => ['Teb\AfterStory\Models\Photo'] ];

  function scopeOwnDisease($query, $string = null)
  {
    if ($string) {
      $query->where('category_id', $string);
    }
    return $query;
  }
}