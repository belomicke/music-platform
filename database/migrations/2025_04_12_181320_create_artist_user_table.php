<?php

declare(strict_types=1);

use App\Models\Artist;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artist_user', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(Artist::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->boolean("is_deleted")
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_user');
    }
};
