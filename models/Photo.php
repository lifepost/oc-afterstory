<?php namespace Teb\AfterStory\Models;

use Model;

/**
 * Photo Model
 */
class Photo extends Model
{

  public $table = 'teb_afterstory_photos';

  public $belongsTo = [
    'post' => ['Teb\AfterStory\Models\Post']
  ];

}