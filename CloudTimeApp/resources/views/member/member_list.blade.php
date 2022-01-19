@extends('layouts.ctc')

@section('nav_title')
<div>メンバー({{ count($member_data) }})</div>
@endsection

@section('content')

<div>
    <div class="row">
        @foreach($member_data as $member_data)
            @if($member_data->user_id != 1)
            <div class="col-12 col-sm-6 mb-2">

                <a href="/mypage_info/{{$member_data->user->id}}">
                    <div>
                        <div class="row">
                            <div class="col-2">
                            @if($member_data->user->profile_pic == "0")
                                <img src="/noImage.png" class="list_prf_img">
                            @else
                                <img src="{{$member_data->user->profile_pic}}" class="list_prf_img">
                            @endif
                            </div>
                            <div class="col-10 list_prf_name_flame">
                                <div class="list_prf_name">{{$member_data->user->name}}</div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            @endif
        @endforeach
    </div>

  
</div>

<style>
.list_prf_img{
    border-radius: 50%;
    width:50px;
    height:50px;
}
.list_prf_name_flame{
    padding-top:14px;
}
.list_prf_name{
	font-weight:bold;
    color:#000000;
}
</style>



@endsection