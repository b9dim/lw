<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('cases')->onDelete('cascade');
            $table->string('title');
            $table->text('detail');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_updates');
    }
};

