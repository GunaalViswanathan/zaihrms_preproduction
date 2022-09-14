<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItdeclarationDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itdeclaration_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('itdeclaration_id')->unsigned();
            $table->string('filename')->nullable();
            $table->timestamps();
            $table->foreign('itdeclaration_id')
                ->references('id')
                ->on('itdeclarations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itdeclaration_documents');
    }
}
