@extends('layouts.admin.main')
@section('content')
<div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <ul>
                        @foreach($user->accounts as $account)
                            <li> {{ $account->name }} </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection