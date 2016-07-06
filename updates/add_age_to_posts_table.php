<?php namespace Teb\AfterStory\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddAgeToPostsTable extends Migration
{

  public function up()
  {
    Schema::table('teb_afterstory_posts', function($table)
    {
      $table->integer('age');
    });
  }

  public function down()
  {
    Schema::table('teb_afterstory_posts', function($table)
    {
      $table->dropColumn('age');
    });
  }

}