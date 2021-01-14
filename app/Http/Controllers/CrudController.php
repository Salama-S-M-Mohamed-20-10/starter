<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use LaravelLocalization;
//use Mcamara\LaravelLocalization\LaravelLocalization;

//use Mcamara\LaravelLocalization\LaravelLocalization;
//use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
//use LaravelLocalization;
//use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use LaravelLocalization;
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

    public function store(OfferRequest $request){
        // validate data before insert in database
        // validator class that make validation in laravel
        /*$rules = $this -> getRules();
        $messages = $this -> getMessages();
        $validator = Validator::make($request->all(),$rules , $messages); // it take one or two or three array and $request->all() to convert to array
        if($validator -> fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }*/

        //insert
        Offer::create([
            'name_ar' => $request -> name_ar,
            'name_en' => $request -> name_en,
            'price' => $request -> price,
            'details_ar' => $request -> details_ar,
            'details_en' => $request -> details_en,
        ]);

        return redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);
    }

    /*protected function getMessages() {
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
    }*/

    public function getAllOffers(){
        $offers = Offer::select('id','price',
        'name_'.LaravelLocalization::getCurrentLocale().' as name',
        'details_'.LaravelLocalization::getCurrentLocale() . ' as details'
        ) -> get(); // return collection
        return view('offers.all',compact('offers'));
    }

}
