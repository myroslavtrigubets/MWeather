<?php
require_once 'Curl.php';

Class ApiOther extends Curl
{

    private function api($address, $parametrs)
    {
        $getConnect = $this->getCurl($address.$parametrs);
        return json_decode($getConnect, true);
    }
    public function getWeather($city)
    {
        return $this->api(
           'http://api.openweathermap.org/data/2.5/weather?','q='.$city.'&appid=APICODE&lang=ua&units=metric'
       );
    }
}