<?php namespace Teb\AfterStory\Models;

use Model;

/**
 * Comment Model
 */
class Comment extends Model
{

  public $table = 'teb_afterstory_comments';

  public $belongsTo = [
    'post' => ['Teb\AfterStory\Models\Post'],
    'user' => ['RainLab\User\Models\User']
  ];

}