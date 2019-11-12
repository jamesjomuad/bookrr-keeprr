<?php namespace Bookrr\Keeprr\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateJobsTable extends Migration
{
    public function up()
    {
        Schema::create('bookrr_keeprr_jobs',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('priority')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookrr_keeprr_jobs');
    }
}
