<?php namespace Teb\AfterStory\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddOrderNoToPostsTable extends Migration
{

  public function up()
  {
    Schema::table('teb_afterstory_posts', function($table)
    {
      $table->integer('order_no');
    });
  }

  public function down()
  {
    Schema::table('teb_afterstory_posts', function($table)
    {
      $table->dropColumn('order_no');
    });
  }

}