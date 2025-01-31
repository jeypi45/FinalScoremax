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
        Schema::create('leagues', function (Blueprint $table) {
            $table->id('LeagueID'); // Primary key
            $table->string('LeagueName'); // Name of the league
            $table->date('StartDate'); // Start date of the league
            $table->date('EndDate')->nullable(); // End date of the league (null if ongoing)
            $table->boolean('IsActive')->default(false);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // User who created the league
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leagues');
    }
};
