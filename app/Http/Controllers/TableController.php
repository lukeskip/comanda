<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Services\TableService;
use Illuminate\Support\Facades\Auth;


class TableController extends Controller
{
    
    function __construct(TableService $tableService){
        $this->service = $tableService;
        $this->rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
        ];

        // $this->middleware('can:read table', ['only' => ['index', 'show']]);
        $this->middleware('can:create table', ['only' => ['create', 'store']]);
        $this->middleware('can:edit table', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete table', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $tables = Table::where('restaurant_id',$user->restaurants->first()->id)->orderBy('table_number')->get();
        return Inertia::render('Table/Table.index', [
            'tables' => $tables,            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->rules);

        return $this->service->store($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        return Inertia::render('Table/Table.show', [
            'table' => $table,            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        return $table->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        //
    }
}
