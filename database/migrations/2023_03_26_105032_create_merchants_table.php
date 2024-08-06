<?php

use App\Models\District;
use App\Models\Kota;
use App\Models\Merchant;
use App\Models\MerchantStatus;
use App\Models\Province;
use App\Models\Provinsi;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('merchant_name');
            $table->string('slug');
            $table->string('merchant_address');
            $table->string('merchant_email'); // untuk pemesanan
            $table->string('merchant_phone'); // untuk pemesanan
            $table->integer('poin')->default(180); // 1 poin dikurangi setiap login per hari 1 poin = Rp.500
            $table->integer('rating')->default(0);
            $table->foreignIdFor(User::class,'merchant_owner_id'); // user id owner

            // $table->foreignIdFor(Province::class); // provinsi
           // $table->foreignIdFor(District::class); // kota
           // $table->string('status')->default(Merchant::$STATUS_OPEN); // open,close,inreview,ban
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
};
