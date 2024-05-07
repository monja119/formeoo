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
        Schema::create('notications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('contenu');
            $table->string('type');
            $table->string('lien');
            $table->string('date');
            $table->string('heure');
            $table->string('statut');
            $table->string('user_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notications');
    }
};
