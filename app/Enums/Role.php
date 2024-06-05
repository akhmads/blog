<?php

namespace App\Enums;

enum Role: string
{
    case admin = 'admin';
    case seller = 'seller';
    case buyer = 'buyer';

    public function color(): string
    {
        return match($this)
        {
            self::admin => 'bg-green-500 text-white font-semibold',
            self::seller => 'bg-blue-500 text-white font-semibold',
            self::buyer => 'bg-sky-500 text-white font-semibold',
        };
    }

    public static function toSelect($placeholder = false): array
    {
        $array = [];
        $index = 0;
        if ($placeholder) {
            $array[$index]['id'] = '';
            $array[$index]['name'] = '-- Role --';
            $index++;
        }
        foreach (self::cases() as $key => $case) {
            $array[$index]['id'] = $case->value;
            $array[$index]['name'] = $case->name;
            $index++;
        }
        return $array;
    }
}
