<html>
<head>
    <title>top</title>
</head>
<body>
    <h1>トップ</h1>
    @for($i=0; $i<$count; $i++)
        <a href="/capsule/{{$capsule_data[$i]->capsule->id}}">{{ $capsule_data[$i]->capsule->name }}</a><br>
    @endfor
</body>
</html>