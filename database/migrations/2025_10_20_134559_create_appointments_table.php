<?php

use App\Models\Agent;
use App\Models\Client;
use App\Models\Property;
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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Property::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Agent::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('appointment_date');
            $table->enum('type', ['visite', 'transaction', 'consultation']);
            $table->enum('status', ['enAttente', 'confirme', 'complete', 'annule'])->default('enAttente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};