<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait TableHelper
{
    public function pageList(): array
    {
        return [
            ['id' => '8', 'name' => '8'],
            ['id' => '20', 'name' => '20'],
            ['id' => '50', 'name' => '50'],
            ['id' => '100', 'name' => '100'],
        ];
    }
}
