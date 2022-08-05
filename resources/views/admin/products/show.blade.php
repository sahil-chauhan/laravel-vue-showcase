@extends('layouts.admin.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">            
        <div class="row">
            <div class="col-12">
    
                <img width="500" height="500" src="{{  asset('storage/'.$product->product_image) }}" alt="not found">
           
            </div>
        </div>
    </div>
</div>
@endsection