<?php

namespace App;
use URL;
use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
    	public static function Detail($id)
		{
			$url = URL::full();
			echo "<button type=\"submmit\" class='btn btn-sm btn-secondary'>";
			echo 	"<i class='fas fa-info-circle'></i> ".__('Detail');
			echo "</a>";
		}

		public static function Deleting($id)
		{		
			// $url = URL::full();				
			echo "<button type=\"submmit\" class='btn btn-sm btn-danger btn-delete' onclick=\"return confirm('確認刪除?')\">";
			echo 	"<i class='fas fa-trash-alt'></i> ".__('Delete');
			echo "</button>";		
		}

		public static function Edit($id)
		{
			$url = URL::full();
			echo "<a class='btn btn-sm btn-success' href='{$url}/{$id}/edit'>";
			echo 	"<i class='fas fa-pencil-alt'></i> ".__('Edit');
			echo "</a>";
		}

		public static function Create()
		{
			$url = URL::full();
			echo "<a class='btn btn-sm btn-primary' href='{$url}/create'>";
			echo 	"<i class='fas fa-plus'></i> ".__('Create');
			echo "</a>";
		}

		public static function Reset()
		{
			echo "<p class='text-right'>";
			echo	"<a class='btn btn-sm btn-reset btn-danger' href='reset.php'>";
			echo		"<i class='fas fa-undo-alt'></i> ".__('Reset');
			echo 	"</a>";
			echo "</p>";
		}

		public static function To($to, $txt, $query="", $class="btn-secondary", $fas="list-ol", $confirm=false)
		{
			$url = URL::full();
			if ($confirm == true) {
				$confirm = 'onclick="return confirm(\'確認刪除?\')"';
			}
			echo "<a class='btn btn-sm {$class}' href='{$url}/{$to}/{$query}' {$confirm}>";
			echo 	"<i class='fas fa-{$fas}'></i> {$txt}";
			echo "</a>";
		}

		public static function GoBack($url = "#")
		{
			$current_url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
			$target_url = ($url) ? $url: URL::previous();
			
			echo "<a class='btn btn-sm btn-default' href='{$target_url}'>";
			echo 	"<i class='fas fa-arrow-left'></i> ".__('Previous');
			echo "</a>";
		}
}
