<?php namespace Teb\AfterStory\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateCommentsTable extends Migration
{

  public function up()
  {
    Schema::create('teb_afterstory_comments', function($table)
    {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->integer('post_id')->unsigned();
      $table->text('content');
      $table->string('user_id');
      $table->dateTime('created_at');
      $table->dateTime('updated_at');
    });
  }

  public function down()
  {
    Schema::dropIfExists('teb_afterstory_comments');
  }

}