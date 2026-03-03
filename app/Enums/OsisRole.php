<?php

namespace App\Enums;

enum OsisRole : string
{
    //
    case DEPUTY = 'deputy';
    case CHAIRMAN = 'chairman';

        public static function assArray() {
        $array = [
            "deputy"=> self::DEPUTY,
            "chairman" => self::CHAIRMAN
        ];
        return $array;
    }

        public static function indexArray() {
        $array = [
            self::DEPUTY,
            self::CHAIRMAN
        ];
        return $array;
    }
}
