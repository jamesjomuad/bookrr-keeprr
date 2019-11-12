<?php namespace Bookrr\Keeprr\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateWorksTable extends Migration
{
    public function up()
    {
        Schema::create('bookrr_keeprr_works', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('book_id')->nullable();
            $table->string('title')->nullable();
            $table->integer('priority')->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->timestamp('duration')->nullable();
            $table->timestamp('due')->nullable();
            $table->string('repeat')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('bookmarked')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookrr_keeprr_works');
    }
}
