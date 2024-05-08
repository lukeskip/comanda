<?php

namespace App\Services;

class TableService {

    public function store (Request $request){
        $table = Table::create($request);
        return $table;
    }

}