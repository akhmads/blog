<?php

namespace App\Enums;

enum PostStatus: string
{
    case draft = 'draft';
    case published = 'published';

    public function color(): string
    {
        return match($this)
        {
            self::draft => 'bg-indigo-100 text-indigo-700 font-bold',
            self::published => 'bg-green-100 text-green-700 font-bold',
        };
    }

    public static function toSelect($placeholder = false): array
    {
        $array = [];
        $index = 0;
        if ($placeholder) {
            $array[$index]['id'] = '';
            $array[$index]['name'] = '-- Status --';
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
