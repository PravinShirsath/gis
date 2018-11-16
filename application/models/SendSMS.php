<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SendSMS extends CI_Model{
    function __construct(){
        parent::__construct();
    }    
     public static function sendSMS($user, $password, $message, $to, $sid) {
        $fl = 0;
        $gwid = 2;
        //Prepare you post parameters
        $postData = array(
            'user' => $user,
            'password' => $password,
            'msisdn' => $to,
            'sid' => $sid,
            'msg' => $message,
            'fl' => $fl,
            'gwid' => $gwid,
        );
        //API URL
        $url="http://sms.skytechhub.in:8080/vendorsms/pushsms.aspx";
        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //get response
        $output = curl_exec($ch);
        //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);  
    }
}
?>