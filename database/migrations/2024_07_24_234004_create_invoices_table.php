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
           // $table->string('po_number');
           // $table->string('po_date');
            $table->foreignIdFor(Costumer::class)->nullable();
            $table->foreignIdFor(Meja::class)->nullable();
            $table->string('costumer_name')->nullable();
            $table->text('costumer_address')->nullable();
            $table->foreignIdFor(Merchant::class);
            $table->double('subtotal')->nullable();
            $table->double('percent_tax')->nullable();
            $table->double('tax_amount')->nullable(); // Rp.xxx
            $table->double('percent_amount')->nullable();
            $table->double('discount_amount')->nullable(); //Rp.xxx
            $table->double('total')->nullable();
            $table->string('status_pembayaran')->default('belumlunas');//lunas,belum lunas
            $table->date('tgl_jatuh_tempo')->nullable();
            $table->string('pic')->nullable();
            $table->string('jenis_transaksi')->default('dinein');
            $table->string('metode_pembayaran')->default('cash'); //cash, credit
            $table->timestamps();
            $table->softDeletes();
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
