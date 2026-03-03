<?php

namespace App\Enums;

enum Major : string
{
    //
    case PPLG = 'pplg';
    case AKL = 'akl';
    case MPLB = 'mplb';

        public static function assArray() {
        $array = [
            "pplg"=> self::PPLG,
            "akl" => self::AKL,
            "mplb" => self::MPLB
        ];
        return $array;
    }

        public static function indexArray() {
        $array = [
            self::PPLG,
            self::AKL,
            self::MPLB
        ];
        return $array;
    }
}
