@extends('layouts.admin',['title'=>'Detail for asset'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Asset Detail</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Assets</a></div>
                <div class="breadcrumb-item">Detail</div>
                </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <a href="{{route('assets')}}" class="btn btn-primary float-right"><i class="fas fa-times"></i></a>
                        <h3>{{$asset->name}} </h3>
                        <p class="text-primary"><i class="fas fa-user mr-2"></i>{{$asset->detail->first()->user->username}} &bull; <i class="fas fa-calendar mr-2"></i>{{$asset->created_at->format('d F Y')}}</p>
                        <section class="description my-4">
                            <h6 class="mb-1">Description</h6>
                            <p>{!!$asset->description!!}</p>
                        </section>
        
                        <section class="software my-4">
                            <h6 class="mb-1">Software</h6>
                            <p class="m-0">{{$asset->detail->first()->software->name}}</p>
                            <p class="m-0">Render Engine : Cycle</p>
                        </section>
        
                        <section class="file my-4">
                            <h6 class="mb-1">File</h6>
                            <p class="m-0">Size : {{round(($asset->detail->first()->file->size / 1000)/1000,1)}} mb</p>
                        </section>
        
                        <section class="sorting my-4">
                            <h6 class="mb-1">Sorting</h6>
                            <p class="m-0"><i class="fas fa-list mr-2"></i>Category : <span class="text-primary">{{$asset->detail->first()->category->name}}</span></p>
                            <p class="m-0"><i class="fas fa-tags mr-2"></i>Tags : 
                                @foreach ($asset->detail->first()->tags as $tag)
                                    <span class="badge badge-info mr-1">{{$tag->name}}</span>
                                @endforeach
                            </p>
                        </section>
        
                        <section class="licencing my-4">
                            <h6 class="mb-1">Licensing</h6>
                            @if ($asset->licensing)
                                <p class="m-0 text-warning"><i class="fas fa-crown mr-1"></i>Premium</p>
                            @else
                                <p class="m-0 text-primary"><i class="fas fa-check mr-1"></i>Free</p>
                            @endif
                        </section>
                    </div>
                    <div class="col-md-5 align-self-center">
                        <div class="text-center">
                            <img src="{{asset('storage/'.$asset->detail->first()->image->name)}}" alt="" class="rounded w-100 shadow-sm" >
                            <div class="card card-info card-body mt-2">
                                <h6 class="mb-0">Image Preview</h6>
                                <small class="text-primary my-0">Size : {{round($asset->detail->first()->image->size/1000)}} Kb</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
@endsection