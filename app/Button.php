<?php

namespace App;
use URL;
use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
    	public static function Detail($id)
		{
			echo "<a class='btn btn-sm btn-default' href='detail.php?{$id}'>";
			echo 	"<i class='fas fa-info-circle'></i> 詳細";
			echo "</a>";
		}

		public static function Deleting($id)
		{		
			// $url = URL::full();				
			echo "<button type=\"submmit\" class='btn btn-sm btn-danger btn-delete' onclick=\"return confirm('確認刪除?')\">";
			echo 	"<i class='fas fa-trash-alt'></i> 刪除";
			echo "</button>";		
		}

		public static function Edit($id)
		{
			$url = URL::full();
			echo "<a class='btn btn-sm btn-success' href='{$url}/{$id}/edit'>";
			echo 	"<i class='fas fa-pencil-alt'></i> 修改";
			echo "</a>";
		}

		public static function Create()
		{
			$url = URL::full();
			echo "<a class='btn btn-sm btn-primary' href='{$url}/create'>";
			echo 	"<i class='fas fa-plus'></i> 新增";
			echo "</a>";
		}

		public static function Reset()
		{
			echo "<p class='text-right'>";
			echo	"<a class='btn btn-sm btn-reset btn-danger' href='reset.php'>";
			echo		"<i class='fas fa-undo-alt'></i> 清空資料表";
			echo 	"</a>";
			echo "</p>";
		}

		public static function To($url, $txt, $query="", $class="btn-default")
		{
			echo "<a class='btn btn-sm {$class}' href='{$url}?{$query}'>";
			echo 	"{$txt}";
			echo "</a>";
		}

		public static function GoBack($url = "#")
		{
			$current_url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
			$target_url = ($url) ? $url: URL::previous();
			
			echo "<a class='btn btn-sm btn-default' href='{$target_url}'>";
			echo 	"<i class='fas fa-arrow-left'></i> 上一頁";
			echo "</a>";
		}
}
