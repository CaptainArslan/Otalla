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
<!-- <pre>
    <?php  
        foreach($catalogs as  $catalog)
        {
            $data = json_decode($catalog->catalog_path);
            print_r($data[0]->original_name ."<br>");
        }
    ?>
</pre> -->
<div class="container">
    <div class="row m-auto">
        @foreach($catalogs as  $catalog)
        <?php 
            $data = json_decode($catalog->catalog_path);
        ?>
        <div class="col-4 mt-4">
            <div class="card">
                <!-- <img class="card-img-top" src="{{ asset('storage') }}\{{$data[0]->download_link}}" alt="Card image cap"> -->
                <a href="{{ asset('storage') }}\{{$data[0]->download_link}}" download="{{ asset('storage') }}\{{$data[0]->download_link}}">{{$data[0]->original_name}}</a>
                <!-- <img class="card-img-top" src="{{ asset('storage/catalogs/October2022/1.jpeg') }}" alt="Card image cap"> -->
                <div class="card-body">
                    <h5 class="card-title">{{ $catalog->catalog_name }}</h5>
                    <!-- <p class="card-text">{{ asset('storage/app/public/catalog/October2022/aR4ULLdIKlI2Qtlg2FRW.pdf') }}</p> -->
                    <!-- <p class="card-text">{{ storage_path('app\public') }}\{{$data[0]->download_link}}</p> -->
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection