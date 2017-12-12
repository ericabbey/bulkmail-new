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
                    <div class="mail-title">Address List <i class="fa fa-pencil"></i></div>
                    <div class="mail-form">
                        <div class="address-form">
                            <label for="address_list" id="address_label">Upload the list
                                <input id="address_list" type="file" accept=".txt">
                            </label>
                            <div class="address-list-loader"> Extracting </div>
                            <input type="text" id="address" style="display: none;">
                        </div>
                        <div class="send-message">
                            <p  class="error-text">This is an error</p>
                        </div>
                    </div>
                    <div class="mail-links">
                        <div class="btn-mail blue">
                            <div class="btn-text submit">Send</div>
                            <div class="btn-icon fa fa-angle-right"></div>
                        </div>
                    </div>
                </div>
                <table class="table mail-table">
                        <thead> 
                            <tr> 
                                <th width="5%"> 
                                    <div class="checkBox">
                                        <input type="checkbox" value="None" id="checkBox" class="parentCheckbox" name="check" />
                                        <label for="checkBox"></label>
                                    </div>
                                </th> 
                                <th colspan="4"> 
                                    <div class="mail-select-options">Email Address</div> 
                                    <div class="mail-pagination" colspan="2"> 
                                        <!--<strong>1-30</strong> 
                                        <span>of 789</span> 
                                        <div class="btn-group"> 
                                            <a href="index.html#" class="btn btn-sm btn-white"><i class="fa fa-angle-left"></i></a> 
                                            <a href="index.html#" class="btn btn-sm btn-white"><i class="fa fa-angle-right"></i></a> 
                                        </div> -->
                                    </div> 
                                </th> 
                            </tr> 
                        </thead>
                        <tbody>
                            
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Popper.js"></script>
    <script src="js/js.cookie.js"></script>
    <script src="js/func.js"></script>
</body>
</html>