@extends('layouts.admin',['title'=>'User Detail'])

@section('content')
<section class="section">
  <div class="section-header">
      <h1>User Detail</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">User</a></div>
          <div class="breadcrumb-item">Detail</div>
          </div>
  </div>
  <div class="card">
      <div class="row">
          <div class="col-md-5">
              <img src="{{asset('img/assets/cool-boy2.jpg')}}" alt="" class="rounded w-100">
          </div>
          <div class="col-md-7">
              <div class="card-body">
                  <a href="{{route('users')}}" class="btn btn-primary float-right"><i class="fas fa-times"></i></a>
                  <h3>{{$user->username}}</h3>
                  <p class="text-primary"><i class="fas fa-calendar mr-2"></i>{{$user->created_at->format('d M Y')}}</p>
                  <section class="email my-4">
                      <h6>Email :</h6>
                      <p class="my-1"><i class="fas fa-envelope mr-2"></i>{{$user->email}}</p>
                  </section >
                  <section class="activities my-4">
                    <h6>Activities :</h6>
                    <div class="row">
                        <div class="col">
                          <div class="card card-info card-body">
                              <p class="text-center my-0"><i class="fas fa-2x fa-heart text-danger"></i></p>
                              <p class="text-center font-weight-bold my-0">0 Like</p>
                          </div>
                        </div>
                        <div class="col">
                          <div class="card card-info card-body">
                              <p class="text-center my-0"><i class="fas fa-2x fa-upload text-success"></i></p>
                              <p class="text-center font-weight-bold my-0">{{$user->assets->count()}} Upload</p>
                          </div>
                        </div>
                        <div class="col">
                          <div class="card card-info card-body">
                              <p class="text-center my-0"><i class="fas fa-2x fa-download text-primary"></i></p>
                              <p class="text-center font-weight-bold my-0">{{$user->downloads->count()}} Download</p>
                          </div>
                        </div>
                    </div>
                  </section>
                  <section class="subcription my-4">
                    <h6>Subcription :</h6>
                    <div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" disabled>
                            <label class="custom-control-label" for="customRadio1">Yes</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" disabled checked>
                            <label class="custom-control-label" for="customRadio2">No</label>
                        </div>
                    </div>
                  </section>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection