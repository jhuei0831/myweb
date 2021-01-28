<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

# Facades
use Illuminate\Http\Request;

# Model
use App\Models\Log;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:log-list', ['only' => ['index', 'detail']]);
    }

    function index()
    {
        $logs = Log::orderby('id', 'DESC')->get();
        return response()->json(['status' => 'success', 'data' => $logs]);
    }

    function detail($id)
    {
        $log = Log::find($id);      
        return response()->json(['status' => 'success', 'data' => $log]);
    }
}
