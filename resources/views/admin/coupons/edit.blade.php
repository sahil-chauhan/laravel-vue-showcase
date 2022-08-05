@extends('layouts.admin.main')

@section('css')
<link href="{{ URL::asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

<style type="text/css">
    .select2-container--default .select2-results__option[aria-selected=true] {
    background-color: #adb5bd !important;
    border-bottom: solid #212529 1px;
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
                    <h4 class="mb-sm-0 font-size-18">Coupons</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('coupons.index') }}">All Coupons</a></li>
                            <li class="breadcrumb-item active">Edit Coupon</li>
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
                        <h4 class="card-title mb-4">Add Coupon</h4>

                        @if (session('success'))
                            <br>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('coupons.update',$coupon->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                          
                            <div class="row">                                    
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="coupon_code" class="form-label">Coupon Name</label>                                            
                                        <input type="text" class="form-control @error('coupon_code') is-invalid @enderror"
                                        value="{{ $coupon->coupon_code }}" id="coupon_code" name="coupon_code" autofocus 
                                        placeholder="Enter product name">

                                        @error('coupon_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="discount" class="form-label">Discount</label>
                                        <input id="discount" name="discount" 
                                        class="form-control @error('discount') is-invalid @enderror input-mask text-start"
                                        data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" 
                                        value="{{ $coupon->discount }}">
                                        {{-- <span class="text-muted">e.g "$ 0.00"</span> --}}
                                        @error('discount')
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
                                        <label for="type" class="form-label">Discount type</label>
                                        <select name="type" 
                                        id="type" 
                                        class="select2 form-control @error('type') is-invalid @enderror">
                                            <option value="">Choose Type</option>
                                        	<option @if( $coupon->type == "percent") selected="selected" @endif value="percent">Percent</option>    
                                        	<option @if( $coupon->type == "flat") selected="selected" @endif value="flat">Flat</option>    
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    </div>   
                                </div>
                                <div class="col-md-6">
                                    @php
                                    	$coupon_products = json_decode($coupon->product_ids) ?? []; 
                                    @endphp
                                    <div class="mb-3">
                                        <label for="product_ids" class="form-label">Select Products</label>
                                        <select name="product_ids[]" id="product_ids" multiple="multiple"
                                        class="select2-multiple form-control @error('type') is-invalid @enderror">
                                            <option value="">Select Product</option>  
                                            @foreach( $products as $product )
                                                <option @if( in_array($product->id,$coupon_products)) selected="selected" @endif value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach  
                                        </select>
                                        @error('product_ids')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    </div>   
                                </div>                                 
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary w-md">Update</button>
                                
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
 <!-- form mask -->
<script src="{{ URL::asset('assets/libs/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script type="text/javascript">

$(document).ready(function(){$(".input-mask").inputmask()});
$(".select2").select2();
$('.select2-multiple').select2();
</script>
@endsection