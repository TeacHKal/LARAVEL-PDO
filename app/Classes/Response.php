<?php
/**
 * Created by PhpStorm.
 * User: teach
 * Date: 11/29/2017
 * Time: 11:21 PM
 */

namespace App\Classes;


class Response
{
    private static $STATUS_KEY = "status";
    private static $MESSAGE_KEY = "message";
    private static $DATA_KEY = "data";

    /**
     * @param $status
     * @param $message
     * @param null $data
     * @return array
     */
    public static function response($status, $message, $data = null)
    {
        $arr = array();
        $arr[self::$STATUS_KEY] = $status;
        $arr[self::$MESSAGE_KEY] = $message;
        if($data != null) {
            $arr[self::$DATA_KEY] = $data;
        }
        return $arr;
    }
}