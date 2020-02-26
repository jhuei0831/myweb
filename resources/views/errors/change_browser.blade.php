@php 

	$root = '../';
	$page_title = '請更新您的瀏覽器';
@endphp
<!DOCTYPE html>
<html>
	<head>
		<style>
			.header{
				margin: 2.5%;
			}
			.body{
				margin: 1.5%;
			}
			.footer{
				margin: 1.5%;
			}
			img{
				border:0;
			}
		</style>
	</head>
	<body>
		<center>
			<div class='header'>
				<h2><font color='red'>您的瀏覽器版本過舊</font></h2>
				<h3>為了安全的報名參加<br>請您安裝版本較新的瀏覽器，並使用新的瀏覽器瀏覽本站</h3>
				<p>建議瀏覽器如下（點擊後將重新導向至下載頁面）</p>
				<h1>Little Master Mandarin Camp</h1>
				<h2><font color='red'>Please change your browser, thanks !</font></h2>
			</div>
			<hr>
			<div class='body'>
				<table>
					<tr>
						<td>
							<a target='_blank' href="https://www.google.com.tw/chrome/" rel = "noopener noreferrer">
								<!-- <img src='icon/browser_google_chrome.png'> -->
							</a>
						</td>
						<td>
							<a target='_blank' href="https://www.google.com.tw/chrome/" rel = "noopener noreferrer">
								<h2>Google Chrome</h2>
							</a>
						</td>
					</tr>
					<tr>
						<td>
							<a target='_blank' href="https://mozilla.com.tw/free-fox/" rel = "noopener noreferrer">
								<!-- <img src='icon/browser_firefox.png'> -->
							</a>
						</td>
						<td>
							<a target='_blank' href="https://mozilla.com.tw/free-fox/" rel = "noopener noreferrer">
								<h2>Firefox</h2>
							</a>
						</td>
					</tr>
				</table>
			</div>
			<hr>
			<div class='footer'>
				<table>
					<tr>
						<td align="right">國立臺灣師範大學</td>
						<td align="left">進修推廣學院</td>
					</tr>
					<tr>
						<td align="right">地址：</td>
						<td align="left">10610 臺北市大安區和平東路一段162號</td>
					</tr>
					<tr>
						<td align="right">服務時間：</td>
						<td align="left">星期一至星期五 上午 9 時 至 下午 5 時</td>
					</tr>
				</table>
			</div>
		</center>
	</body>
</html>