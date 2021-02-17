<?php

namespace App\Http\Controllers\api;
# Models
use App\Models\Notice;
use Auth;
use DB;
use Carbon\Carbon;

# Service
use App\Services\LogService;

# Facades
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

#Request
use App\Http\Requests\NoticeRequest;

class NoticeController extends Controller
{
    public function __construct(LogService $log)
    {
        $this->log = $log;
        $this->middleware('permission:notice-list', ['only' => ['index']]);
        $this->middleware('permission:notice-create', ['only' => ['store']]);
        $this->middleware('permission:notice-edit', ['only' => ['show', 'update']]);
        $this->middleware('permission:notice-delete', ['only' => ['destroy']]);
    }

    /**
     * 顯示所有資料
     * 只能看到自己的資料
     */
    public function index()
    {
        $database = Auth::user()->database;
        $notices = DB::connection($database)->table('notices')->orderby('priority', 'ASC')->get();
        return response()->json(["status" => "success", "data" => $notices]);
    }

    /**
     * 新增一筆消息
     */
    public function store(NoticeRequest $request)
    {
        $database = Auth::user()->database;
        DB::connection($database)->table('notices')->insert([
            'priority' => $request->priority, 
            'title' => $request->title,
            'content' => $request->content,
            'created_at' => Carbon::now()
        ]);
        $this->log->write_log('notices', ['message' => '消息新增成功'], 'create');
        return response()->json(["status" => "success", "message" => "消息新增成功"]);
    }

    /**
     * 查看一筆特定id的消息
     */
    public function show($id)
    {
        $database = Auth::user()->database;
        $notice = DB::connection($database)->table('notices')->where('id', $id)->get();
        if ($notice->isNotEmpty()) {
            return response()->json(["status" => "success", "data" => $notice]);
        }
        else {
            return response()->json(["status" => "failed", "message" => "取得消息失敗"], 404);
        }
    }

    /**
     * 更新一筆特定id的消息
     */
    public function update(NoticeRequest $request, $id)
    {
        $database = Auth::user()->database;
        $notice = DB::connection($database)->table('notices')->where('id', $id)->get();

        if ($notice->isNotEmpty()) {
            $input = $request->only('priority', 'title', 'content');
            DB::connection($database)->table('notices')->where('id', $id)->update([
                'priority' => $request->priority, 
                'title' => $request->title,
                'content' => $request->content,
                'updated_at' => Carbon::now()
            ]);
            $this->log->write_log('notices', ['message' => '消息更新成功', 'data' => $input], 'update');
            return response()->json(["status" => "success", "message" => "消息更新成功"]);
        }
        else {
            return response()->json(["status" => "failed", "message" => "消息更新失敗"], 400);
        }
    }

    /**
     * 刪除一筆特定id的消息
     */
    public function destroy($id)
    {
        $database = Auth::user()->database;
        $notice = DB::connection($database)->table('notices')->where('id', $id)->get();
        if ($notice->isNotEmpty()) {
            DB::connection($database)->table('notices')->where('id', $id)->delete();
            $this->log->write_log('notices', ['message' => '消息刪除成功', 'data' => $notice], 'delete');
            return response()->json(["status" => "success", "message" => '消息刪除成功']);
        } else {
            return response()->json(["status" => "failed", "message" => '消息刪除失敗'], 400);
        }
    }
}
