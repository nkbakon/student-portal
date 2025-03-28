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
            $table->string('district')->nullable()->after('email');
            $table->text('address')->nullable()->after('district');
            $table->string('parent_name')->nullable()->after('address');
            $table->string('parent_contact')->nullable()->after('parent_name');
            $table->string('parent_name2')->nullable()->after('parent_contact');
            $table->string('parent_contact2')->nullable()->after('parent_name2');
            $table->integer('exam')->comment("1 => O/L 2 => A/L 3 => Other")->nullable()->after('parent_contact2');
            $table->date('dob')->nullable()->after('exam');
            $table->integer('gender')->comment("1 => Male 2 => Female 3 => Other")->nullable()->after('dob');
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
