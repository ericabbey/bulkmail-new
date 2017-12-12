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
                    <div class="mail-title">Sent Mail <i class="fa fa-pencil"></i></div>
                    <div class="mail-links">
                    </div>
                </div>
                <table class="table mail-table">
                        <thead> 
                            <tr> 
                                <th width="5%"> 
                                    <div class="checkBox">
                                        <input type="checkbox" value="None" id="checkBox" name="check" checked />
                                        <label for="checkBox"></label>
                                    </div>
                                </th> 
                                <th colspan="4"> 
                                    <div class="mail-select-options">Email Address</div> 
                                    <div class="mail-pagination" colspan="2"> 
                                        <strong>1-30</strong> 
                                        <span>of 789</span> 
                                        <div class="btn-group"> 
                                            <a href="index.html#" class="btn btn-sm btn-white"><i class="fa fa-angle-left"></i></a> 
                                            <a href="index.html#" class="btn btn-sm btn-white"><i class="fa fa-angle-right"></i></a> 
                                        </div> 
                                    </div> 
                                </th> 
                            </tr> 
                        </thead>
                        <tbody>
                                <tr class="list">
                                    <td> 
                                        <div class="checkBox">
                                            <input type="checkbox" value="None" id="checkBox" name="check" checked />
                                            <label for="checkBox"></label>
                                        </div>
                                    </td> 
                                    <td class="col-email" width=50%>
                                        <p></p>ericabbey.8gig@gmail.com<p></p>
                                    </td> 
                                    <td class="col-tag"> 
                                        <p></p><div class="btn-mail success" style="margin: 0; float: left;"><div class="btn-text">Success</div></div> <p></p>
                                    </td> 
                                    <td class="col-time"><p></p>13:52<p></p></td> 
                                </tr>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Popper.js"></script>
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
</body>
</html>