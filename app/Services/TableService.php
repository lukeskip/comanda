<?php

namespace App\Services;
use App\Models\Table;

class TableService {

    public function store (Request $request){
        $table = Table::create($request);
        return $table;
    }

    public function show(Table $table){
        
    }

}