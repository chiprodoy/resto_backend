<?php

use App\Models\Costumer;
use App\Models\Meja;
use App\Models\Merchant;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('invoice_number');
            $table->string('po_number');
            $table->string('po_date');
            $table->foreignIdFor(Costumer::class)->nullable();
            $table->foreignIdFor(Meja::class)->nullable();
            $table->string('costumer_name')->nullable();
            $table->text('costumer_address')->nullable();
            $table->foreignIdFor(Merchant::class);
            $table->double('subtotal');
            $table->double('percent_tax');
            $table->double('tax_amount'); // Rp.xxx
            $table->double('percent_amount');
            $table->double('discount_amount'); //Rp.xxx
            $table->double('total');
            $table->string('paid_status');//lunas,belum lunas
            $table->date('due_date');
            $table->string('pic');
            $table->string('jenis_transaksi')->default('dinein');
            $table->text('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
