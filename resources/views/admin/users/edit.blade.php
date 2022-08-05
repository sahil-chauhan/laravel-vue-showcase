@extends('layouts.admin.main')

@section('css')
<link href="{{ URL::asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('content')

<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Users</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">All Users</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
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
                        <h4 class="card-title mb-4">Edit User</h4>

                        @if (session('success'))
                                    <br>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                        <form action="{{ route('users.update',$user->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                          
                            <div class="row">                                    
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $user->name }}" id="username" name="name" autofocus 
                                            placeholder="Enter username">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail"
                                        value="{{ $user->email }}" name="email" placeholder="Enter email"  >
                                        @error('email')
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
                                        <label for="userpassword" class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" name="password"
                                            placeholder="Enter password"  >
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="confirmpassword" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmpassword" name="password_confirmation"
                                        name="password_confirmation" placeholder="Enter Confirm password" >
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="font-size-14 ">Access Level</h6>
                                    @foreach( $access_levels as $access_level)            
                                        <div class="form-check mb-3 form-check-inline">
                                            <input @if($user->access_level == $access_level->id) checked="checked" @endif class="form-check-input @error('access_level') is-invalid @enderror" type="radio" name="access_level" id="access_level-{{ $access_level->id }}" value="{{ $access_level->id }}">
                                            <label class="form-check-label" for="access_level-{{ $access_level->id }}">{{ $access_level->name }}</label>
                                        </div>
                                        @if($loop->last)
                                            @error('access_level')
                                                <div class="@error('access_level') is-invalid @enderror"></div>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        @endif
                                    @endforeach

                                </div>

                                <div class="col-md-6">
                                    <label for="account" class="form-label">Select Account</label>
                                    <select name="account" 
                                    id="account" 
                                    class="select2 form-control @error('account') is-invalid @enderror">
                                        <option value="">Choose Account</option>
                                        @foreach($accounts as $account)
                                            <option @if($account->id == $user_selected_account) selected="selected" @endif 
                                            value="{{ $account->id }}">{{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('account')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror    
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
<script src="{{ URL::asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script type="text/javascript">

   $(".select2").select2();

</script>
@endsection