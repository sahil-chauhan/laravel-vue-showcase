@extends('layouts.admin.main')
@section('content')
<div class="page-content">
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">License Activation</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">License Details</a></li>
                                <li class="breadcrumb-item active">Add Activation</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->    

            <div class="row">
                <div class="col-xl-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Add Activation</h4>

                            @if (session('success'))
                                <br>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('activations.store',$license->id) }}" method="post">
                                @csrf
                              
                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="site_url" class="form-label">Website Url</label>
                                            
                                            <input type="text" class="form-control @error('site_url') is-invalid @enderror"
                                            value="{{ old('site_url') }}" id="site_url" name="site_url" autofocus 
                                            placeholder="">

                                            @error('site_url')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="domain" class="form-label">Domain</label>
                                            
                                            <input type="text" class="form-control @error('domain') is-invalid @enderror"
                                            value="{{ old('domain') }}" id="domain" name="domain" autofocus 
                                            placeholder="">

                                            @error('domain')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                              
                               
                                <div>
                                    <button type="submit" class="btn btn-success w-md">Create</button>
                                    
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection