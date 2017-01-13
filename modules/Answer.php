<?php

Class Answer
{
    public function getAnswer($question, $dictionary)
    {
        foreach ($dictionary as $key => $value){
            $preg = self::pregMat($key, $question);
            if ($preg){
                return $dictionary[$key];
            }
        }
    }
    public static function pregMat($var,$msg){
        $pregResult = preg_match('/'.$var.'/ui', $msg);
        if ($pregResult) {
            return $pregResult;
        }
    }
}
