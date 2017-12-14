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
                    <div class="mail-title">Settings <i class="fa fa-gears"></i></div>
                    <div class="mail-form">
                        <div class="send-message">
                                <p  class="error-text">This is an error</p>
                            </div>
                        </div>
                    <div class="mail-links">
                        <a href="">
                            <div id="next-form" class="btn-mail orange">
                                <div class="btn-text">Save</div>
                                <div class="btn-icon fa fa-save"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mail-compose">
                    <form action="" methon="post" id="setting-form" class="settings">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" tabindex="1" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" tabindex="2" name="email">
                        </div>
                        <div class="form-group">
                            <label for="pass">Password:</label>
                            <input type="password" class="form-control" id="pass" tabindex="3" name="pass">
                        </div>
                        <div class="form-group checkbox">
                            <div class='switch'>
                                <div class='smtp'>
                                    <input checked id='ssl' name='smtp' type='radio' value='ssl' checked>
                                    <label for='ssl'>ssl</label>
                                </div>
                                <div class='smtp'>
                                    <input id='tls' name='smtp' type='radio' value='tls'>
                                    <label for='tls'>tls</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="mail-footer">
                    <hr>
                    <label id="cloak-file-input" for="senderList">Upload Sender Mail list
                        <input id="senderList" type="file" class="senderlist">
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
    <script>
    $(document).ready(function(){
        console.log('hello')
        if(Cookies.get('senderlist')){
            $('.asf-updater').text('You have some sender list in browser storage')
        }
    })
       $('#next-form').on('click', function(e){
            e.preventDefault(); 
            var form        = $('#setting-form'),
                eleSelect   = form.children().children('select'),
                eleEmail    = form.children().children('input[name="email"]'),
                elePass     = form.children().children('input[name="pass"]'),
                eleName     = form.children().children('input[name="name"]'),
                eleSmtpSsl  = form.find('#ssl'),
                eleCheckbox = form.children('.checkbox').children('.checkBox').children('#checkBox'),
                eleText     = form.children().children('input:not([type="checkbox"])'),

                errorCount  = 0,
                emailData  = [];
                var emailName;
                var set = false;

            eleText.each(function(index, ele){
                if(ele.value == ''){
                    errorCount += 1;
                }
            })
            if(eleEmail.val() != '' && elePass.val() != '') {
                emailData.push({
                    email: eleEmail.val(),
                    password: elePass.val()
                })
            }
            eleSmtp = 'tls'
            if(eleSmtpSsl.prop("checked") == true){
                eleSmtp = 'ssl';
            }
            console.log(eleSmtp)
            if(eleName.val() != ''){
                emailConfig = [{'name' : eleName.val(),
                            'smtp' : eleSmtp
                        }]
            }else{
                message('warning', 'the name field empty')
                return;
            }

            if(errorCount != 6){
                var email = $('#email'),
                    pattern;
                if(email.val() != ''){
                    pattern = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/
                    if(!pattern.test(email.val())){
                        message('error','invalid email address')
                        return
                    }
                }
                // if(host.val() != ''){
                //     pattern = /^([a-zA-Z0-9._%-]+\.[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/
                //     if(!pattern.test(host.val())){
                //         $('.send-message').addClass('error')
                //         $('.send-message').children('p').text('invalid host name')
                //         return
                //     }
                // }


            }
            if(errorCount == 5){
               message('warning', 'No change is detected')
            }else{
                senderlist = emailData;
                if(Cookies.get('senderlist')){
                    JSON.parse(Cookies.get('senderlist')).forEach(function(item){
                        senderlist.push(item)
                    })
                }
                Cookies.set('senders', JSON.stringify(senderlist), {
                    expires: 1
                });
                message('success', 'Settings Saved successfully ...')
                if(emailName != ''){
                    Cookies.set('config', JSON.stringify(emailConfig), {
                    expires: 1
                })
                }
            }
            console.log(Cookies.get('config'))

        })
        function message(code, message){
            $('.send-message').attr('class', 'send-message')
            $('.send-message').addClass(code)
            $('.send-message').children('p').html(message)
        }
    </script>
    <!-- <script>
       var asf = document.getElementById('senderList')
       asf.addEventListener("change", function(){
           // TODO: senderlist checker does not eleminate empty address
        if (this.files || this.files[0]) {
            var myFile = this.files[0];
            var reader = new FileReader();
            var pair = [];
            var senderlist = [];
            var count = 0
            reader.addEventListener('loadend', function () {

                var lines = this.result.split('\n');
                for(var line = 0; line < lines.length; line++){
                    pair = lines[line].split(',')
                    if(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(pair[0]) == false){
                        count += 1
                    }else{
                        senderlist[line] = {
                            email: pair[0],
                            password: pair[1]
                        }
                    }
                }
                $('.asf-updater').text('Successfull saved to config file')
                Cookies.set('senderlist', JSON.stringify(senderlist), {
                    expires: 1
                });
                if(count > 0){
                    content = $('.asf-updater').text()
                    $('.asf-updater').text(content+ ' but ' + count + ' invalid emails detected and removed');
                    $('.asf-updater').css({
                        border: '2px solid slategrey',
                        padding: '15px',
                        backgroundColor: 'rgba(112, 128, 144, 0.37)'
                    })
                }
            });
            reader.readAsText(myFile);
        };
    })
    </script> -->

</body>
</html>