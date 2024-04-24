<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Validator;

class RestaurantService
{
    public function create($request)
    {
        $validatedData = $this->validateData($request);
        
        if($validatedData['status']){
            return $restaurant = Restaurant::create($validatedData['data']); 
        }else{
            return response()->json(['errors'=>$validatedData['errors']], 422);
        }
        
    }

    public function update($restaurant, $request)
    {
        $validatedData = $this->validateData($request);
        
        if($validatedData['status']){
            return $restaurant->update($validatedData['data']);
        }else{
            return response()->json(['errors'=>$validatedData['errors']], 422);
        }  
    }

    public function delete($restaurant)
    {
        $restaurant->delete();
    }

    public function getById($restaurant,$edit=false)
    {

        if ($restaurant) {

            if($edit){
                return [
                    'name'=> ['value'=>$restaurant->name,'type'=>'string'],
                    'description'=> ['value'=>$restaurant->description,'type'=>'string'],
                    'street'=> ['value'=>$restaurant->street,'type'=>'string'],
                    'number'=> ['value'=>$restaurant->number,'type'=>'string'],
                    'city'=> ['value'=>$restaurant->city,'type'=>'string'],
                    'postal_code'=> ['value'=>$restaurant->postal_code,'type'=>'string'],
                    'state'=> ['value'=>$restaurant->state,'type'=>'string'],
                    'country'=> ['value'=>$restaurant->country,'type'=>'string'],
                    'phone'=> ['value'=>$restaurant->phone,'type'=>'string'],
                    'opening_time'=> ['value'=>$restaurant->opening_time,'type'=>'string'],
                    'closing_time'=> ['value'=>$restaurant->closing_time,'type'=>'string'],
                ];
            }else{
                return [
                    'id' => $restaurant->id,
                    'name' => $restaurant->name,
                    'description' => $restaurant->description,
                    'street' => $restaurant->street,
                    'number' => $restaurant->number,
                    'city' => $restaurant->city,
                    'postal_code' => $restaurant->postal_code,
                    'state' => $restaurant->state,
                    'country' => $restaurant->country,
                    'phone' => $restaurant->phone,
                    'opening_time' => $restaurant->opening_time,
                    'closing_time' => $restaurant->closing_time,
                ];
            }
        } else {
            return null;
        }
       
    }

    public function getAll($request = null)
    {
        $restaurants = Restaurant::orderBy('id','desc');

        if ($request && $request->input('search')) {
            $restaurants->where('name', 'like', '%' . $request->input('search') . '%');
        }

        if ($request && $request->input('orderBy')) {
            $restaurants->orderBy($request->input('orderBy'), 'desc');
        }

        $restaurants = $restaurants->paginate();

        $restaurants->getCollection()->transform(function ($restaurant) {
            return [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'description' => $restaurant->description,
                'address' => $restaurant->city,
                'format_date' => $restaurant->format_date,
            ];
        });

        return $restaurants;
    }

    protected function validateData($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'street' => 'required|string',
            'number' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
            'opening_time' => 'nullable|date_format:H:i:s',
            'closing_time' => 'nullable|date_format:H:i:s',
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
