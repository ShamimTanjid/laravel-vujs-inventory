<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class SalaryController extends Controller
{
    public function Paid(Request $request,$id){
    	$validatedData = $request->validate([
        'salary_month' => 'required',        
        ]);
    
      $month=$request->salary_month;
     $check=DB::table('salaries')->where('employee_id',$id)->where('salary_month',$month)->first();
      if( $check){
       return response()->json('salary allready Paid');
      }else{

    $data=array();
    $data['employee_id'] =$id;
    $data['amount']	 = $request->salary;
    $data['salary_date'] =date('d/m/y');
    $data['salary_month'] =$month;
    $data['salary_year'] = date('Y');

    DB::table('salaries')->insert($data);
}
    }

   public function Allsalary()
   {
    $salary=DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();

    return response()->json($salary);
   }
   public function viewsalary($id){
    $month=$id;
    $view=DB::table('salaries')
    ->join('employees','salaries.employee_id','employees.id')
    ->select('employees.name','salaries.*')
    ->where('salaries.salary_month',$month)
    ->get();
    return response()->json($view);

   }
   public function editsalary($id){
        $view=DB::table('salaries')
    ->join('employees','salaries.employee_id','employees.id')
    ->select('employees.name','employees.email','salaries.*')
    ->where('salaries.id',$id)
    ->first();

    return response()->json($view);
   }
   public function salaryupdate(Request $request,$id){

                $data=array();
                $data['employee_id'] =$id;
                $data['amount']  = $request->amount;               
                $data['salary_month'] =$request->salary_month; 


                DB::table('salaries')->where('id',$id)->update($data);
                
   }
   public function stockupdate(Request $request,$id){
                $data=array();
                $data['product_quantity'] =$request->product_quantity; 

                DB::table('products')->where('id',$id)->update($data);
   }

}
