@extends('layouts.app',['title'=>'Home'])

@section('content')
<x-banner/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="caption text-center mb-5 custom-font">
                <h1 style="font-size: 3rem">Welcome to My Assets!</h1>
                <h6 class="text-secondary">create and share along with 1,464,545 other artists</h6>
            </div>
            <div class="row justify-content-center custom-font">
                <div class="col">
                    <div class="card card-body text-center">
                        <div class="icon mb-1">
                            <i class="fas fa-3x fa-archive"></i>
                        </div>
                        <p class="mb-0 font-weight-bold">{{$allAsset}} Assets</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-body text-center">
                        <div class="icon mb-1">
                            <i class="fas fa-3x fa-download"></i>
                        </div>
                        <p class="mb-0 font-weight-bold">0 Downloads</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-body text-center">
                        <div class="icon mb-1">
                            <i class="fas fa-3x fa-upload"></i>
                        </div>
                        <p class="mb-0 font-weight-bold">0 Uploads</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($assets as $asset)
                    <div class="col-md-3">
                        <div class="card">
                            @foreach ($asset->detail as $item)
                            <a href="{{route('detail-asset',$asset->slug)}}">
                                <img src="{{asset('storage/'.$item->image->name)}}" class="card-img-top" loading="lazy" height="200" style="object-fit: cover">
                            </a>
                            @endforeach
                            <div class="card-body py-2">
                                <a href="{{route('detail-asset',$asset->slug)}}" class="text-custom-color text-decoration-none">
                                    <h5 class="card-title">{{$asset->name}}</h5>
                                </a>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
