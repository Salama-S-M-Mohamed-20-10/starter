<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
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
    use OfferTrait;
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

        $file_name = $this -> saveImage($request -> photo, 'images/offers');
        //insert
        Offer::create([
            'photo' => $file_name,
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
        $offers = Offer::select('id','price','photo',
        'name_'.LaravelLocalization::getCurrentLocale().' as name',
        'details_'.LaravelLocalization::getCurrentLocale() . ' as details'
        ) -> get(); // return collection
        return view('offers.all',compact('offers'));
    }

    public function editOffer($offer_id){
        //Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id); // Serch In Given Table Id Only
        if(!$offer)
            return redirect() -> back();
        $offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price') -> find($offer_id);
        return view('offers.edit',compact('offer'));
    }

    public function delete($offer_id){
        // check if offer id exists
        $offer = Offer::find($offer_id); // Offer::where('id', '=' ,'offer_id') -> first();
        if(!$offer)
            return redirect() -> back() -> with(['error' => __('messages.offer not exist')]);
        $offer -> delete();
        return redirect()
        ->route('offers.all')
        -> with(['success' => __('messages.offer deleted successfully')]);
    }

    public function updateOffer(OfferRequest $request,$offer_id){
        // Validation
        // Check If Offer Exist
        $offer = Offer::find($offer_id);
        if(!$offer)
            return redirect() -> back();
        // Update Data
        $offer -> update($request -> all());
        return redirect() -> back() -> with(['success' => 'تم التحديث بنجاح']);

        /*$offer -> update([
            'name_ar' => $request -> name_ar,
            'name_en' => $request -> name_en,
            'price' => $request ->price

        ]);*/
    }

    public function getVideo() {
        $video = Video::first(); // first video from database
        event(new VideoViewer($video)); // fire event
        return view('video') -> with('video' , $video);
    }

}
