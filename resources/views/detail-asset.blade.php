@extends('layouts.app',['title'=>$asset->name])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="font-weight-normal mb-4 custom-font"><i class="fas fa-1x fa-cube"></i> {{$asset->name}}</h2>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="fas fa-calendar-alt mr-2 text-success"></i>{{$asset->created_at->format('F d, Y')}}</li>
                                <li class="list-group-item"><i class="fas fa-download mr-2 text-primary"></i>{{$asset->detail->first()->download}} Downloads</li>
                                <li class="list-group-item">
                                    <a href="{{route('by-category',$asset->detail->first()->category->slug)}}" class="text-decoration-none">
                                        <i class="fas fa-list mr-2 text-danger"></i>{{$asset->detail->first()->category->name}}</li>
                                    </a>
                                <li class="list-group-item"><i class="fas fa-blender mr-2 text-info"></i>{{$asset->detail->first()->software->name}}</li>
                                <li class="list-group-item"><i class="fas fa-cogs mr-2"></i>Render : {{$asset->detail->first()->render->name}}</li>
                                <li class="list-group-item"><i class="fas fa-user mr-2 text-secondary"></i>Creator : {{$asset->detail->first()->user->username}}</li>
                                <li class="list-group-item">{!!$asset->licensing ?'<i class="fas fa-crown text-warning"></i> Premium':'<i class="fas fa-copyright mr-2 text-warning"></i>License : Free'!!}</li>
                            </ul>
                            <div class="card-body">
                                <a href="{{route('download-asset',$asset->slug)}}" type="button" class="btn {{$asset->licensing ? 'btn-warning text-white' : 'btn-custom'}} btn-block"><i class="fas fa-arrow-down"></i> Download ({{round(($asset->detail->first()->file->size/1000)/1000,1)}} mb)</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card" style="overflow: hidden">
                            <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators3" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators3" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators3" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{asset('storage/'.$asset->detail->first()->image->name)}}" alt="First slide" height="500" style="object-fit: cover">
                                    </div>
                                    <div class="carousel-item">
                                    <img class="d-block w-100" src="{{asset('img/placeholder/placeholder-2.jpg')}}" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                    <img class="d-block w-100" src="{{asset('img/placeholder/placeholder-4.jpg')}}" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5>Description: </h5>
                                <p class="card-text">
                                    {!!$asset->description!!}
                                </p>
                            </div>
                            <div class="card-footer">
                                <i class="fas fa-tags mr-2"></i>
                                @foreach ($asset->detail->first()->tags as $tag)
                                    <a href="" class="badge badge-info mr-1">{{$tag->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection