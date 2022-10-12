@extends('layouts/app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  
                    You are Logged In
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container">
    <div class="row m-auto">
        @foreach($catalogs as $catalog)
        <div class="col-4 mt-4">
            <div class="card">
                <img class="card-img-top" src="{{ asset('img/') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $catalog->catalog_name }}</h5>
                    <p class="card-text">{{ $catalog->catalog_path }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection