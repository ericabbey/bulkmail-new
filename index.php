<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bulk Mailer</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="fonts/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <div class="mail">
        <div class="row header">
            <div class="col-md-6 mx-auto">
                <h1>BulkMailer</h1>
            </div>
        </div>
        <div class="mail-env">
            <?php require 'sidebar.php' ?> 
            <div class="mail_content">
                <div class="mail-header">
                    <div class="mail-title">Compose Mail <i class="fa fa-pencil"></i></div>
                    <div class="mail-form">
                        <div class="send-message">
                                <p  class="error-text">This is an error</p>
                            </div>
                        </div
                    </div>
                    <div class="mail-links">
                        <a href="">
                            <div id="next-form" class="btn-mail blue">
                                <div class="btn-text">next</div>
                                <div class="btn-icon fa fa-angle-right"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mail-compose">
                    <form id="form" action="" methon="post">
                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" class="form-control" id="subject" tabindex="1">
                        </div>
                        <div class="form-group">
                            <div class="compose-message-editor">
                                <textarea name="" id="message-box" class="form-control wysihtml5" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="mail-footer">
                    <hr>
                    <label id="cloak-file-input" for="anti-spam">Select Anti Spam File
                        <input id="anti-spam" type="file" class="antiSpam">
                    </label>
                    <div class="asf-updater">No file selected or in cookies</div>
                </div> -->
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Popper.js"></script>
    <script src="js/js.cookie.js"></script>
    <script src="js/bootstrap3-wysihtml5.min.js"></script>
    <script src="js/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
        $('#message-box').wysihtml5();
    </script>
    <style>
        .wysihtml5-editor{
            background-color: red;
        }
    </style>
    <script>
        $('#next-form').on('click', function(e){
            e.preventDefault(); 
            var form    = $('#form'),
                subject = form.children().children('#subject');
                message = form.children().children().children('#message-box');
            console.log(subject.val())
            if(subject.val() == '' ){
                subject.css('border', '1px solid red');
                $('.send-message').addClass('error')
                $('.send-message').children('p').text('Subject field is empty')
                return
            }else if(message.val() == ''){
                $('.wysihtml5-sandbox').css('border', '1px solid red');
                $('.send-message').addClass('error')
                $('.send-message').children('p').text('Message field is empty')
                return
            }else{
                var content = {
                    'subject': subject.val(),
                    'message': message.val()
                }

                Cookies.set('content', JSON.stringify(content), {
                    expires: 1
                });
                window.location.assign('http://localhost/blkmail/address.php')
            }
        })
    </script>
</body>
</html> 