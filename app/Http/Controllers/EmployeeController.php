<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'email' => 'nullable|email|max:191',
            'phone' => 'nullable|numeric',
        ]);

		if($validator->fails()){
			$message = implode("<br>",$validator->messages()->all());
			return redirect()->back()->with('danger', $message);
        }
		
		$now = Carbon::now();
		DB::beginTransaction();
		try
		{
			$inputdata = [
				'firstname' => $request->firstname,
				'lastname' => $request->lastname,
				'email' => $request->email,
				'phone' => $request->phone,
				'company' => $request->company,
				'created_at' => $now,
			];
			
			DB::table('employees')->insert($inputdata);
			
			DB::commit();
			
			return redirect()->back()->with('success', 'Successfully create new data');
		}
		catch(Throwable $e)
		{
			DB::rollback();
			return redirect()->back()->with('error', $e->message());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'email' => 'nullable|email|max:191',
            'phone' => 'nullable|numeric',
        ]);

		if($validator->fails()){
			$message = implode("<br>",$validator->messages()->all());
			return redirect()->back()->with('danger', $message);
        }
		
		$now = Carbon::now();
		DB::beginTransaction();
		try
		{
			$inputdata = [
				'firstname' => $request->firstname,
				'lastname' => $request->lastname,
				'email' => $request->email,
				'phone' => $request->phone,
				'updated_at' => $now,
			];
			
			DB::table('employees')->where('id', $id)->update($inputdata);
			
			DB::commit();
			
			return redirect()->back()->with('success', 'Successfully update data');
		}
		catch(Throwable $e)
		{
			DB::rollback();
			return redirect()->back()->with('error', $e->message());
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
        DB::beginTransaction();
		try
		{
			DB::table('employees')->where('id', $id)->delete();
			
			DB::commit();
			
			return redirect()->back()->with('success', 'Successfully delete data');
		}
		catch(Throwable $e)
		{
			DB::rollback();
			return redirect()->back()->with('error', $e->message());
		}
    }
}
