<?php namespace Teb\AfterStory\Models;

use Model;

/**
 * Category Model
 */
class Category extends Model
{

  public $table = 'teb_afterstory_categories';

  public $hasMany = [
    'posts' => 'Teb\AfterStory\Models\Post'
  ];
}