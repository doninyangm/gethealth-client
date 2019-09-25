<?php namespace GetHealth;

Use Carbon\Carbon;

/**
 * @package    GetHealth
 * @author     Andino Inyang
 * @license    MIT
 */

 /**
  * GetHelp helper class
  */
class Helper{

    public static function sayHello(){
        return "Hello World";
    }

    /**
     * Creates a new user profile
     * @param String $accountToken
     * @return json
     */
    public static function create($accountToken){
        try{
            $rand = rand(1, 1000000);
            $arr = ['uid' => $rand];
            $data = array(
                'access_token' => $accountToken,
                'user' => $arr
            );
            $dataJson = json_encode($data);
            $ch = curl_init('https://platform.gethealth.io/v1/health/account/user/');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, 
                    array( 
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen($dataJson))
                        );       
            $response = curl_exec($ch);
            return $response;
        }catch(Exception $e){
            return false;
        }
    }

    /**
     * Return the supported devices for this account
     * @param String $userToken
     * @return json | false
     */
    public static function getDevices($userToken){
        $ch = curl_init();  
        $url = 'https://platform.gethealth.io/v1/health/user/devices/?access_token='.$userToken;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //  curl_setopt($ch,CURLOPT_HEADER, false); 
        $response=curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * Return activities for the provided user
     * @param String $userToken
     * @return json | false
     */
    public static function getActivity($userToken){
       try{
            $ch = curl_init();
            $url = 'https://platform.gethealth.io/v1/health/user/activities/?access_token='.$userToken;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch,CURLOPT_HEADER, false);    
            $output = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($output, true);       
            return $response;
       }
       catch(Exception $e){
           return false;
       }
    }
}