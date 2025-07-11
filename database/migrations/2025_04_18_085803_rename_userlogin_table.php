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
        if (Schema::hasTable('userlogin') && !Schema::hasTable('users')) {
            Schema::rename('userlogin', 'users');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users') && !Schema::hasTable('userlogin')) {
            Schema::rename('users', 'userlogin');
        }
    }
};
