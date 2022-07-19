<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfirmiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infirmiers', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 250);
            $table->string('prenom', 250);
            $table->string('email', 250);
            $table->string('telephone', 250)->nullable();
            $table->string('sexe', 250)->nullable();
            $table->string('category', 250)->nullable();
            $table->string('date_nais', 250)->nullable();
            $table->string('adresse', 250)->nullable();
            $table->string('cv', 250)->nullable();
            $table->string('image', 250)->nullable();
            $table->text('specialite')->nullable();

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
        Schema::dropIfExists('infirmiers');
    }
}
