@extends('_layouts.manage.app')
@section('title',__('Backstage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">功能介紹</div>
                <div class="card-body">
                    <h3>導覽列</h3>
                    <ul>
                        <li>導覽目錄</li>
                        <ol>
                            <li>下拉式選單，無視設定連結。</li>
                            <li>選單內容可以在<mark>選單管理</mark>進行排序設定。</li>
                        </ol>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
