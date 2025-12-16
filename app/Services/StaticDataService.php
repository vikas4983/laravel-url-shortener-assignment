<?php

namespace App\services;

use App\Models\Company;
use App\Models\Role;

class StaticDataService
{

    public function getData()
    {
        $staticData = [
            'roles' => Role::class,
            'companies' => Company::class,
        ];
        $result = [];
        foreach ($staticData as $key => $model) {
            $result[$key] = $model::all();
        }
        return $result;
    }
}
