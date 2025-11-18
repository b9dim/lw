<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('lawyer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('court_name')->nullable();
            $table->enum('status', ['قيد المعالجة', 'قيد المحاكمة', 'منتهية', 'ملغاة'])->default('قيد المعالجة');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};

