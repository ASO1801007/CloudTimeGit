@extends('layouts.ctc')

@section('back_button')
<a class="navbar-brand" href="javascript:history.back();">＜</a>
@endsection

@section('nav_title')
<div>メンバー選択</div>
@endsection

@section('content')

<div>
    <form method="POST" action="{{ route('member.member_update') }}">
        @csrf
        <input type = "hidden" name = "capsule_id" value = "{{ $capsule_data->id }}">
        <div class="row">
            @foreach($user_data as $user_data)
                <div class="col-12 col-sm-6 mb-2 text-center">
                    <label>
                        <div class="row">
                            <div class="col-2">
                                <img src="{{$user_data->profile_pic}}" class="list_prf_img">
                            </div>
                            <div class="col-8 list_prf_name_flame">
                                <div class="list_prf_name">{{$user_data->name}}(ID:{{$user_data->id}})</div>
                            </div>
                            <div class="col-2 pt-3">
                                <input type="checkbox" id="member_check" name="user_id[]" class="" value="{{$user_data->id}}">
                            </div>
                        </div>
                    </label>
                </div>
            @endforeach
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">っっっっっっ</button>
        </div>
    </form>
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
}
label{
    padding-right:0;
    padding-left:0;
    margin-right:0;
    margin-left:0;
}
</style>



@endsection