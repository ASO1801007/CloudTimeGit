@extends('layouts.ctc')

@section('nav_title','招待コードを使ってカプセルに参加する')

@section('content')


@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
	<hr>
@endif

<div>招待</div>

<!-- 招待カード -->

<div class="school_card card p-4 mb-2">
	<div class="row">
		<form action="{{ url('/entry_search') }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="col-12">
				<div>参加者から教えてもらった6桁の招待コードを入力してください。</div>
				<hr color="#FFFFFF">
				<div class="form-outline mb-4">
					<label class="form-label" for="entry_code">招待コード</label>
					<input type="text" name="entry_code" id="entry_code" class="form-control" value="" />
				</div>
				<input type="submit" class="btn-primary btn-block p-3 text-center waves-effect" style="border-radius:15px;" value="検索"></input>
			</div>
		</form>
	</div>
</div>

<!-- 招待カード -->

@if(isset($search_data))

<div class="row">
@foreach( $search_data as $data)

	<div class="col-12 col-sm-6 mb-2" data-toggle="modal" data-target="#modalPreview1">
		<div class="thum">
			<img src="{{ $data->thumbnail }}" loading="lazy" class="thum__img">
			<div class="thum__title">
				{{$data->name}}(id:{{$data->id}})<br>
				<h6>開封予定日 : {{$data->open_date_str}}</h6>
			</div>
		</div>
	</div>


	<!-- 参加前ポップアップ -->
	<form method="POST" action="{{ url('/entry_commit') }}" enctype="multipart/form-data">
		@csrf
		<input type="hidden" name ="capsule_id" value="{{ $data->id }}">

		<div class="modal fade right" id="modalPreview1" tabindex="-1" role="dialog" aria-labelledby="modalPreviewLabel1" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="modalPreviewLabel1">参加します</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" style="padding:40px;">
						<h6 class="pb-5">□カプセルに参加した場合、参加者に通知されます。<br><br>□参加後は、いつでも脱退することができます。</h6>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn-primary btn-block waves-effect p-3" style="border-radius:15px;">参加する</button>
					</div>
				</div>
			</div>
		</div>

	</form>
	<!-- 参加前ポップアップ- -->


@endforeach
</div>

@endif



<style>

.school_card{
	background-image: url('/image/scale_r.jpg');
	background-size:cover;
	color:white;
}

/* ホームサムネイル */
.thum {
  display: block;
  position: relative;
  overflow: hidden;
  border-radius: 15px;
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
  height: 200px;
  object-fit: cover; /* 縦横比維持 */
  filter: brightness(70%); /* フィルター */
  transition: 0.3s; /* トランジション */
}
/* カードホバー時 */
.thum:hover .thum__img {
  filter: brightness(150%); /* フィルターを変更 */
  transform: scale(1.3); /* 画像を拡大 */
}
/* ホームサムネイル */

</style>

@endsection
	