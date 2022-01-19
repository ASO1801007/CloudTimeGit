@extends('layouts.ctc')

@section('nav_title','　　　　　　　　　トップ')

@section('content')
<head>
    <link rel="stylesheet" href="css/genki.css">
</head>

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div>

    

    <div class="row">
        @foreach($capsule_data as $capsule_data)
            <div class="col-12 col-sm-6 mb-2">
                <a href="/capsule_info/{{$capsule_data->capsule->id}}" class="thum">
                    <img src="{{ $capsule_data->capsule->thumbnail }}" loading="lazy" class="thum__img">
                    <div class="thum__title">
                        {{$capsule_data->capsule->name}}<br>
                        <h6>開封予定日 : {{$capsule_data->open_date_str}}</h6>
                    </div>
                </a>
            </div>
        @endforeach
    </div>



    

    <div class="point_button">
      <a href="capsule_entry" style="color:white;">
        <i class="fa fa-plus" aria-hidden="true"></i>
      </a>
    </div>

</div>

<style>

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


.plus_button {
    width: 50px;
    height: 50px;
    color: #ffffff;
    background-color: #2779ff;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5rem;
    border-radius: 50%;
    cursor: pointer;
}

.point_button {
  position:fixed;
  bottom: 70px;
  right: 30px;
  transition:1s;
  border-radius:100px;
}
/* ホームサムネイル */
</style>

@endsection