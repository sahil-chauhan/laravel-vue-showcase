@extends('layouts.admin.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Users List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users List</li>
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
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Tags</th>
                                        <th scope="col">Projects</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	
                            		@foreach($users as $user)
                            			<tr>
                                            <td>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle">
                                                        {{  ucFirst(substr($user->name,0,1)) ?? '' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">{{ $user->name }}</a></h5>
                                                <p class="text-muted mb-0">UI/UX Designer</p>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <div>
                                                    <a href="javascript: void(0);" class="badge badge-soft-primary font-size-11 m-1">Photoshop</a>
                                                    <a href="javascript: void(0);" class="badge badge-soft-primary font-size-11 m-1">illustrator</a>
                                                </div>
                                            </td>
                                            <td>
                                                125
                                            </td>
                                            <td>
                                                <ul class="list-inline font-size-20  mb-0">
                                                    <li class="list-inline-item px-2">
                                                        <a class="btn btn-success" href="{{ route('users.edit',$user->id) }}" data-bs-toggle="tooltip" title="Edit User">
                                                            <i class="fas fa-user-edit"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item px-2">
                                                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}" data-bs-toggle="tooltip" title="View User">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item px-2">
                                                        <a class="btn btn-danger" href="{{ route('users.destroy',$user->id) }}" data-bs-toggle="tooltip" title="Delete User" onclick="delete_notifier(event,'destroy-form-{{$user->id}}','Do you want to delete this user?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </li>   
                                                    <form method="post" action="{{ route('users.destroy',$user->id) }}" style="display:none;" id="destroy-form-{{$user->id}}">
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

                            	{{ $users->links('pagination::bootstrap-4') }}
                               
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