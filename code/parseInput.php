<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(isset($_POST['data'])){
        
        $conf['host']            =  'mail.gamingshed.co.uk';
        $conf['ssl']['port']     =  '465';
        $conf['tls']['port']     =  '587';

        $conf['sender']['name']  = 'Flexing Papa';  
        $conf['sender']['email'] =  'robbiehammett@gamingshed.co.uk';
        $conf['sender']['pass']  =  'Hummer64@';

        // print_r($_POST['data']);

        if($_POST['data'][0]){
            $content = $_POST['data'][0]['messageContent'];
        }
        if($_POST['data'][1]){
            $list = $_POST['data'][1]['addressList'];
        }
        if(count($_POST['data']) > 3){
            if($_POST['data'][2]){
                $senders = $_POST['data'][2]['sendersList'];
            }
            if($_POST['data'][3]){
                $conf = $_POST['data'][3]['messageConfig'];
            }
        }else{
            if($_POST['data'][3]){
                $conf = $_POST['data'][3]['messageConfig'];
            }
        }

        // if($senders){
        //     foreach($senders as $row){
        //         foreach($row as $key => $value){
        //             $s_list[$key] = $value;
        //         }
        //     }
        // }else{
            
            $s_list['email'] = 'cybertest16@gmail.com';
            $s_list['pass'] = 'Cisco_879';
        // }
        // print_r($conf);
        if($senders){
            foreach($senders as $key => $value){
                $s_list = $value;
            }
        }
        // print_r($s_list);
        $s_list['pass'] = $s_list['password'];

        if(!isset($s_list['email']) && !isset($s_list['pass'])){
            $s_list['email'] = 'cybertest16@gmail.com';
            $s_list['pass'] = 'Cisco_879';
        }

        if($conf){
            foreach($conf as $key => $value){
                $config = $value;
            }
        }
        
        if(!isset($config['name'])){
            $config['name'] = 'Flexing Papa';
        }

        if(!isset($config['host'])){
             $config['host'] = 'smtp.gmail.com';
        }

        if(isset($config['smtp'])){
            if($config['smtp'] == 'ssl'){
                $config['port'] = '465';
            }else{
                $config['port'] = '587';
            }
        }else{
            $config['port'] = '465';
        }
    //    print_r($config);
        // print_r($list);
        if($content){
            $data['header'] = $content['subject'];
            $data['msg']    = $content['message'];
        }
        // $theme              = $_POST['req']['theme'];
        // $lang              = $_POST['req']['lang'];
        // $addrList           = explode(',',$_POST['req']['address']);
        // $newList            = '';
        // print_r($config);
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
                            $result = sendmail($config, $data, $list, $s_list, $themePath);
                        }else{
                            echo 'You have no template';
                        }
                    }else{
                        $result = sendmail($config, $data, $list, $s_list, $DefaultThemePath);
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
        echo $result;
    }
?>
