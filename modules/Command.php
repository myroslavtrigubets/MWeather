<?php
require_once 'ApiOther.php';

Class Command extends ApiOther
{
    public function getCommand($question, $commandList)
    {
        foreach ($commandList as $key => $value) {
            $preg = self::pregMat($key, $question);
            if ($preg) {
                switch ($commandList[$key]) {
                    case 1:
                        $city = explode(' ', $question);
                        $city = trim($city[1]);
                        $getWeather = $this->getWeather($city);
                        if (!$getWeather['code']){
                            $weather = 
                                'Зараз на вулиці ' . $getWeather['weather'][0]['description'].'. '.
                                'Швидкість вітру: ' . $getWeather['wind']['speed'].' м/с. '.
                                'Температура повітря: ' . $getWeather['main']['temp'].'. ';
                            
                            return $weather;
                        }else {
                            return 'Місто відсутьнє. Або ви неправильно ввели назву.';
                        }
                    break;
                    default:
                        return 'Щось не так.';
                    break;
                    
                }
            }
        }
    }
    public static function pregMat($var,$msg){
        $pregResult = preg_match('/\/'.$var.'/ui', $msg);
        if ($pregResult) {
            return $pregResult;
        }
    }
}

