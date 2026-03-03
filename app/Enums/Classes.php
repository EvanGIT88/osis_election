<?php

namespace App\Enums;

enum Classes : string
{
    //
    case TEN = "ten";
    case ELEVEN = "eleven";
    case TWELVE = "twelve";
     public static function assArray() {
        $array = [
            "ten"=> self::TEN,
            "eleven" => self::ELEVEN,
            "twelve" => self::TWELVE
        ];
        return $array;
    }

        public static function indexArray() {
        $array = [
            self::TEN,
            self::ELEVEN,
            self::TWELVE
        ];
        return $array;
    }
}
