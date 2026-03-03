<?php

namespace App\Enums;

//i  recommend better naming
enum Pairs : string
{
    //
    case ONE = "one";
    case TWO = "two";
    case THREE = "three";
     public static function assArray() {
        $array = [
            "one"=> self::ONE,
            "two" => self::TWO,
            "three" => self::THREE
        ];
        return $array;
    }

        public static function indexArray() {
        $array = [
            self::ONE,
            self::TWO,
            self::THREE
        ];
        return $array;
    }
}
