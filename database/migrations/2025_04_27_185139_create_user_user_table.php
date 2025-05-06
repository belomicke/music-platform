<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("user_user", function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId("followed_user_id")
                ->constrained("users")
                ->cascadeOnUpdate()
                ->cascadeOnUpdate();
            $table
                ->foreignId("following_user_id")
                ->constrained("users")
                ->cascadeOnUpdate()
                ->cascadeOnUpdate();
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
        Schema::dropIfExists("user_user");
    }
};
