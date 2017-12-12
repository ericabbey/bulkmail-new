<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if(isset($_POST['data'])){
        if($_POST['data'][0]){
            $content = $_POST['data'][0]['messageContent'];
        }
        if($_POST['data'][0]){
            $list = $_POST['data'][1]['addressList'];
        }
        if($_POST['data'][0]){
            $conf = $_POST['data'][2]['messageConfig'];
        }

        if($conf){
            foreach($conf as $row){
                foreach($row as $key => $value){
                    ($key == 'name') ? $name = $value : $val = $value;
                    if(isset($name) && isset($val)){
                        $config[$name] = $val;
                    }
                }
            }

        }else{
            require 'config.php';
            $config = $conf['mail'];
        }
        if($content){
            $data['header'] = $content['subject'];
            $data['msg']    = $content['message'];
        }
        // $theme              = $_POST['req']['theme'];
        // $lang              = $_POST['req']['lang'];
        // $addrList           = explode(',',$_POST['req']['address']);
        // $newList            = '';
        echo $content;
        
        // $themePath = '../templates/'.$lang.'/'.str_replace(' ', '_', $theme); 
        $useTemplate = false;
        $DefaultThemePath = '../templates/english/raw';
        $themePath = '../templates/english/theme';
        if($content){
            if($config){
                if($data){
                    require 'send.php';
                    if($useTemplate == true){
                        if($themePath){
                            sendmail($config, $data, $list, $themePath);
                        }else{
                            echo 'You have no template';
                        }
                    }else{
                        sendmail($config, $data, $list, $DefaultThemePath);
                    }
                }else{
                    echo 'data error';
                }
            }else{
                echo 'config error';
            }
        }else{
            echo 'content error';
        }
    }
?>
