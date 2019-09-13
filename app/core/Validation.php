<?php

namespace app\core;
class Validation
{
    public static function checkLength($value = "", $min, $max)
    {
        $result = (strlen(trim($value)) >= $min && strlen(trim($value)) < $max);
        return $result;
    }

    public static function Validate($data)
    {
      $error = array();
      $config = require 'app/config/configValidate.php';

    foreach ($data as $key => $value) {
        $value = trim($value);
        if (isset($config['empty'][$key])){
            unset($data[$key]);
        }

        if ((empty($value))&&(!isset($config['empty'][$key]))) {
                $error[$key] = "Значение $key не введено!";
            }
    }

        if ($error)
        {
            return $_SESSION['errors'] = $error;
        }
        else
        {
            foreach ($data as $key => $value) {
                $value = trim($value);

                if ($key == "password"){
                $min = 8;
                $max = 25;
                $fail = !self::checkLength($value,$min,$max);
                }

                if(isset($config['patterns'][$key])){
                $pattern = $config['patterns'][$key];
                $fail = !preg_match($pattern, trim($data[$key]));
                }

        if ($fail){
            $error[$key] = $config['messages'][$key];  }
        }
          return $_SESSION['errors'] = $error;
        }
    }

}
