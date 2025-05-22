<?php

use App\Models\Artist;
use App\Models\Track;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artist_track', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignIdFor(Artist::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(Track::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_track');
    }
};
