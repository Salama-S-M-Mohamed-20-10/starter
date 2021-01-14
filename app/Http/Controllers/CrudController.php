<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getOffers(){
       return Offer::select('id','name')->get(); // give me all the offers with all columns
    }

    /*public function store(){
        /*Offer::create([
            'name' => 'Offer3',
            'price' => '5000',
            'details' => 'offer detail',
        ]);
    }*/

    public function create(){
        return view('offers.create');
    }

    public function store(Request $request){
        // validate data before insert in database
        // validator class that make validation in laravel
        $rules = $this -> getRules();
        $messages = $this -> getMessages();
        $validator = Validator::make($request->all(),$rules , $messages); // it take one or two or three array and $request->all() to convert to array
        if($validator -> fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }

        //insert
        Offer::create([
            'name' => $request -> name,
            'price' => $request -> price,
            'details' => $request -> details,
        ]);

        return redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);
    }

    protected function getMessages() {
        return $messages = [
            'name.required' => trans('messages.offer name required'), // __ equal to trans
            'name.unique' => __('messages.offer name must be unique'),
            'price.numeric' => __('messages.offer price must be numiric'),
            'price.required' => __('messages.offer price required'),
            'details.required' => __('messages.offer details required'),
        ];
    }

    protected function getRules() {
        return $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
    }

}
