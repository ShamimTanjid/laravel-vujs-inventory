<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Supplier;
use Image;

class SupplierController extends Controller
{
     

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Supplier=Supplier::all();
        return response()->json($Supplier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required|unique:suppliers',
    ]);

             if($request->photo){
                   $position = strpos($request->photo, ';');
                   $sub=substr($request->photo, 0 ,$position);
                   $ext=explode('/', $sub)[1];
                   $name=time().".".$ext;
                   $img=Image::make($request->photo)->resize(240,200);
                   $upload_path='backend/supplier/';
                   $image_url=$upload_path.$name;
                   $img->save($image_url);

                   $suppliers = new Supplier;
                   $suppliers->name = $request->name;
                   $suppliers->email = $request->email;
                   $suppliers->phone = $request->phone;
                   $suppliers->address = $request->address;
                   $suppliers->shopname = $request->shopname;                  
                   $suppliers->photo =  $image_url;
                   $suppliers->save();
            }else{
                   $suppliers = new Employee;
                   $suppliers->name = $request->name;
                   $suppliers->email = $request->email;
                   $suppliers->phone = $request->phone;
                   $suppliers->address = $request->address;
                   $suppliers->shopname = $request->shopname;
                   
                   $suppliers->save();
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier=DB::table('suppliers')->where('id',$id)->first();
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['shopname']=$request->shopname;       
        $image=$request->newphoto;
      if ($image) {
           $position = strpos($image, ';');
           $sub=substr($image, 0 ,$position);
           $ext=explode('/', $sub)[1];
           $name=time().".".$ext;
           $img=Image::make($image)->resize(240,200);
           $upload_path='backend/supplier/';
           $image_url=$upload_path.$name;
           $success=$img->save($image_url);
       if  ($success) {
             $data['photo']=$image_url;
             $img=DB::table('suppliers')->where('id',$id)->first();
             $image_path = $img->photo;
             $done=unlink($image_path);
             $user=DB::table('suppliers')->where('id',$id)->update($data); 
           }
       }else{
           $oldlogo=$request->photo;       
           $data['photo']=$oldlogo;  
           DB::table('suppliers')->where('id',$id)->update($data); 
        
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier=DB::table('suppliers')->where('id',$id)->first();
        $photo=$supplier->photo;
        if($photo){
          unlink($photo);
          DB::table('suppliers')->where('id',$id)->delete();
        }else{
        $delet=DB::table('suppliers')->where('id',$id)->delete();
       }
    }
    
}
