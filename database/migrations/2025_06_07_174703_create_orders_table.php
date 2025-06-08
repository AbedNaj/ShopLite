<?php

use App\Models\Customer;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(Customer::class)->nullable()->constrained()->nullOnDelete();
            $table->decimal('price', 10, 2);
            $table->decimal('manual_discount', 10, 2)->default(0);
            $table->string('shipping_address');
            $table->enum('status', ['pending', 'confirmed', 'shipped', 'delivered', 'canceled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid', 'failed', 'manual_review'])->default('unpaid');
            $table->string('tracking_number')->nullable();
            $table->string('shipping_company')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
