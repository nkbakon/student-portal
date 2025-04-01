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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->string('name')->nullable();
            $table->date('due_date')->nullable();
            $table->text('zoom')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('youtube')->nullable();
            $table->longText('note')->nullable();
            $table->longText('attachment')->nullable();
            $table->string('file_name')->nullable();
            $table->integer('status')->default(1)->comment("1 => active 2 => deactivated");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
