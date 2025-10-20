<?php
use App\Models\User;
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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['apartement', 'villa', 'terrain', 'immeuble']);
            $table->enum('usage', ['residence', 'commercial', 'bureau', 'agriculture', 'industriel']);
            $table->enum('option', ['vente', 'location']);
            $table->decimal('prix');
            $table->decimal('surface');
            $table->string('pays');
            $table->string('ville');
            $table->enum('status', ['disponible', 'indisponible'])->default('disponible');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};