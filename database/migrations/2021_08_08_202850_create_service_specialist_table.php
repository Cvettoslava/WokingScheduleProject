<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSpecialistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_specialist', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specialist_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamps();

            $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_specialist', function(Blueprint $table) {
            $table->dropForeign('service_specialist_service_id_foreign');
            $table->dropForeign('service_specialist_specialist_id_foreign');
        });
        Schema::dropIfExists('service_specialist');
    }
}
