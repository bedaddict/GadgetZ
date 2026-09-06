<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Membuat Tabel Kategori
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 100);
            $table->text('description')->nullable(); // <-- Ini tambahan deskripsinya
            $table->timestamps(); // <-- Ini tambahan buat tanggal (created_at & updated_at)
        });

        // 2. Membuat Tabel Produk Aksesori
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('category_id');
            $table->string('name', 150);
            $table->string('code', 100);
            $table->integer('price')->default(0);
            $table->integer('stock')->default(0);
            $table->string('unit', 20)->default('pcs');
            $table->integer('minimum_stock')->default(5);
            $table->timestamps(); // <-- Sekalian ditambahin biar bisa tracking tanggal barang

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });

       // 3. Membuat Tabel Users Sesuai Materi Kuliah (Pakai Email)
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 100);
            $table->string('email', 100)->unique(); 
            $table->string('password', 255);
            $table->enum('role', ['Admin', 'Owner']);
            $table->timestamps(); // <-- Sekalian ditambahin biar user juga ada tanggalnya
        });

        // 4. Membuat Tabel Riwayat Transaksi Stok
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('product_id');
            $table->integer('user_id');
            $table->enum('type', ['Masuk', 'Keluar']);
            $table->integer('quantity');
            $table->text('notes')->nullable();
            $table->timestamps(); // <-- Diganti pakai timestamps standar Laravel

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
        Schema::dropIfExists('users');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};