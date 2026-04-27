<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->unique()->constrained()->cascadeOnDelete();
            $table->date('return_date');
            $table->integer('late_days')->default(0);
            $table->decimal('fine_amount', 10, 2)->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('returns'); }
};
