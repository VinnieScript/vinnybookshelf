<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data_table;
use App\cityfinder;
use App\authoriser;
use App\books;
use Storage;
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
    	return response('Welcome to City Locator App'.$r->city);
    }

    public function vinnybookshelf(){
        return view('bookshelf');
    }

    public function login(){
        return view('login');
    }


     public function checklogin(Request $r){
        $member = new authoriser();
        $paramater=['username'=>$r->username,'password'=>$r->password];


        $result = $member::where($paramater)->get();
        if(count($result)){
            $r->session()->put('username',$r->username);
            return response('Login Success');
        }
        else{
            return response('Login Fail');
        }


    }
    public function error(){
        return view('error');
    }

    public function admin(Request $r){
        $value = $r->session()->get('username');

        if($value){
            return view('adminpage');
        }
        else{
            return view('error');
        }

    }

        public function uploadBook(Request $request){
            
            $member = new books();
           


        if ($request->hasFile('file')) {
           $file = $request->file('file');
           $name = time() . $file->getClientOriginalName();
           $filePath = 'images/' . $name;
           Storage::disk('s3')->put($filePath, file_get_contents($file));

           $member->bookname = $request->get('bookname');
            $member->rating = $request->get('bookrate');
            $member->imagepath = $filePath;
            
            $member->save();
            //return back()->withSuccess('Image uploaded successfully');
            return response('Image Successfully Uploaded.');
       }

            
        }

        public function viewBook(Request $request){
            $member = new books();
            $getBook = $member::all();

            if(count($getBook)){
                return response($getBook);
            }
            else{
                return response('No Book found');
            }
        }
    public function viewdetails($bookname){

        return view('viewbook')->with('bookname',$bookname);




    }

    public function getDetails(Request $request){
        $member = new books();

        $getdetails = $member::where('bookname','=',$request->bookname)->get();

        if(count($getdetails)){

            return response($getdetails);

        }
        else{
            return response('Search is Empty');
        }

    }

    public function editdetails($bookname){
        $member= new Books();

        $check = $member::where('bookname','=',$bookname)->get();

        if(count($check)){
            return view('editbook')->with('bookname',$bookname);
        }
        else{
            return view('bookdeleted');
        }


        

    }

    public function updatebook(Request $request){

        $member = new Books();

        $find = $member::find($request->id);

        if($find){
            $find->bookname = $request->Ebookname;
            $find->rating = $request->Erating;

            $find->save();
            return response('Update was successfully made');
        }
        else{
            return response('BookId doesnt Exist');
        }



    }

    public function deleteBook(Request $r){

        $member = new Books();

        $find = $member::find($r->id);

        if($find){
            $find->delete();
            return response('Deleted Successfully');
        }
        else{
            return response('BookId doesnt Exist');
        }
    }

        public function register(Request $r){

            $member= new authoriser();

            $find = $member::where('email','=',$r->email)->get();
            if(count($find)){
                    return response('Email Address has already been used');
            }
            else{
                $member->username = $r->username;
            $member->password= $r->password;
            $member->email = $r->email;
            $member->save();

            return response('Registered');

            }
            

        }

        public function registerpage(){

            return view('register');
        }

        public function logout(Request $request){

            $request->session()->flush();

            return response('Session Destroyed');
        }
    

   

}
