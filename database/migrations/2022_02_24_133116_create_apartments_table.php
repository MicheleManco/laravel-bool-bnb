<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->string('title',100); 
            $table->text('description');
            $table->string('address');
            $table->string('city');
            $table->string('cap');
            $table->integer('sqmeters');
            $table->tinyInteger('rooms');
            $table->tinyInteger('beds');
            $table->tinyInteger('bathrooms');
            $table->integer('price');
            $table->float('latitude');
            $table->float('longitude');
            $table->integer('n_sponsorships');
            
            $table -> unsignedBigInteger('user_id')->nullable();
            $table  -> foreign('user_id')
                    -> references('id')
                    -> on('users');

            $table -> unsignedBigInteger('category_id')->nullable();
            $table  -> foreign('category_id')
                    -> references('id')
                    -> on('categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
