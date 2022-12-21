<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data = DB::table('companies')->paginate(10);
			
		return view('content.company.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Company();
		return view('content.company.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
			'name' => 'required|string',
			'email' => 'nullable|email',
			'website' => 'nullable|string',
			'logo' => 'nullable|mimes:jpg,png,jpeg|dimensions:min_width=100,min_height=100',
		]);
		
		$now = Carbon::now();
		DB::beginTransaction();
		try
		{
			$inputdata = [
				'name' => $request->name,
				'email' => $request->email,
				'website' => $request->website,
			];
			
			if($request->hasFile('logo'))
			{
				$path = Storage::putFile(
					'public/images',
					$request->file('logo'),
				);
				
				$inputdata['logo'] = $path;
			}
			
			DB::table('companies')->insert($inputdata);

			DB::commit();
			
			return redirect()->route('Company.index')->with('success', 'Successfully create new data');
		}
		catch(Throwable $e)
		{
			DB::rollback();
			if($request->hasFile('logo'))
			{
				Storage::delete($request->logo);
			}
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
		$data = DB::table('companies')->where('id', $id)->first();
        $employees = DB::table('employees')->where('company', $id)->paginate(10);
		
		return view('content.company.detail', compact('employees', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('companies')->where('id', $id)->first();
		return view('content.company.form', compact('data'));
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
        $request->validate([
			'name' => 'required|string',
			'email' => 'nullable|email',
			'website' => 'nullable|string',
			'logo' => 'nullable|mimes:jpg,png,jpeg|dimensions:min_width=100,min_height=100',
		]);
		
		$now = Carbon::now();
		DB::beginTransaction();
		try
		{
			$inputdata = [
				'name' => $request->name,
				'email' => $request->email,
				'website' => $request->website,
			];
			
			if($request->hasFile('logo'))
			{
				$path = Storage::putFile(
					'public/images',
					$request->file('logo'),
				);
				
				$inputdata['logo'] = $path;
			}
			
			DB::table('companies')->where('id', $id)->update($inputdata);

			DB::commit();
			
			return redirect()->route('Company.index')->with('success', 'Successfully update data');
		}
		catch(Throwable $e)
		{
			DB::rollback();
			if($request->hasFile('logo'))
			{
				Storage::delete($request->logo);
			}
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
			$cekdata = DB::table('employees')->where('company', $id)->count();
			if($cekdata != 0)
			{
				$cekdata = DB::table('employees')->where('company', $id)->delete();
			}
			$image = DB::table('companies')->where('id', $id)->first();
			DB::table('companies')->where('id', $id)->delete();
			Storage::delete($image->logo);
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
