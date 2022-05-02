<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::get();
        return view('companies', ['companies' => $companies]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|unique:companies|max:255',
            'description' => 'required|max:255',
        ],
            [
                'name.required' => 'يرجي ادخال اسم الشركة',
                'name.unique' => 'اسم الشركة مسجل مسبقا',
                'description.required' => 'يرجي ادخال وصف الشركة ',
            ]);

        Company::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        session()->flash('Add', 'تم اضافة الشركة بنجاح ');
        return redirect('/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->name;

        $this->validate($request, [

            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ],[
            'name.required' => 'يرجي ادخال اسم الشركة',
            'description.required' => 'يرجي ادخال وصف الشركة ',
        ]);

        $company = Company::where('name',$request->name)->first();
        $company->update([
            'name' => $request->name,
            'description' => $request->description,

        ]);

        session()->flash('edit','تم تعديل المستخدم بنجاج');
        return redirect('/companies');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Company::where('name',$request->name)->delete();
        session()->flash('delete','تم حذف الشركة بنجاح');
        return redirect('/companies');    }
}
