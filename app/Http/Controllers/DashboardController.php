<?php 
namespace App\Http\Controllers; 

use App\Models\Product; 
use App\Models\StockTransaction; 
use Illuminate\Support\Facades\DB; 

class DashboardController extends Controller 
{ 
    public function index() 
    { 
        $totalProducts = Product::count(); 
        $totalStock = Product::sum('stock'); 
        $totalStockIn = StockTransaction::where('type', 'masuk')->sum('quantity'); 
        $totalStockOut = StockTransaction::where('type', 'keluar')->sum('quantity'); 
        $lowStockCount = Product::where('stock', '<', 10)->count(); 
        
        $lowStockProducts = Product::with('category') 
            ->where('stock', '<', 10) 
            ->orderBy('stock', 'asc') 
            ->limit(5) 
            ->get(); 
            
        $topMinProducts = Product::with('category') 
            ->where('stock', '<', 10) 
            ->orderBy('stock', 'asc') 
            ->limit(5) 
            ->get(); 
            
        $topMaxProducts = Product::with('category') 
            ->where('stock', '>=', 10) 
            ->orderBy('stock', 'desc') 
            ->limit(5) 
            ->get(); 
        
        $transactions = StockTransaction::with(['product.category', 'user']) 
            ->latest() 
            ->limit(5) 
            ->get(); 
            
        // TAMBAHKAN BARIS INI UNTUK MENGAMBIL SEMUA BARANG
        $products = Product::all();
            
        $monthlyTransactions = StockTransaction::select( 
            DB::raw('DATE(created_at) as date'), 
            DB::raw("SUM(CASE WHEN type = 'masuk' THEN quantity ELSE 0 END) as total_in"), 
            DB::raw("SUM(CASE WHEN type = 'keluar' THEN quantity ELSE 0 END) as total_out") 
        ) 
        ->whereMonth('created_at', now()->month) 
        ->whereYear('created_at', now()->year) 
        ->groupBy(DB::raw('DATE(created_at)')) 
        ->orderBy('date') 
        ->get();

        $chartLabels = $monthlyTransactions->pluck('date')->map(function ($date) {
            return date('d M', strtotime($date));
        })->values();

        $chartIn = $monthlyTransactions->pluck('total_in')->map(function ($value) {
            return (int) $value;
        })->values();

        $chartOut = $monthlyTransactions->pluck('total_out')->map(function ($value) {
            return (int) $value;
        })->values();

        return view('dashboard.index', compact(
            'totalProducts',
            'totalStock',
            'totalStockIn',
            'totalStockOut',
            'lowStockCount',
            'lowStockProducts',
            'topMinProducts',
            'topMaxProducts',
            'transactions',
            'products', // JANGAN LUPA TAMBAHKAN INI
            'chartLabels',
            'chartIn',
            'chartOut'
        ));
    }
}