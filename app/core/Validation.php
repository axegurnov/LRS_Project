<?php


namespace app\core;


class Validation
{
    public static function check_length($value = "", $min, $max)
    {
        $result = (strlen(trim($value)) >= $min && strlen(trim($value)) < $max);
        return $result;
    }
    public static function Validate($data)
    {
        $error = array();
        $pattern = "/^[а-яА-ЯёЁ]+$/";
        $email_pattern = "/^[a-z0-9_.\-]+$/i";
        $desc_pattern = "/^[а-яА-ЯёЁa-zA-Z0-9 ]+$/i";
       // $desc_pattern = "/^[a-z0-9]+$/i";

        foreach ($data as $key => $value) {
            $value = trim($value);
            if (empty($value)) {
                $error[$key] = "Значение $key не введено!";
            }
        }

        if ($error)
        {
            return $_SESSION['errors'] = $error;

        }
        else
        {
            if (isset($data['login'])) {
                $login = !preg_match($email_pattern, trim($data['login']));

                if ($login) {
                    $error['login'] = "Некорректно введен login. Допустимо использовать только латинские буквы, цифры,
знак подчеркивания («_»), точку («.»), минус («-»)";
                }

            }

            if (isset($data['password'])) {
                $min = 8;
                $max = 25;
                $length = self::check_length($data['password'],$min, $max);
                if (!$length) {
                    $error['password'] = "Пароль должен содержать от восьми до двадцати пяти символов!";
                }
            }
                if (isset($data['name'])) {
                    //debug($data);
                    $name = !preg_match($desc_pattern, trim($data['name']));
                    if ($name) {
                        $error['name'] = "Имя введено неверно. Допустимо использовать только латинские буквы .";

                        $num_words = explode(" ", trim($data['name']));
                        if (sizeof($num_words) > 1) {
                            $error['name'] = $error['name'] . " Имя должно состоять из одного слова";
                        }
                    }

                }

            if (isset($data['second_name'])) {
                $name = !preg_match($email_pattern, trim($data['second_name']));
                if ($name) {
                    $error['second_name'] = "Фамилия введена неверно. Допустимо использовать только латинские буквы.";
                }
                $num_words = explode(" ", trim($data['second_name']));
                if (sizeof($num_words) > 1) {
                    $error['second_name'] = $error['second_name'] . " Фамилия должна состоять из одного слова";
                }

            }

            if (isset($data['email'])) {
                if (strpbrk("@", $data['email'])) //Проверка на наличие символа @
                {
                    // email разделяется по символу @ на две части, которые по отдельности проверяются регулярным выражением
                    $partsOfEmail = explode("@", trim($data['email']));
                    $partOne = !preg_match($email_pattern, $partsOfEmail[0]);
                    $partTwo = !preg_match($email_pattern, $partsOfEmail[1]);

                    if (($partOne) || ($partTwo)) {
                        $error['email'] = "Некорректно введен email. Допустимо использовать только латинские буквы, цифры,
знак подчеркивания («_»), точку («.»), минус («-»)";
                    }
                } else {
                    $error['email'] = "Email должен содержать знак : @ ";
                }
            }

            if (isset($data['description'])) {
                $description = !preg_match($desc_pattern, trim($data['description']));
                if ($description) {
                    $error['description'] = "Некорректно введено описание. Допустимо использовать только латинские буквы";
                }
            }

            return $_SESSION['errors'] = $error;

        }
    }


}