<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enum extends Model
{
    // 帳號權限
    const permission = [
        '0' => '一般使用者',
        '1' => '限閱',
        '2' => '閱讀、新增',
        '3' => '閱讀、新增、編輯',
        '4' => '閱讀、新增、編輯、刪除',
        '5' => '所有權限',
    ];
    // 使用者瀏覽器
    const browser = [
        '0' => 'Internet Explorer',
        '1' => 'Mozilla Firefox',
        '2' => 'Google Chrome',
        '3' => 'Apple Safari',
        '4' => 'Opera',
        '5' => 'Netscape',
    ];
    // 使用者動作
    const action = [
        '0' => 'PUT',
        '1' => 'POST',
        '2' => 'GET',
        '3' => 'DELETE',
        '4' => '排序',
        '5' => '刪除背景',
    ];
    // 資料表
    const table = [
        '0' => 'configs',
        '1' => 'infos',
        '2' => 'logs',
        '3' => 'menus',
        '4' => 'navbars',
        '5' => 'pages', 
        '6' => 'slides', 
        '7' => 'users', 
    ];
    // 是否開放(是=綠勾，否=紅叉)
    const is_open = [
        'color' =>[
            '0' => 'red',
            '1' => 'green',
        ],
        'label'=>[
            '0' => 'times',
    	    '1' => 'check',
        ],
    	
    ];
    // 導覽列類型
    const type =[
    	'navbar' => [
    		'1' => '導覽目錄',
    		'2' => '一般頁面',
    	],
    ];

    const config =[
        'font_family' => [
            'Helvetica, Arial'=>'預設字型',
            'serif' => 'serif',
            'sans-serif' => 'sans-serif',
            'cursive' => 'cursive',
            'fantasy' => 'fantasy',
            'monospace' => 'monospace',
            'MingLiU' => '細明體字型',
            'PMingLiU' => '新細明體字型',
            'DFKai-sb' => '標楷體字型',
            'TwKai' => '臺灣楷體',
            'Microsoft JhengHei' => '微軟正黑體' 
        ],
        'font_weight' => [
            'normal' => '正常 ',
            'bold' => '粗體',
            'bolder' => '比粗體粗',
            'lighter' => '比一般細',
        ],
        'font_size' => [
            'xx-small' => 'xx-small',
            'x-small' => 'x-small',
            'small' => 'small',
            'medium' => 'medium',
            'large' => 'large',
            'x-large' => 'x-large',
            'xx-large' => 'xx-large',
        ],
        'navbar_size' => [
            'xx-small' => 'xx-small',
            'x-small' => 'x-small',
            'small' => 'small',
            'medium' => 'medium',
            'large' => 'large',
            'x-large' => 'x-large',
            'xx-large' => 'xx-large',
        ],
    ];
}
