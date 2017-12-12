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
                            <label for="to">Name:</label>
                            <input type="text" class="form-control" id="to" tabindex="1" name="name">
                        </div>
                        <div class="form-group">
                            <label for="to">Email:</label>
                            <input type="email" class="form-control" id="to" tabindex="2" name="email">
                        </div>
                        <div class="form-group">
                            <label for="to">Password:</label>
                            <input type="password" class="form-control" id="to" tabindex="3" name="pass">
                        </div>
                        <div class="form-group">
                            <label for="to">Host:</label>
                            <input type="text" class="form-control" id="to" tabindex="4" name="host">
                        </div>
                        <div class="form-group">
                            <label for="to">Port:</label>
                            <input type="text" class="form-control" id="to" tabindex="5" name="port">
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
                    ele.style.border = '1px solid red';
                }else{
                    var name  = ele.name,
                        value = ele.value;

                    configData.push({
                        name: name,
                        value: value
                    })
                }

            })
            console.log(configData)

            Cookies.set('config', JSON.stringify(configData), {
                expires: 1
            });
            window.location.assign('http://localhost/blkmail/address.php')
        })
    </script>

</body>
</html>