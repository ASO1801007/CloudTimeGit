@extends('layouts.ctc')

@section('content')

<div>

	@if( strcmp($capsuleRow->thumbnail,'noImage.png') == 0)

	<a href="#" class="thum">
		<img src="{{ asset('/sampleImage.png') }}" loading="lazy" class="thum__img">
		<div class="thum__title">
			{{$capsuleRow->name}}(id:{{$capsuleRow->id}})<br>
			開封予定日 : {{$capsuleRow->open_date_str}}
		</div>
	</a>


	@else
	<img src="{{ asset('/storage/' . $capsuleRow->thumbnail ) }}">
	@endif

	<div><!-- 概要 -->
		{{$capsuleRow->intro}}
	</div>



	<!-- 追加ボタンor開封ボタンの有無 -->

	@if( $open_flag == 1 )
	<div class="btn-warning p-2 text-center">
	<form method="POST" action="{{ route('image.index') }}">
		@csrf
		 	<input type = "hidden" name = "capsule_id" value = "{{$capsuleRow->id}}">
			<input type = "submit" name = "add" value="+">
			開封する
		</form>
	</div>
	@elseif( $open_flag == 0 )
	<div id="modalActivate" class="btn-primary p-1 text-center waves-effect" data-toggle="modal" data-target="#modalPreview0">
		(＋)<br>
		写真を追加
	</div>
	@else
	open_flagの値が適切ではありません。
	@endif

	<!-- 追加ボタンor開封ボタン -->

	チャット
	<div class="card p-3 mt-2">
		最近の投稿<hr>
		有光：おはよう！
	</div>
	<div class="card p-3 mt-2">
		メンバー一覧
	</div>
	<div class="card p-3 mt-2">
		招待コード : {{ $capsuleRow->entry_code }}
	</div>

	<!-- カプセル破棄ボタンの有無 -->

	@if( $admin_flag == 1 )
	<div class="btn-danger p-2 text-center">
		タイムカプセルを破棄
	</div>
	@elseif( $admin_flag == 0 )
	<div class="btn-light p-2 text-center text-white">
		タイムカプセルを破棄
	</div>
	@else
	※admin_flagの値が適切ではありません。※
	@endif

	<!-- カプセル破棄ボタンの有無 -->
</div>

<!-- 思い出追加ポップアップ -->
<form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
    @csrf
	<div class="modal fade right" id="modalPreview0" tabindex="-1" role="dialog" aria-labelledby="modalPreviewLabel0" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h3 class="modal-title" id="modalPreviewLabel0">思い出を追加します</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="padding:40px;">
					<h6 class="pb-2">□写真を選択し、思い出をアップロードしてください。<br></h6>
					<input id="image" type="file" name="image"><br>
					<input type="hidden" name = "capsule_id" value="{{$capsuleRow->id}}">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-block waves-effect">アップロード</button>
				</div>

			</div>
		</div>
	</div>
</form>
<!-- 思い出追加ポップアップ -->





<style>
.thumnail_flame {
	position: relative;/*相対配置*/
}

.thumnail_flame img {
	width:100%;
	object-fit: cover; /* この一行を追加するだけ！ */
}

.thumnail_flame p {
	position: absolute;
	color: white;
	font-weight: bold; /*太字*/
	font-size: 2em;/*サイズ2倍*/
	font-family :Quicksand, sans-serif; /*Google Font*/
	top: 0;
	left: 0;
}


.thum {
  display: block;
  position: relative;
  overflow: hidden;
  border-radius: 5px;
}
/* テキストをカード下に固定配置する */
.thum__title {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 13px;
  text-decoration: none;
  color: #FFF;
  font-weight: bold;
  font-size: 1.6em;
}
.thum__img {
  display: block;
  width: 100%;
  filter: brightness(70%); /* フィルター */
  transition: 0.3s; /* トランジション */
}
/* カードホバー時 */
.thum:hover .thum__img {
  filter: brightness(150%); /* フィルターを変更 */
  transform: scale(1.3); /* 画像を拡大 */
}


</style>

@endsection
	