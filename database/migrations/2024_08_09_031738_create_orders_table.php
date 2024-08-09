<?php

use App\Models\Meja;
use App\Models\Product;
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
            $table->id();
            $table->uuid();
            $table->foreignIdFor(Product::class)->nullable();
            $table->string('item_name');
            $table->string('satuan');
            $table->double('price')->unsigned();
            $table->double('qty')->default(1)->unsigned();
            $table->foreignIdFor(Meja::class);
           // $table->string('nama_waiters');
           // $table->string('nama_koki');
            // $table->dateTime('waktu_pesan');
            // $table->dateTime('waktu_mulai_masak');
            // $table->dateTime('waktu_selesai_masak');
            $table->string('status_order')->default('inorder'); // inorder,cooking,invoice
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
