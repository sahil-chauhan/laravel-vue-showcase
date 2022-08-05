@extends('layouts.admin.main')

@section('css')
<link href="{{ URL::asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

<style type="text/css">
    .select2-container--default .select2-results__option[aria-selected=true] {
    background-color: #adb5bd59 !important;
    border-bottom: solid #21252945 1px;
}
</style>

@endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Licenses</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('licenses.index') }}">All Licenses</a></li>
                            <li class="breadcrumb-item active">Add License</li>
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
                        <h4 class="card-title mb-4">Add License</h4>

                        @if (session('success'))
                            <br>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('licenses.store') }}" method="post">
                            @csrf
                          
                            <div class="row"> 
                           		<div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="account_id" class="form-label">Select Account</label>
                                        <select name="account_id" 
                                        id="account_id" autofocus
                                        class="select2 form-control @error('account_id') is-invalid @enderror">
                                            <option value="">Choose Account</option> 
                                            @foreach( $accounts as $account )
                                            	<option value="{{ $account->id }}">{{ $account->name }}</option>
                                            @endforeach 
                                        </select>
                                        @error('account_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    </div>   
                                </div>     
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="product_id" class="form-label">Select Product</label>
                                        <select name="product_id" 
                                        id="product_id" 
                                        class="select2 form-control @error('product_id') is-invalid @enderror">
                                            <option value="">Choose Product</option> 
                                            @foreach( $products as $product )
                                            	<option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach 
                                        </select>
                                        @error('product_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    </div>   
                                </div>                                
                            </div>
                            <div class="row">
                            	<div class="col-md-6">
                            		<div class="mb-3">
                            			<label for="activation_limit" class="form-label">Activation limit</label>
                                      
                                        <input type="number" class="form-control @error('activation_limit') is-invalid @enderror"
                                        value="{{ old('activation_limit') }}" id="activation_limit" name="activation_limit"  
                                        min="1">

                                        @error('activation_limit')
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
@section('script-bottom')

<script src="{{ URL::asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script type="text/javascript">

$(document).ready(function(){$(".input-mask").inputmask()});
$(".select2").select2();
$('.select2-multiple').select2();
</script>
@endsection