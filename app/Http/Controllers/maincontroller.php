<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data_table;
use App\cityfinder;

class maincontroller extends Controller
{
    //

    public function index(){
    	return view('index');
    }

    public function monthlyEvaluation(Request $r){
    	$member = new data_table();

    	$result = $member::where('month','=',$r->month)->get();

    	return response($result);

    }

    public function overall(Request $r){
    	$member = new data_table();

    	$result = $member::all();

    	return response($result);
    }
    public function citylocator(){
    	return view('citylocator');
    }
    public function suggestcity(Request $r){
    	$member = new cityfinder();
    	$suggesstedCity = $member::where('cityName','=',$r->city)->orWhere('cityName','like',$r->city .'%')->orWhere('cityName','like','%'. $r->city .'%')->orWhere('cityName','like','%'. $r->city)->get();
    	if(count($suggesstedCity)){
    		return response($suggesstedCity);
    	}
    	else{
    		return response('No City Found');
    	}

    	
    }

    public function diff($initial,$final){

    	return response(floatval($final)-floatval($initial));
    }
    public function getcity($city,$latitude,$longitude){
    	
    	$member = new cityfinder();
    	$paramater = ["cityName"=>$city,"latitude"=>$latitude,"longitude"=>$longitude];
    	$params = ["latitude"=>$latitude,"longitude"=>$longitude];

		
    	$searchresult = $member::where($paramater)->orWhere('cityName','like',$city.'%',$params)->orWhere('cityName','like',$city.'%')->get();

    	if(count($searchresult)){
    		return response($searchresult);
    	}
    	else{
    		return response('No Match');
    	}



    	
    	return response($latitude);
    }

    public function test(Request $r){
    	return response('Welcome to City Locator App');
    }
}
