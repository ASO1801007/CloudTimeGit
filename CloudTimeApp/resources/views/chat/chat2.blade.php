<!DOCTYPE html>
<html>

<head>
    <title>Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <style>
        body {
            background-color: #fffffa;
        }

        .footerFixed {
            height: 100%;
            min-height: 100vh;
            position: relative;
            padding-bottom: 120px;
            box-sizing: border-box;
        }

        .h {
            text-align: center;
            background-color: #fcaa92;
        }

        h1 {
            padding: 10px;
            font-size: 2.5rem;
        }

        h2 {
            text-align: center;
            font-size: 1.5rem;
        }

        h3 {
            text-align: center;
            font-size: 1.5rem;
        }

        .fm {
            margin: auto;
        }

        .mes {
            padding: 20px;
            font-size: 3vmin;
            text-align: center;
            font-weight: bold;
        }

        .form_main {
            margin-top: 50px;
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            text-align: center;
            background-color: #ffd9cd;
            padding: 10px;
            white-space: nowrap;
        }

        .formtable {
            border-collapse: separate;
            border-spacing: 0px 50px;
        }

        .btn {
            white-space: nowrap;
        }

        .s {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        footer {
            bottom: 0;
            position: absolute;
            font-size: 2vmin;
            width: 100%;
            text-align: center;
            background-color: #fcaa92;
        }

        .msg_cotainer {
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 10px;
            border-radius: 25px;
            background-color: #82ccdd;
            padding: 10px;
            position: relative;
        }

        .msg_cotainer_send {
            margin-top: auto;
            margin-bottom: auto;
            margin-right: 10px;
            border-radius: 25px;
            background-color: #78e08f;
            padding: 10px;
            position: relative;
        }
    </style>
</head>

<body>
    <div class="footerFixed">
        <div class="form_main s">
            <div class="fm">

            </div>
            <form action="" target="dummyIframe" method="POST" id="form">
                <div class="from_group">
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="/image/scale_b.jpg" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            俺の財布どこや
                            <span class="msg_time">8:40 AM, Today</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            知らないよ、カバンじゃないの
                            <span class="msg_time_send">8:55 AM, Today</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="/image/scale_r.jpg" style="border-radius:50%;" class="rounded-circle user_img_msg">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="/image/scale_b.jpg" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            俺の財布どこや
                            <span class="msg_time">8:40 AM, Today</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            知らないよ、カバンじゃないの
                            <span class="msg_time_send">8:55 AM, Today</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="/image/scale_r.jpg" style="border-radius:50%;" class="rounded-circle user_img_msg">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="/image/scale_b.jpg" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            俺の財布どこや
                            <span class="msg_time">8:40 AM, Today</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            知らないよ、カバンじゃないの
                            <span class="msg_time_send">8:55 AM, Today</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="/image/scale_r.jpg" style="border-radius:50%;" class="rounded-circle user_img_msg">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="/image/scale_b.jpg" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            俺の財布どこや
                            <span class="msg_time">8:40 AM, Today</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            知らないよ、カバンじゃないの
                            <span class="msg_time_send">8:55 AM, Today</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="/image/scale_r.jpg" style="border-radius:50%;" class="rounded-circle user_img_msg">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="/image/scale_b.jpg" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            俺の財布どこや
                            <span class="msg_time">8:40 AM, Today</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            知らないよ、カバンじゃないの
                            <span class="msg_time_send">8:55 AM, Today</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="/image/scale_r.jpg" style="border-radius:50%;" class="rounded-circle user_img_msg">
                        </div>
                    </div>
                    <div>
                        <input type="name" name="entry.2130831075" id="name" placeholder="message"
                             class="form-control" required>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn btn-dark" style="font-size: 1.5rem; font-weight: bold;"
                    onclick="sendGform()" align="center">
                    <!-- onclick="sendGform()"-->
                    送信
                </button>
            </form>
            <iframe name="dummyIframe" style="display:none;"></iframe>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>


</html>