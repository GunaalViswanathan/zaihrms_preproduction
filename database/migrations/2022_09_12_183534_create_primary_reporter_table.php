<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimaryReporterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primaryreporters', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id')->unsigned();
            $table->integer('primary_reporter_id')->unsigned();
            $table->timestamps();

            // $table->foreign('emp_id')->references('emp_id')->on('userprofiles')->onDelete('cascade');
            // $table->foreign('primary_reporter_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('primaryreporters', function (Blueprint $table) {
            
        });
    }
}
