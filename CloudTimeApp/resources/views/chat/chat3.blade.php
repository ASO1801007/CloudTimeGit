<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>福岡県乳幼児視聴覚支援センター オンデマンド講習会</title>

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!--Font Awesome5-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/chat.css">
</head>

<body>
    <div class="footerFixed">
        <div class="container-fluid ">
            <div class="row">
                <div class="form_main s col-12">
                    <div class="fm">
                        <form action="" target="dummyIframe" method="POST" id="form">
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="/image/scale_b.jpg" class="rounded-circle user_img_msg">
                                </div>
                                <div class="msg_cotainer">
                                    俺の財布どこや
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    知らないよ、カバンじゃないの
                                </div>
                                <div class="img_cont_msg">
                                    <img src="/image/scale_r.jpg" style="border-radius:50%;" class="rounded-circle user_img_msg">
                                </div>
                            </div>
                        </form>
                        <iframe name="dummyIframe" style="display:none;"></iframe>
                    </div>
                </div>
            </div>
        </div><!-- /container -->
        <footer>
            <div class="card-footer">
                <div class="input-group">
                    <div class="input-group-append">
                        <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                    </div>
                    <textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
                    <div class="input-group-append">
                        <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#form').submit(function(event) {
                var formData = $('#form').serialize();
                $.ajax({
                    url: "https://docs.google.com/forms/u/0/d/e/1FAIpQLSfLrpF_7_3FLZogxsdWPJGSMdygfsJdlI3PcGJa3O5SBgkDNg/formResponse",
                    data: formData,
                    type: "POST",
                    dataType: "xml",
                    statusCode: {
                        0: function() {
                            alert("回答ありがとうございます。");
                            location.href = 'https://live-tv.co.jp/fukuoka.med_vod/choukaku-2022.html';
                        },
                        200: function() {
                            alert("エラーが発生しました。もう一度入力してください");
                        }
                    }
                });
            });

        });
    </script>
</body>
</html>