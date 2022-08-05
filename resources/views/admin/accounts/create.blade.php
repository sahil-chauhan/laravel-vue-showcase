@extends('layouts.admin.main')
@section('content')
<div class="page-content">
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Accounts</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">All Accounts</a></li>
                                <li class="breadcrumb-item active">Add Account</li>
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
                            <h4 class="card-title mb-4">Add Account</h4>

                            @if (session('success'))
                                <br>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('accounts.store') }}" method="post">
                                @csrf
                              
                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" id="name" name="name" autofocus 
                                            placeholder="Enter username">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="company_info" class="form-label">Company Info</label>
                                            
                                            <textarea class="form-control @error('company_info') is-invalid @enderror" 
                                            id="company_info" cols="30" rows="10" name="company_info">{{ old('company_info') }}</textarea>

                                            @error('company_info')
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