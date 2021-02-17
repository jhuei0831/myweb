<?php

namespace App\Http\Controllers\api;

# Models
use Auth;
use DB;
use Carbon\Carbon;

# Service
use App\Services\LogService;

# Facades
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

#Request
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function __construct(LogService $log)
    {
        $this->log = $log;
        $this->middleware('permission:product-list', ['only' => ['index']]);
        $this->middleware('permission:product-create', ['only' => ['store']]);
        $this->middleware('permission:product-edit', ['only' => ['show', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $database = Auth::user()->database;
        $products = DB::connection($database)->table('products')->get();
        return response()->json(["status" => "success", "data" => $products], 200);
    }

    public function store(ProductRequest $request)
    {
        $database = Auth::user()->database;
        DB::connection($database)->table('products')->insert([
            'name' => $request->name,
            'detail' => $request->detail,
            'price' => $request->price,
            'unit' => $request->unit ?? '個',
            'discount' => $request->discount,
            'amount' => $request->amount,
            'created_at' => Carbon::now()
        ]);
        $this->log->write_log('products', ['message' => '商品新增成功'], 'create');
        return response()->json(["status" => "success", "message" => "商品新增成功"]);
    }

    /**
     * 查看一筆特定id的商品
     */
    public function show($id)
    {
        $database = Auth::user()->database;
        $product = DB::connection($database)->table('products')->where('id', $id)->get();
        if ($product->isNotEmpty()) {
            return response()->json(["status" => "success", "data" => $product]);
        }
        else {
            return response()->json(["status" => "failed", "message" => "取得商品失敗"], 404);
        }
    }

    /**
     * 更新一筆特定id的商品
     */
    public function update(ProductRequest $request, $id)
    {
        $database = Auth::user()->database;
        $product = DB::connection($database)->table('products')->where('id', $id)->get();
        if ($product->isNotEmpty()) {
            $input = $request->only('name', 'detail', 'price', 'unit', 'discount', 'amount');
            DB::connection($database)->table('products')->where('id', $id)->update([
                'name' => $request->name,
                'detail' => $request->detail,
                'price' => $request->price,
                'unit' => $request->unit,
                'discount' => $request->discount,
                'amount' => $request->amount,
                'updated_at' => Carbon::now(),
            ]);
            $this->log->write_log('products', ['message' => '商品修改成功', 'data' => $input], 'update');
            return response()->json(["status" => "success", "message" => "商品修改成功"]);
        } 
        else {
            return response()->json(["status" => "failed", "message" => "商品修改失敗"], 400);
        }
    }

    /**
     * 刪除一筆特定id的商品
     */
    public function destroy($id)
    {
        $database = Auth::user()->database;
        $product = DB::connection($database)->table('products')->where('id', $id)->get();
        if ($product->isNotEmpty()) {
            DB::connection($database)->table('products')->where('id', $id)->delete();
            $this->log->write_log('products', ['message' => '商品刪除成功', 'data' => $product], 'delete');
            return response()->json(["status" => "success", "message" => '商品刪除成功']);
        } 
        else {
            return response()->json(["status" => "failed", "message" => '商品刪除失敗'], 400);
        }
        
    }
}