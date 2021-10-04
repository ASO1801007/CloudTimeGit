@if( $open_flg == 0)
    <form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
    @csrf
        <input id="image" type="file" name="image">
        <input type="hidden" name = "capsule_id" value={{$capsule_id}}>
        <button type="submit">
        アップロード
        </button>
    </form>
@endif

@if( $open_flg == 1)
    @foreach($images as $image)
        <div>
            <img src="{{ $image->image }}" alt="image" style="width: 30%; height: auto;"/>
        </div>
    @endforeach
@endif