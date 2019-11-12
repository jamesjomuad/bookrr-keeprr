<?php namespace Bookrr\Travelrr\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateBookrrKeeprrWorkTaskPivot extends Migration
{
    public function up()
    {
        if(Schema::hasTable('bookrr_keeprr_worktask_pivot'))
        return;

        Schema::create('bookrr_keeprr_worktask_pivot', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('work_id')->unsigned();
            $table->integer('task_id')->unsigned();
            $table->primary(['work_id', 'task_id']);
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('status')->nullable();
            $table->integer('priority')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('bookrr_keeprr_worktask_pivot');
    }
}