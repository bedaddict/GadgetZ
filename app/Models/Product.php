<?php 
namespace App\Models; 
use Illuminate\Database\Eloquent\Model; 

class Product extends Model 
{ 
    // MATIKAN FITUR WAKTU OTOMATIS DI SINI
    public $timestamps = false;

    protected $fillable = ['category_id', 'code', 'name', 'unit', 'stock', 'minimum_stock', 'description']; 

    public function category() 
    { 
        return $this->belongsTo(Category::class); 
    } 

    public function stockTransactions() 
    { 
        return $this->hasMany(StockTransaction::class); 
    } 

    // RUMUS STATUS PERSEDIAAN BARU
    public function getStockStatusAttribute() 
    { 
        if ($this->stock > 5) {
            return 'Tersedia';
        } elseif ($this->stock < 5) {
            return 'Tidak Tersedia';
        } else {
            return 'Warning';
        }
    } 
}