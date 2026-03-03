<?php

namespace App\Enums;

enum Role: string
{
    case superuser = "superuser";
    case admin = "admin";
    case student = "student";

    public static function assArray() {
        $array = [
            "superuser"=> self::superuser,
            "admin" => self::admin,
            "student" => self::student
        ];
        return $array;
    }

    public static function indexArray() {
        $array = [
            self::superuser,
            self::admin,
            self::student
        ];
        return $array;
    }
}