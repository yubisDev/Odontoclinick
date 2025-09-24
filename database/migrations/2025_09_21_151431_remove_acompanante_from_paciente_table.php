<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('paciente', function (Blueprint $table) {
        if (Schema::hasColumn('paciente', 'id_acompanante')) {
            $table->dropColumn('id_acompanante');
        }
    });
}

public function down()
{
    Schema::table('paciente', function (Blueprint $table) {
        $table->unsignedBigInteger('id_acompanante')->nullable();
        $table->foreign('id_acompanante')->references('id_acompanante')->on('acompanante');
    });
}


};
