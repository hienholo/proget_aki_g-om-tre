<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenoms');
            $table->string('phone_whatsapp')->unique();
            $table->string('email')->unique();
            $table->string('mot_de_passe');
            $table->string('sexe');
            $table->string('nature_piece');
            $table->string('numero_piece')->nullable();
            $table->string('lieu_edition')->nullable();
            $table->date('date_edition')->nullable();
            $table->date('date_expiration')->nullable();
            $table->string('stucture_de_conception')->nullable();
            $table->json('photo_piece')->nullable()->change();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
