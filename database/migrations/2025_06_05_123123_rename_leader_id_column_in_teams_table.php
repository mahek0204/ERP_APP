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
        Schema::table('teams', function (Blueprint $table) {
        // First, drop the old foreign key if exists
        $table->dropForeign(['leader_id']); // or 'leader_id' if already renamed

        // Then, rename the column (if needed)
        $table->renameColumn('leader_id', 'team_leader_id');
        });

        Schema::table('teams', function (Blueprint $table) {
        // Now make it nullable and add the new foreign key
        $table->unsignedBigInteger('team_leader_id')->nullable()->change();

        $table->foreign('team_leader_id')
              ->references('id')
              ->on('users')
              ->nullOnDelete(); // important to allow null when user is deleted
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
        $table->dropForeign(['team_leader_id']);
        $table->renameColumn('team_leader_id', 'leader_id');
    });                 

    Schema::table('teams', function (Blueprint $table) {
        $table->unsignedBigInteger('leader_id')->nullable(false)->change();
        $table->foreign('leader_id')->references('id')->on('users')->cascadeOnDelete();
    });
    }
};
