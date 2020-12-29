<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

# Facades
use Illuminate\Http\Request;

# Model
use App\Models\Log;

class LogController extends Controller
{
    function index()
    {
        $logs = Log::all();
        return response()->json(['status' => 'success', 'data' => $logs]);
    }
}
