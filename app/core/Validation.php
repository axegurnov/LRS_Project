<?php
namespace app\core;

class Validation
{
    public static function Validate($data)
    {
        $fail = FALSE;
        $error = array();
        $config = require '../app/config/configValidate.php';

        foreach ($data as $key => $value) {
            $value = trim($value);
            if (isset($config['patterns'][$key])) {
                if (empty($value)) {
                    $error[$key] = "Значение $key не введено!";
                } else {
                    $pattern = $config['patterns'][$key];
                    $fail = !preg_match($pattern, trim($data[$key]));
                }
                if ($fail) {
                    $error[$key] = $config['messages'][$key];
                }
            }
        }
        return $error;
    }
}

?>
