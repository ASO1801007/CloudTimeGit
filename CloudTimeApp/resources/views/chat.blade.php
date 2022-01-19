<html>
<body>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

    <div id="chat">
        <textarea v-model="message"></textarea>
        <br>
        <button type="button" @click="send()">送信</button>

        <hr>

        <div v-for="m in messages">
            <!-- メッセージ内容 -->
            <span v-text="m.message"></span>
            <span v-text="m.user_name"></span>
            <span v-text="m.me_or_you"></span>
        </div>

    </div>
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
</body>
</html>