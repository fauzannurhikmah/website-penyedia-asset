@extends('layouts.app',['title'=>'Profile'])

@section('style')
    <style>
        .photo-profile{
            height: 380px;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-body">
                    <div class="row">
                        <div class="col">
                            <img src="{{asset('img/assets/new.png')}}" class="card-img-top photo-profile rounded">
                        </div>
                        <div class="col-md-7">
                            <section class="description">
                                <p class="bg-custom-color w-25 px-3 font-weight-bold text-white">Profile</p>
                                <h3>{{auth()->user()->email}}</h3>
                                <p class="text-primary"><i class="fas fa-user mr-2"></i>{{auth()->user()->username}} &bull; <i class="fas fa-calendar mr-2"></i>{{auth()->user()->created_at->format('d M Y')}}</p>
                            </section>
                            <section>
                                <p class="font-weight-bold"><span class="badge badge-info mr-2 p-1"><i class="fas fa-1x fa-history"></i></span>Activities</p>
                                <div class="row">
                                    <div class="col">
                                        <a href="{{route('upload-list')}}" class="text-decoration-none">
                                            <div class="card card-body text-center py-4">
                                                <h3><i class="fas fa-1x fa-upload text-success"></i></h3>
                                                <p class="font-weight-bold card-text">{{auth()->user()->assets->count()}} Uploaded</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <div class="card card-body text-center py-4">
                                            <h3><i class="fas fa-1x fa-heart text-danger"></i></h3>
                                            <p class="font-weight-bold card-text">0 Liked</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <a href="{{route('download-history')}}" class="text-decoration-none">
                                            <div class="card card-body text-center py-4">
                                                <h3><i class="fas fa-1x fa-download text-primary"></i></h3>
                                                <p class="font-weight-bold card-text">{{auth()->user()->downloads->count()}} Downloaded</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </section>
                            <section class="action mt-3 text-right">
                                <button class="btn btn-lg btn-custom rounded-0">Change Password</button>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
@endsection