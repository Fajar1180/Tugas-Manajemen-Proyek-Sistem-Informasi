<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('fine_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('return_id')->constrained('returns');
            $table->date('pay_date');
            $table->decimal('amount', 10, 2);
            $table->enum('method', ['cash', 'transfer'])->default('cash');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('fine_payments'); }
};
