<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('n_views')->unsigned(); 
            $table->bigInteger('n_messages')->unsigned();
            
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
        Schema::dropIfExists('stats');
    }
}
