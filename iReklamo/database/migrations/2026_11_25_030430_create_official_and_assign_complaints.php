<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('officials', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('position');
            $t->string('contact', 50)->nullable();
            $t->json('categories');
            $t->boolean('is_active')->default(true);
            $t->boolean('is_default')->default(false);
            $t->timestamps();
        });

        Schema::table('complaints', function (Blueprint $t) {
            $t->foreignId('assigned_official_id')->nullable()
              ->constrained('officials')->nullOnDelete();
            $t->timestamp('assigned_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $t) {
            $t->dropConstrainedForeignId('assigned_official_id');
            $t->dropColumn('assigned_at');
        });
        Schema::dropIfExists('officials');
    }
};