@extends('layouts.ctc')

@section('nav_title','カプセルプロフィール設定')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
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
			新しいタイムカプセルを作成します。情報を入力してください。<br><hr>
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
				<label for="form4">サムネイルを決める</label>
					<div class="md-form">
							<img id="img_prv" src="{{ asset('/noImage.png') }}">
							<input type="file" id="image" name="thumbnail" size="50" maxlength="20" class="form-control" accept=".png,.jpg,.jpeg,image/png,image/jpg">
					</div>
				</div>

				<div class="">
					<button type="submit" class="btn btn-primary btn-block waves-effect">OK</button>
				</div>
			</div>



		</div>

	</form>
</div>


<style>

</style>

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

@endsection
	