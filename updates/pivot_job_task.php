<?php namespace Bookrr\Travelrr\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateBookrrKeeprrJobTaskPivot extends Migration
{
    public function up()
    {
        if(Schema::hasTable('bookrr_keeprr_jobtask_pivot'))
        return;

        Schema::create('bookrr_keeprr_jobtask_pivot', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('job_id');
            $table->integer('task_id');
            $table->primary(['job_id','task_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('bookrr_keeprr_jobtask_pivot');
    }
}