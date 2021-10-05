@extends('layouts.ctc')

@section('content')

<div>

	@if( strcmp($capsuleRow->thumbnail,'noImage.png') == 0)

	<a href="#" class="bard">
		<img src="{{ asset('/sampleImage.png') }}" loading="lazy" class="bard__img">
		<div class="bard__title">
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
	<div class="btn-primary p-1 text-center">
		<form method="POST" action="{{ route('image.index') }}">
		@csrf
		 	<input type = "hidden" name = "capsule_id" value = "{{$capsuleRow->id}}">
			<input type = "submit" name = "add" value="+">
			(＋)<br>
			写真を追加
		</form>
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


.bard {
  display: block;
  position: relative;
  overflow: hidden;
  border-radius: 5px;
}
/* テキストをカード下に固定配置する */
.bard__title {
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
.bard__img {
  display: block;
  width: 100%;
  filter: brightness(70%); /* フィルター */
  transition: 0.3s; /* トランジション */
}
/* カードホバー時 */
.bard:hover .bard__img {
  filter: brightness(150%); /* フィルターを変更 */
  transform: scale(1.3); /* 画像を拡大 */
}


</style>

@endsection
	