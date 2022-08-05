<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\License;
use App\Http\Requests\StoreLicenseRequest;
use App\Http\Requests\UpdateLicenseRequest;
use App\Models\Product;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licenses = License::orderBy('id','desc')->paginate(config('site.per_page_count'));
        return view('Admin.licenses.index',['licenses' => $licenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get(); 
        $accounts = Account::get(); 
        return view('Admin.licenses.create',[ 'products'=>$products, 'accounts'=>$accounts ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLicenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLicenseRequest $request)
    {
        $license_key = $this->get_new_license_key($request->account_id,$request->product_id);

        License::create([
            'account_id' => $request->account_id,
            'license_key' => base64_encode($license_key),
            'activation_limit' => $request->activation_limit,
            'product_id' =>$request->product_id,
        ]);

        return redirect()->back()->with('success','License created successfully.');
    }

    public function get_new_license_key($account_id,$product_id)
    {
        $key = $account_id.'-'.$product_id.'-'.time();
        return Hash::make($key);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
        $license->setRelation('activations', $license->activations()->paginate(config('site.per_page_count')));
        return view('Admin.licenses.show',[ 'license' => $license]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function edit(License $license)
    {
        $products = Product::get(); 
        $accounts = Account::get(); 
        return view('Admin.licenses.edit',[ 'products'=>$products, 'accounts'=>$accounts, 'license' => $license ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLicenseRequest  $request
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLicenseRequest $request, License $license)
    {
        $license->account_id = $request->account_id;
        $license->activation_limit = $request->activation_limit;
        $license->product_id = $request->product_id;
        $license->save();

        return redirect()->back()->with('success','License updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $license)
    {
        $license->delete();
        return redirect()->route('licenses.index')->with('success','License deleted successfully.');
    }
}
