@extends('errors.error')
@section('title','Change browser')
@section('content')
	<div style="font-size: xx-large">Please change your browser !</div><br>
	<div style="font-size: xx-large">This website not allow IE<span class="blink">_</span></div><br>
    <div class="txt">
        <div class='body'>
			<table>
				<tr>
					<td>
						<a target='_blank' href="https://www.google.com.tw/chrome/" rel = "noopener noreferrer">
							<img src="{{ asset('images/icon/google.png') }}">
						</a>
					</td>
					<td>
						<a target='_blank' href="https://www.google.com.tw/chrome/" rel = "noopener noreferrer">
							<h4>Google.Chrome</h4>
						</a>
					</td>
				</tr>
				<tr>
					<td>
						<a target='_blank' href="https://mozilla.com.tw/free-fox/" rel = "noopener noreferrer">
							<img src="{{ asset('images/icon/firefox.png') }}">
						</a>
					</td>
					<td>
						<a target='_blank' href="https://mozilla.com.tw/free-fox/" rel = "noopener noreferrer">
							<h4>Firefox</h4>
						</a>
					</td>
				</tr>
			</table>			
		</div>
    </div>
@endsection    
