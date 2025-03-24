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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('type')->comment("1 => Admin 2 => Account Manager 3 => Account Payable 4 => ERO Portal")->after('name');
            $table->string('contact')->after('type')->unique();
            $table->integer('status')->default(1)->comment("1 => active 2 => deactivated")->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
