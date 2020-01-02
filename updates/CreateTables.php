<?php namespace BlackScorp\OctoberTopicVoter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        Schema::create('october_topics', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->index();
            $table->text('text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('october_topics');
    }
}