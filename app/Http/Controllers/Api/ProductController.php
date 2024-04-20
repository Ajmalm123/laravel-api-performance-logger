<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        DB::enableQueryLog();
    
        // Start time tracking
        $start = microtime(true);
    
        $request->validate([
            'category_id' => 'required|integer',
        ]);
    
        // Perform database query
        Product::where('category_id', $request->category_id)->get(['id', 'name', 'price']);
        // Product::all();
    
        // End time tracking
        $end = microtime(true);
    
        // Retrieve the executed SQL queries and their execution time
        $queryLog = DB::getQueryLog();
        foreach ($queryLog as $queryInfo) {
            $sql = $queryInfo['query'];
            $bindings = $queryInfo['bindings'];
            $time = $queryInfo['time'];
            // Log or display the SQL query and its execution time
            Log::info("SQL: $sql, Bindings: " . json_encode($bindings) . ", Time: $time ms");
        }
    
        // Calculate the total execution time in seconds
        $totalTime = round($end - $start, 2); // Total execution time in seconds
    
        // Output the total execution time
        Log::info("Total execution time: $totalTime seconds");
    }
}
