<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enum extends Model
{
    const permission = [
        '0' => '一般使用者',
        '1' => '限閱',
        '2' => '閱讀、新增',
        '3' => '閱讀、新增、編輯',
        '4' => '閱讀、新增、編輯、刪除',
        '5' => '所有權限',
    ];

}
