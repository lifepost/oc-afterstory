<?php namespace Teb\AfterStory\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreatePhotosTable extends Migration
{

  public function up()
  {
    Schema::create('teb_afterstory_photos', function($table)
    {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->integer('post_id')->unsigned();
      $table->string('path');
      $table->string('filename');
      $table->dateTime('created_at');
      $table->dateTime('updated_at');
    });
  }

  public function down()
  {
    Schema::dropIfExists('teb_afterstory_photos');
  }

}