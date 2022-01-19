@extends('layouts.ctc')

@section('nav_title','トーク')

@section('content')

<head>
    <meta charset="UTF-8">
    <title>チャット</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/newchat.css"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<div class="chat">
    <div id="chat">
        <div v-for="m in messages">
            <template v-if=" m.user_name == 'master' ">
                <span v-text="m.user_name" style="font-size:5px;"></span>
                <div class="message d-flex flex-row align-items-start mb-4">
                <div class="message-icon rounded-circle bg-secondary text-white fs-3">
                    <img src="{{asset('/image/prf_1.jpg')}}" class="prf_img">
                </div><!-- .message-icon -->
                <p class="message-text p-2 ms-2 mb-4" style="background-color: #FFdddd; border-radius:20px; margin-top:5px;">
                    <!-- メッセージ本文 -->
                    <span v-text="m.message"></span>
                </p><!-- .message-text -->
            </template>
            <template v-else>
                <!-- 他人が発言したメッセージ -->
                <template v-if=" m.me_or_you == '0' ">
                    <span v-text="m.user_name" style="font-size:5px;"></span>
                    <div class="message d-flex flex-row align-items-start mb-4">
                    <div class="message-icon rounded-circle bg-secondary text-white fs-3">
                        <img src="{{asset('/image/prf_1.jpg')}}" class="prf_img">
                    </div><!--.message-icon-->
                    <p class="message-text py-2 px-3 ms-2 mb-0" style="background-color: #ecefbc; border-radius:20px; margin-top:5px;">
                        <!-- メッセージ本文 -->
                        <span v-text="m.message"></span>
                    </p><!-- .message-text -->
                </template>
                <!-- 自分が発言したメッセージ -->
                <template v-else>
                    <!-- <span v-text="m.user_name" style="font-size:5px; text-align: right;"></span> -->
                    <div class="message d-flex flex-row-reverse align-items-start mb-4">
                    <!-- <div class="message-icon rounded-circle bg-secondary text-white fs-3">
                    <img src="{{asset('/image/prf_1.jpg')}}" class="prf_img">
                    </div>.message-icon -->
                    <p class="message-text py-2 px-3 me-2 mb-0" style="background-color: #7db9b0; border-radius:20px; margin-top:5px;">
                        <!-- メッセージ本文 -->
                        <span v-text="m.message"></span>
                    </p><!-- .message-text -->
                </template>
            </template>
        </div>
        <div class="d-grid gap-2">
        <textarea v-model="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            <button type="button" class="btn btn-primary" @click="send()">送信</button>
        </div>
    </div>
</div><!-- .chat -->

<div hidden id="capsule_id" value="{{$capsule_id}}"></div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="{{ mix('/js/app.js') }}"></script>
<script>

        new Vue({
            el: '#chat',
            data: {
                message: '',
                messages: [],
                capsule_id: '',

            },
            methods: {
                //message持ってきたい！！
                getMessages() {

                    let element = document.getElementById('capsule_id');
                    this.capsule_id = element.getAttribute('value');
                    const url = '/ajax/chat';
                    //const params = { capsule_id: this.capsule_id }
                    axios.get(url, {
                        params: {
                            // ここにクエリパラメータを指定する
                            capsule_id: this.capsule_id
                        }
                    })
                        .then((response) => {

                            this.messages = response.data;
                            console.log(this.messages);
                            this.capsule_id = '';

                        })
                },
                //保存したい！！
                send() {

                    const url = '/ajax/message_create';
                    const capsule_url = '/ajax/capsule_id_create'
                    let element = document.getElementById('capsule_id');
                    this.capsule_id = element.getAttribute('value');
                    //const params = { message: this.message , capsule_id: this.capsule_id};
                    // axios.get(capsule_url, {
                    //     params: {
                    //         capsule_id: this.capsule_id,
                    //     }
                    // })
                    //     .then((response) => {
                    //         // 成功したらカプセルIDをクリア
                    //         this.capsule_id = '';

                    //     })
                    axios.get(url, {
                        params: {
                            capsule_id: this.capsule_id,
                            message: this.message ,
                        }
                    })
                        .then((response) => {
                            // 成功したらメッセージとをクリア
                            this.message = '';
                            this.capsule_id = '';
                        })

                }
            },
            mounted() {

                this.getMessages();
                //pusherが動くのを待ってる
                window.Echo.channel('chat')
                    .listen('MessageCreated', (e) => {

                        this.getMessages(); // メッセージを再読込

                    });

            }
        });

    </script>
<style>
.prf_img{
	border-radius: 50%;
	width:50px;
	height:50px;
}
</style>
@endsection