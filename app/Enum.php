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
