@extends('layouts.admin.main')
@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Licenses List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Licenses List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (session('success'))
                                <br>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Account</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	
                            		@foreach($licenses as $license)
                            			<tr>
                                            <td>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle">
                                                        {{  $loop->iteration }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1">
                                                	<a href="javascript: void(0);" class="text-dark">{{ $license->product->product_name  ?? ''}}</a>
                                                </h5>
                                            </td>                                             
                                            <td>{{ $license->account->name ?? '' }}</td>                                                
                                            <td>
                                                <ul class="list-inline font-size-20 mb-0">
                                                    <li class="list-inline-item px-2">
                                                        <a class="btn btn-success" href="{{ route('licenses.edit',$license->id) }}" data-bs-toggle="tooltip" title="Edit License">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item px-2">
                                                        <a class="btn btn-info" href="{{ route('licenses.show',$license->id) }}" data-bs-toggle="tooltip" title="View License">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item px-2">
                                                        <a class="btn btn-danger" href="{{ route('licenses.destroy',$license->id) }}" data-bs-toggle="tooltip" title="Delete License" onclick="delete_notifier(event,'destroy-form-{{$license->id}}','Do you want to delete this License?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </li>   
                                                    <form method="post" action="{{ route('licenses.destroy',$license->id) }}" style="display:none;" id="destroy-form-{{$license->id}}">
                                                        @csrf 
                                                        @method('delete')
                                                    </form>                                                     
                                                </ul>
                                            </td>
                                        </tr>
                            		@endforeach
                                	                                                
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                            	{{ $licenses->links('pagination::bootstrap-4') }}
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
