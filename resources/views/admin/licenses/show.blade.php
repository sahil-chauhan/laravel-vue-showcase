@extends('layouts.admin.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">License Details</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('licenses.index') }}">All Licenses</a></li>
                            <li class="breadcrumb-item active">License Details</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                    	<p> 
                    		License Key : <code id="license_key">{{ $license->license_key }}</code> 

                            <button data-clipboard-target="#license_key" 
                            data-bs-toggle="tooltip" title="Copy"  aria-label="Done"
                            class="btn btn-success"><i class="fas fa-copy"></i></button> 

                    	</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('success'))
                                    <br>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif  

                                @if (session('warning'))
                                    <br>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ session('warning') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif 
                            </div>
                            <div class="col-md-8">
                                <h4 class="mb-sm-0 font-size-18">License Activations</h4>
                            </div>
                            <div class="col-md-4">
                                <a data-bs-toggle="tooltip" title="Add Activation" 
                                class="btn btn-success float-end" href="{{ route('activations.create',$license->id) }}">
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            </div>
                        </div>
                        



                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Site Url</th>
                                    <th>Domain</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( $license->activations->count() )
                                    @foreach( $license->activations as $activation)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $activation->site_url }}</td>
                                            <td>{{ $activation->domain }}</td>
                                            <td>{{ $activation->created_at }}</td>
                                            <td>
                                                <a href="{{ route('activations.destroy',[ 'activation' => $activation->id , 'license' => $license->id,  ]) }}" 
                                                    data-bs-toggle="tooltip" 
                                                    title="Delete Activation" 
                                                    class="btn btn-danger"
                                                    onclick="delete_notifier(event,'destroy-form-{{$activation->id}}','Do you want to delete this License?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                <form method="post" action="{{ route('activations.destroy',['activation' => $activation->id , 'license' => $license->id, ]) }}" style="display:none;" id="destroy-form-{{$activation->id}}">
                                                    @csrf 
                                                    @method('delete')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('script-bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    var clipboard = new ClipboardJS('.btn');

    clipboard.on('success', function(e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        console.log(clipboard);

        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });
</script>
@endsection