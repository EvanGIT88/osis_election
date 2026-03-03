<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Pairs;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('osis_candidate_teams', function (Blueprint $table) {
            $table->id();
            $table->text("vision");
            $table->text("mission");
            $table->enum("pair", Pairs::indexArray());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osis_candidate_teams');
    }
};
