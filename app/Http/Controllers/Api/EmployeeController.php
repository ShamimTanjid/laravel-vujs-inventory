<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Employee;
use Image;
class EmployeeController extends Controller
{   
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee=Employee::all();
        return response()->json($employee);
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
        'name' => 'required|unique:employees|max:255',
        'email' => 'required',
        'phone' => 'required|unique:employees',
    ]);

        if($request->photo){
                   $position = strpos($request->photo, ';');
                   $sub=substr($request->photo, 0 ,$position);
                   $ext=explode('/', $sub)[1];
                   $name=time().".".$ext;
                   $img=Image::make($request->photo)->resize(240,200);
                   $upload_path='backend/employee/';
                   $image_url=$upload_path.$name;
                   $img->save($image_url);

                   $employees = new Employee;
                   $employees->name = $request->name;
                   $employees->email = $request->email;
                   $employees->phone = $request->phone;
                   $employees->address = $request->address;
                   $employees->salary = $request->salary;
                   $employees->nid = $request->nid;
                   $employees->joining_date = $request->joining_date;
                   $employees->photo =  $image_url;
                   $employees->save();
            }else{
                   $employees = new Employee;
                   $employees->name = $request->name;
                   $employees->email = $request->email;
                   $employees->phone = $request->phone;
                   $employees->address = $request->address;
                   $employees->salary = $request->salary;
                   $employees->nid = $request->nid;
                   $employees->joining_date = $request->joining_date;
                   $employees->save();
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
       $employee=DB::table('employees')->where('id',$id)->first();
        return response()->json($employee);

    }

    
    public function update(Request $request, $id)
    {
        
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['salary']=$request->salary;
        $data['nid']=$request->nid;
        $data['joining_date']=$request->joining_date;
        $image=$request->newphoto;
      if ($image) {
           $position = strpos($image, ';');
           $sub=substr($image, 0 ,$position);
           $ext=explode('/', $sub)[1];
           $name=time().".".$ext;
           $img=Image::make($image)->resize(240,200);
           $upload_path='backend/employee/';
           $image_url=$upload_path.$name;
           $success=$img->save($image_url);
       if  ($success) {
             $data['photo']=$image_url;
             $img=DB::table('employees')->where('id',$id)->first();
             $image_path = $img->photo;
             $done=unlink($image_path);
             $user=DB::table('employees')->where('id',$id)->update($data); 
           }
       }else{
           $oldlogo=$request->photo;       
           $data['photo']=$oldlogo;  
           DB::table('employees')->where('id',$id)->update($data); 
        
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
        $employee=DB::table('employees')->where('id',$id)->first();
        $photo=$employee->photo;
        if($photo){
          unlink($photo);
          DB::table('employees')->where('id',$id)->delete();
        }else{
        $delet=DB::table('employees')->where('id',$id)->delete();
       }
    }
}
