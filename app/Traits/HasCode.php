<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Code;

trait HasCode
{
    public function exportCode( $date ): string
    {
        $time = strtotime($date);
        $prefix = date('y',$time).date('m',$time);
        Code::updateOrCreate(
            ['prefix' => $prefix],
        )->increment('num');
        $code = Code::where('prefix', $prefix)->first();
        return $code->prefix . Str::padLeft($code->num, 8, '0');
    }

    public function cartonCode( $date ): string
    {
        $time = strtotime($date);
        $prefix = 'C'.date('y',$time).date('m',$time);
        Code::updateOrCreate(
            ['prefix' => $prefix],
        )->increment('num');
        $code = Code::where('prefix', $prefix)->first();
        return $code->prefix .date('d',$time). Str::padLeft($code->num, 6, '0');
    }
}
