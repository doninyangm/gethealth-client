<?php namespace GetHealth;

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
            $data_json = json_encode($data);
            $ch = curl_init('https://platform.gethealth.io/v1/health/account/user/');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, 
                    array( 
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen($data_json))
                        );       
            $result = curl_exec($ch);
            return $result;
        }catch(Exception $e){
            return false;
        }
    }
}