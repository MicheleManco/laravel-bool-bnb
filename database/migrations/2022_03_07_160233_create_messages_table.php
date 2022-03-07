<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->string('email'); 
            $table->string('name',60);
            $table->string('surname',60)-> nullable();
            $table->text('text');
            
            $table -> unsignedBigInteger('apartment_id')->nullable();
            $table  -> foreign('apartment_id')
                    -> references('id')
                    -> on('apartments');

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
        Schema::dropIfExists('messages');
    }
}
