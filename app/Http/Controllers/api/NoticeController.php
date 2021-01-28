<?php

namespace App\Http\Controllers\api;
# Models
use App\Models\Notice;
use Auth;

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
        $user_id = Auth::user()->id;
        $notices = Notice::where('user_id', $user_id)->orderby('priority', 'ASC')->get();
        return response()->json(["status" => "success", "data" => $notices]);
    }

    /**
     * 新增一筆消息
     */
    public function store(NoticeRequest $request)
    {
        $user_id = Auth::user()->id;
        $validated = $request->validated();
        if ($validated) {
            $request->request->add(['user_id' => $user_id]);
            Notice::create($request->except('_token', '_method'));
            $this->log->write_log('notices', ['message' => '消息新增成功', 'data' => $input], 'create');
            return response()->json(["status" => "success", "message" => "消息新增成功"]);
        }
        else {
            return response()->json(["status" => "failed", "message" => "消息新增失敗", 400]);
        }
    }

    /**
     * 查看一筆特定id的消息
     */
    public function show($id)
    {
        $user_id = Auth::user()->id;
        $notice = Notice::where('user_id', $user_id)->find($id);
        if ($notice) {
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
        $user_id = Auth::user()->id;
        $notice = Notice::where('user_id', $user_id)->find($id);

        if ($notice) {
            $validated = $request->validated();
            $input = $request->only('priority', 'title', 'content');
            $request->request->add(['user_id' => $user_id]);
            $notice->update($input);
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
        $user_id = Auth::user()->id;
        $notice = Notice::where('user_id', $user_id)->find($id);
        if ($notice) {
            $notice->delete();
            $this->log->write_log('notices', ['message' => '消息刪除成功', 'data' => $notice], 'delete');
            return response()->json(["status" => "success", "message" => '消息刪除成功']);
        } else {
            return response()->json(["status" => "failed", "message" => '消息刪除失敗'], 400);
        }
    }
}
