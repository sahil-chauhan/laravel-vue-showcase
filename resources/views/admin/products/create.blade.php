@extends('layouts.admin.main')

@section('css')

@endsection


@section('content')
<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Products</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">All Products</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
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
                        <h4 class="card-title mb-4">Add Product</h4>

                        @if (session('success'))
                            <br>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                          
                            <div class="row">                                    
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="product_name" class="form-label">Product Name</label>                                            
                                        <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                        value="{{ old('product_name') }}" id="product_name" name="product_name" autofocus 
                                        placeholder="Enter product name">

                                        @error('product_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sku" class="form-label">Sku</label>                                           
                                        <input type="text" class="form-control @error('sku') is-invalid @enderror"
                                        value="{{ old('sku') }}" id="sku" name="sku"  
                                        placeholder="sku">

                                        @error('sku')
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
                                        <label for="price" class="form-label">Price</label>
                                        <input id="price" name="price" 
                                        class="form-control @error('price') is-invalid @enderror input-mask text-start"
                                        data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" 
                                        value="{{ old('price') }}">
                                        {{-- <span class="text-muted">e.g "$ 0.00"</span> --}}
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">

                                        <label for="sale_price" class="form-label">Sale Price</label>
                                        <input id="sale_price" name="sale_price" 
                                        class="form-control @error('sale_price') is-invalid @enderror input-mask text-start"
                                        data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'" 
                                        value="{{ old('sale_price') }}">
                                        {{-- <span class="text-muted">e.g "$ 0.00"</span> --}}
                                        @error('sale_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="product_image" class="form-label">Product Image</label>
                                        <input  class="form-control @error('product_image') is-invalid @enderror" 
                                                id="product_image" name="product_image" type="file">
                                        @error('product_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-success w-md">Add Product</button>
                                
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

<script type="text/javascript">

$(document).ready(function(){
    $(".input-mask").inputmask();
});



</script>
@endsection
