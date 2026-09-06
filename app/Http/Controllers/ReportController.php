<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $query = StockTransaction::with(['product.category', 'user'])

            ->when($type, function ($q) use ($type) {
                $q->where('type', $type);
            })

            ->when($startDate, function ($q) use ($startDate) {
                $q->whereDate('created_at', '>=', $startDate);
            })

            ->when($endDate, function ($q) use ($endDate) {
                $q->whereDate('created_at', '<=', $endDate);
            })

            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc');

        $transactions = $query->get();

        $totalTransactions = $transactions->count();

        $totalIn = $transactions
            ->filter(fn ($item) => strtolower($item->type) === 'masuk')
            ->sum('quantity');

        $totalOut = $transactions
            ->filter(fn ($item) => strtolower($item->type) === 'keluar')
            ->sum('quantity');

        return view('reports.index', compact(
            'transactions',
            'totalTransactions',
            'totalIn',
            'totalOut',
            'type',
            'startDate',
            'endDate'
        ));
    }
}