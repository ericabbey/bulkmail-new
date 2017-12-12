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
                            <label for="" class="static">Select your webmail service</label>
                            <select name="" id="">
                                <option value="bank_of_america">Gmail</option>
                                <option value="bank_of_america">Webmail</option>
                            </select>
                        </div>
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
                        <div class="form-group">
                            <label for="host">Host:</label>
                            <input type="text" class="form-control" id="to" tabindex="4" name="host">
                        </div>
                        <div class="form-group">
                            <label for="to">Port:</label>
                            <input type="text" class="form-control" id="port" tabindex="5" name="port">
                        </div>
                        <div class="form-group checkbox">
                            <div class="checkBox">
                                <input type="checkbox" value="None" id="checkBox" name="check"  tabindex="6"/>
                                <label for="checkBox"></label>
                            </div>
                            <div for="">Overwrite with this data</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Popper.js"></script>
    <script src="js/js.cookie.js"></script>
    
    <script>
       $('#next-form').on('click', function(e){
            e.preventDefault(); 
            var form        = $('#setting-form'),
                eleSelect   = form.children().children('select'),
                eleText     = form.children().children('input:not([type="checkbox"])'),
                eleCheckbox = form.children('.checkbox').children('.checkBox').children('#checkBox'),
                errorCount  = 0,
                configData  = [];
            eleText.each(function(index, ele){
                if(ele.value == ''){
                    errorCount += 1;
                }else{
                    var name  = ele.name,
                        value = ele.value;

                    configData.push({
                        name: name,
                        value: value
                    })
                }

            })
            if(errorCount != 6){
                var port  = $('#port'),
                    email = $('#email'),
                    host  = $('#host'),
                    pattern;
                if(port.val() != ''){
                    pattern = /[1-9]{3}/ 
                    if(!pattern.test(port.val())){
                        $('.send-message').addClass('error')
                        $('.send-message').children('p').text('invalid port number')
                        return
                    }
                }
                if(email.val() != ''){
                    pattern = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/
                    if(!pattern.test(email.val())){
                        $('.send-message').addClass('error')
                        $('.send-message').children('p').text('invalid email address')
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
                $('.send-message').addClass('warning')
                $('.send-message').children('p').text('No change is detected')
            }else{
                Cookies.set('config', JSON.stringify(configData), {
                    expires: 1
                });
                $('.send-message').addClass('success')
                $('.send-message').children('p').text('Settings Saved successfully ...')
            }

        })
    </script>

</body>
</html>