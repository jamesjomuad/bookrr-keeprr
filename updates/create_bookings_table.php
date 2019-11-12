<?php namespace Bookrr\Keeprr\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateKeeprrBookingTable extends Migration
{
    public function up()
    {
        Schema::create('bookrr_keeprr_bookings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('job_id')->nullable();
            $table->string('number')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('num_bedroom')->nullable();
            $table->integer('num_bathroom')->nullable();
            $table->string('status')->nullable();
            $table->string('code')->nullable();
            $table->string('zip')->nullable();
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->string('promo_code')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookrr_keeprr_bookings');
    }
}
