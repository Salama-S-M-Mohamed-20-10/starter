<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use LaravelLocalization;
class OfferController extends Controller
{
    use OfferTrait;
    public function create(){
        // view form to add this offer
        return view('ajaxoffers.create');
    }
    public function store(Request $request){
        // save offer into DB using AJAX
        $file_name = $this -> saveImage($request -> photo, 'images/offers');
        //insert table offers in database
        $offer = Offer::create([
            'photo' => $file_name,
            'name_ar' => $request -> name_ar,
            'name_en' => $request -> name_en,
            'price' => $request -> price,
            'details_ar' => $request -> details_ar,
            'details_en' => $request -> details_en,
        ]);
        if($offer)
            // it seem to redirect back but i dont to reload the page return response() -> json()
            return response() -> json([
                'status' => true,
                'msg' => 'تم الحفظ بنجاح'
            ]);
        else
            return response() -> json([
                'status' => false,
                'msg' => 'فشل الحفظ برجاء المحاوله مجددا'
            ]);

    }

    public function all(){
        $offers = Offer::select('id','price','photo',
        'name_'.LaravelLocalization::getCurrentLocale().' as name',
        'details_'.LaravelLocalization::getCurrentLocale() . ' as details'
        )->limit(10) -> get(); // return collection
        return view('ajaxoffers.all',compact('offers'));
    }
    // Request is that contain of data that from ajax
    public function delete(Request $request){
        // check if offer id exists
        $offer = Offer::find($request -> id); // Offer::where('id', '=' ,'offer_id') -> first();
        if(!$offer)
            return redirect() -> back() -> with(['error' => __('messages.offer not exist')]);
        $offer -> delete();

        return response() -> json([
            'status' => true,
            'msg' => 'تم الحذف بنجاح',
            'id' => $request -> id
        ]);
    }

    public function edit(Request $request){
        $offer = Offer::find($request -> offer_id); // Serch In Given Table Id Only
        if(!$offer)
            return response() -> json([
                'status' => false,
                'msg' => 'هذا العرض غير موجود'
            ]);
        $offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price') -> find($request -> offer_id); //find return to me one row only
        return view('ajaxoffers.edit',compact('offer'));
    }

    public function update(Request $request){
        $offer = Offer::find($request -> offer_id);
        if(!$offer)
        return response() -> json([
            'status' => false,
            'msg' => 'هذا العرض غير موجود'
        ]);
        // Update Data
        $offer -> update($request -> all());
        return response() -> json([
            'status' => true,
            'msg' => 'تم التحديث بنجاح'
        ]);
    }
}
