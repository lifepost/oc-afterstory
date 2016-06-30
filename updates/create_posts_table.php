<?php namespace Teb\AfterStory\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreatePostsTable extends Migration
{

  public function up()
  {
    Schema::create('teb_afterstory_posts', function($table)
    {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->integer('category_id')->unsigned();
      $table->integer('user_id')->unsigned();
      $table->string('title');
      $table->text('content');
      $table->string('take_period');
      $table->string('daily_dose');
      $table->tinyInteger('is_best');
      $table->dateTime('created_at');
      $table->dateTime('updated_at');
    });
  }

  public function down()
  {
    Schema::dropIfExists('teb_afterstory_posts');
  }

}