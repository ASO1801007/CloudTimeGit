
        if( navigator.geolocation ){// 現在位置を取得できる場合の処理
            // 現在位置を取得する
            navigator.geolocation.getCurrentPosition( success, error, option);
            /*現在位置が取得できた時に実行*/
            function success(position){
                var data = position.coords;
                // 必要な緯度経度だけ取得
                var lat = data.latitude;
                var lng = data.longitude;
                //Google Mapsで住所を取得
                var geocoder = new google.maps.Geocoder();
                latlng = new google.maps.LatLng(lat, lng);
                geocoder.geocode({'latLng': latlng}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        document.getElementById('lat').value = lat;
                        document.getElementById('lng').value = lng;
                        alert("カプセルを開封できるよ");
                        }
                    else {
                    alert("エラー" + status);
                    }
                });
            }
            /*現在位置の取得に失敗した時に実行*/
            function error(error){
                var errorMessage = {
                    0: "原因不明のエラーが発生しました。",
                    1: "位置情報が許可されませんでした。",
                    2: "位置情報が取得できませんでした。",
                    3: "タイムアウトしました。",
                } ;
                //とりあえずalert
                alert( errorMessage[error.code]);
            }
            // オプション(省略可)
            var option = {
                "enableHighAccuracy": false,
                "timeout": 100 ,
                "maximumAge": 100 ,
            } ;
    } else {// 現在位置を取得できない場合の処理
        //とりあえずalert
        alert("あなたの端末では、現在位置を取得できません。");
        }
    