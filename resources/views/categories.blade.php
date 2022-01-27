@extends('layouts.app',['title'=>'Categories'])

@section('content')
    <div class="container">
        <h2 class="font-weight-normal mb-4"><i class="fas fa-1x fa-list mr-2"></i>Categories</h2>
        <div class="row justify-content-center">
            @foreach ($categories as $item)
                <div class="col-md-3">
                    <div class="card">
                        <a href="{{route('by-category',$item->slug)}}"><img src="{{asset('storage/'.$item->thumbnail)}}" class="card-img-top" height="150" style="object-fit: cover" loading="lazy"></a>
                        <div class="card-body">
                            <a href="" class="text-decoration-none text-custom-color"><h5 class="card-title my-0">{{$item->name}}</h5></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection