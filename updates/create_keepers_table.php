<?php namespace Bookrr\Keeprr\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateKeepersTable extends Migration
{
    public function up()
    {
        Schema::create('bookrr_keeprr_keepers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookrr_keeprr_keepers');
    }
}
