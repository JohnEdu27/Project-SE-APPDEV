<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $t) {
            $t->id();
            $t->string('complainant_name')->nullable();
            $t->string('contact')->nullable();
            $t->string('purok')->nullable();
            $t->text('text');
            $t->string('predicted_category')->nullable()->index();
            $t->decimal('confidence', 4, 3)->nullable();
            $t->string('final_category')->nullable()->index(); // set when staff corrects the model
            $t->boolean('needs_review')->default(false);
            $t->enum('status', ['pending', 'in_progress', 'resolved', 'dismissed'])->default('pending')->index();
            $t->text('remarks')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
