<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;

class MenuService
{
    public function create($request)
    {
        $validatedData = $this->validateData($request);
        
        if($validatedData['status']){
            return Menu::create($validatedData['data']); 
        }else{
            return response()->json(['errors'=>$validatedData['errors']], 422);
        }
        
    }

    public function update($menu, $request)
    {
        $validatedData = $this->validateData($request);
        
        if($validatedData['status']){
            return $menu->update($validatedData['data']);
        }else{
            return response()->json(['errors'=>$validatedData['errors']], 422);
        }  
    }

    public function delete($menu)
    {
        $menu->delete();
    }

    public function getById($menu,$edit=false)
    {

        if ($menu) {

            $menu->load('dishes');

            if($edit){
                return [
                    'name'=> ['value'=>$menu->name,'type'=>'string'],
                    'description'=> ['value'=>$menu->description,'type'=>'string'],
                    'active'=> ['value'=>$menu->active,'type'=>'boolean'],
                    'restaurant_id'=> ['value'=>$menu->restaurant_id,'type'=>'number'],
                ];
            }else{
                return [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'description' => $menu->description,
                    'active' => $menu->active,
                    'restaurant_id' => $menu->restaurant_id,
                    'dishes' =>  $menu->dishes()->paginate()->toArray(),
                ];
            }
        } else {
            return null;
        }
       
    }

    public function getAll($request = null)
    {
        $menus = Menu::orderBy('id','desc');

        if ($request && $request->input('search')) {
            $menus->where('name', 'like', '%' . $request->input('search') . '%');
        }

        if ($request && $request->input('orderBy')) {
            $menus->orderBy($request->input('orderBy'), 'desc');
        }

        $menus = $menus->paginate();

        $menus->getCollection()->transform(function ($menu) {
            return [
                'id' => $menu->id,
                'name' => $menu->name,
                'description' => $menu->description,
                'active' => $menu->active,
                'restaurant_id' => $menu->restaurant_id,
            ];
        });

        return $menus;
    }

    protected function validateData($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'active' => 'required|boolean',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $fieldErrors = [];
            foreach ($errors->messages() as $field => $messages) {
                $fieldErrors[$field] = $messages;
            }

            return ['status' => false, 'errors' => $fieldErrors];
        }

        $cleanedData = $validator->validated();

        return ['status' => true, 'data' => $cleanedData];
    }
}
