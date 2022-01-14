@extends('layouts.ctc')

@section('back_button')
<a class="navbar-brand" href="{{route('top.top')}}">＜</a>
@endsection

@section('nav_title','カプセル新規作成')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
		<br>
		<ul type="sqare">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
    </div>
@endif

<head>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>

<div>
	<form action="{{ url('/capsule_create') }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}

		<div class="card_before">
			<div style="color:black;">新しいタイムカプセルを作成します。情報を入力してください。</div><hr>
			<div class="">
				<div class="">
					<div class="md-form">
						<input type="text" id="name" name="name" size="50" maxlength="20" class="form-control" value="新しいカプセル">
						<label for="form1">名前を決める</label>
					</div>
				</div>

				<div class="">
					<div class="md-form amber-textarea active-amber-textarea-2">
						<textarea id="form2" name="intro" class="md-textarea form-control" rows="3">説明</textarea>
						<label for="form2">概要を書く</label>
					</div>
				</div>

				<div class="">
					<div class="md-form">
						<input type="text" id="open_date" name="open_date" size="50" maxlength="20" class="form-control" value="2021-12-31">
						<label for="form3">開封日を決める</label>
					</div>
				</div>

				<div class="">
				<label for="form4" style="color:black;">サムネイルを決める</label>
					<div class="md-form">
							<img id="img_prv" src="{{ asset('/noImage.png') }}">
							<input type="file" id="image" name="thumbnail" size="50" maxlength="20" class="form-control" accept=".png,.jpg,.jpeg,image/png,image/jpg">
					</div>
				</div>

				<div>
					<label style="color:black;"><input type="checkbox" id="" name="map＿" onclick="checkdiv(this,'checkBox')">位置情報を使用する</label>
					<div id="checkBox" class="mb-2" style="display:none;">
						<div class="row">
							<div class="col-12">
								<div class="card p-3">
									<p>住所や駅名、目印などで検索できます。</p>
									<form onsubmit="return false;">
										<div class="form-outline mb-4">
											<label class="form-label" for="entry_code">ワードで検索</label>
											<input type="text" name="entry_code" id="address" class="form-control" value="" />
										</div>
										<input type="button" class="btn-primary btn-block text-center waves-effect p-2" value="検索" id="map_button" style="border-radius:15px;">
									</form>
									<!-- 地図を表示させる要素 -->
									<div class="map_box01 mt-2">
										<div id="map-canvas" style="width: 100%;height: 350px; border-radius:15px; "></div>
									</div>
									
									<p class="mt-2">
										地図上のマーカーをクリックすると<br>
										マーカーを移動できます。
									</p>

									<div hidden>
										緯度 <input type="text" id="lat" name="lat" value=""><br>
										経度 <input type="text" id="lng" name="lng" value=""><br>
									</div>
									
									<!-- APIを取得 -->
									<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANCqtHnmILMQAAIBMx0KLYKRwxZVOu96o&callback=initMap"></script>
									<script src="{{ asset('/js/map.js') }}"></script>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="">
					<button type="submit" class="btn-primary btn-block waves-effect p-3" style="border-radius:15px;">作成する</button>
				</div>

			</div>

		</div>

	</form>
</div>

<script>
//画像が選択される度に、この中の処理が走る
$('#image').on('change', function (ev) {
	//コンソールタブで適切に処理が動いているか確認
	console.log("image is changed");
	//このFileReaderが画像を読み込む上で大切
	const reader = new FileReader();
	//--ファイル名を取得
	const fileName = ev.target.files[0].name;
	//--画像が読み込まれた時の動作を記述
	reader.onload = function (ev) {
		$('#img_prv').attr('src', ev.target.result).css('width', '150px').css('height', '150px');
	}
	reader.readAsDataURL(this.files[0]);
})
</script>

<script type="text/javascript">
function checkdiv( obj,id ) {
if( obj.checked ){
document.getElementById(id).style.display = "block";
}
else {
document.getElementById(id).style.display = "none";
}
}
</script>

<style>
.card{
	background-image: url('/image/scale_r.jpg');
	background-size:cover;
	color:white;
}
</style>

@endsection	