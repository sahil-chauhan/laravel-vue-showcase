<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Activation;
use App\Http\Requests\StoreActivationRequest;
use App\Http\Requests\UpdateActivationRequest;

use Illuminate\Support\Facades\Route;
use App\Models\License;


class ActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('here--index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $license = License::findOrFail(Route::getCurrentRoute()->license);
        return view('Admin.licenses.activations.create',[ 'license' => $license ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivationRequest $request)
    {
        $license = License::findOrFail(Route::getCurrentRoute()->license);

        $activation_limit = $license->activation_limit;

        $count = Activation::where([ 'license_id' => $license->id ])->count();

        if( $count == $activation_limit )
        {
            return redirect()->route('licenses.show',$license->id)->with('warning','Activation limit exceeded.');
        }


        Activation::create([
            'license_id' => Route::getCurrentRoute()->license,
            'site_url' => $request->site_url,
            'domain' => $request->domain,
        ]);

        return redirect()->route('licenses.show',$license->id)->with('success','Activation added successfuly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activation  $activation
     * @return \Illuminate\Http\Response
     */
    public function show(Activation $activation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activation  $activation
     * @return \Illuminate\Http\Response
     */
    public function edit(Activation $activation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivationRequest  $request
     * @param  \App\Models\Activation  $activation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivationRequest $request, Activation $activation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activation  $activation
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $license = License::findOrFail(Route::getCurrentRoute()->license);
        $activation = Activation::findOrFail(Route::getCurrentRoute()->activation);
        $activation->delete();
        return redirect()->route('licenses.show',$license->id)->with('success','Activation added successfuly.');
    }

}
