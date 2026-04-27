<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->nullable()->unique();
            $table->string('title');
            $table->string('author');
            $table->string('publisher')->nullable();
            $table->integer('year')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('shelf_location')->nullable();
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('books'); }
};
