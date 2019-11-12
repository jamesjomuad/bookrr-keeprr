<?php namespace Bookrr\Keeprr\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('bookrr_keeprr_tasks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->integer('priority');
            $table->text('description')->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->time('time_estimate')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookrr_keeprr_tasks');
    }
}
