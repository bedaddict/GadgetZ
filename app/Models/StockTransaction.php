<?php 
namespace App\Models; 
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory; 
 
class StockTransaction extends Model 
{ 
    use HasFactory; 
    const UPDATED_AT = null;

    protected $fillable = ['product_id', 'user_id', 'type', 'quantity', 'stock_after', 'transaction_date', 
        'notes',]; 
 
    protected $casts = [ 
        'transaction_date' => 'date', 
    ]; 
 
    public function product() 
    { 
        return $this->belongsTo(Product::class); 
    } 
 
    public function user() 
    { 
        return $this->belongsTo(User::class); 
    } 
}