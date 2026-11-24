<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $t) {
            $t->string('predicted_urgency', 10)->nullable()->index()->after('confidence');
            $t->decimal('urgency_confidence', 4, 3)->nullable()->after('predicted_urgency');
            $t->string('final_urgency', 10)->nullable()->after('final_category'); // set when staff corrects it
        });
    }

    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $t) {
            $t->dropColumn(['predicted_urgency', 'urgency_confidence', 'final_urgency']);
        });
    }
};
