@extends('layouts.app',['title'=>"All Assets 3D"])

@section('content')
<div class="container">
    <div class="mb-4 px-0">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="font-weight-normal mb-0"><i class="fas fa-1x fa-cubes mr-2"></i>All Assets</h2>
                <small class="font-weight-bold my-0">Category : <span class="text-capitalize badge badge-primary p-1 rounded">{{request('category')->name}}</span></small>
            </div>
            <form action="{{route('all-asset')}}" style="width: 250px" class="">
                <div class="input-group">
                    <select class="custom-select" name="sort_by" id="inputGroupSelect04">
                      <option selected disabled>Filter</option>
                      <option value="newest">Newest</option>
                      <option value="oldest">Oldest</option>
                    </select>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-custom"><i class="fas fa-filter"></i></button>
                    </div>
                  </div>
            </form>
        </div>
    </div>

    {{-- asset card --}}
    <div class="row grid justify-content-center" data-masonry='{ "itemSelector": ".grid-item" }'>
        @if ($assets->count())
            @foreach ($assets as $asset)
                <div class="col-md-4 grid-item">
                    <div class="card">
                        <a href="{{route('detail-asset',$asset->asset->slug)}}">
                            <img src="{{asset('storage/'.$asset->image->name)}}" class="card-img-top" loading="lazy">
                            @if ($asset->licensing)
                                <span class="badge badge-info position-absolute" style="right: 2%; top: 2%;"><i class="fas fa-crown ml-0"></i></span>
                            @endif
                        </a>
                        <div class="card-body">
                        <a href="{{route('detail-asset',$asset->asset->slug)}}" class="text-decoration-none"><h5 class="card-title">{{$asset->asset->name}}</h5></a>
                        <div class="dropdown-divider" style="background-color: #e1ecfe !important; height: 2px;"></div>
                        <div class="d-flex justify-content-end">
                            <span class="badge"><i class="fas fa-copyright text-warning"></i> {{$asset->asset->licensing ? 'Premium' : 'Free'}}</span>
                                <span class="badge"><i class="fas fa-download text-primary"></i> {{$asset->download}}</span>
                                <a href="" class="text-decoration-none badge"><i class="fas fa-heart text-danger"></i> {{$asset->like}}</a>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        <div class="text-center">
            <img src="{{asset('img/assets/404.png')}}" class="d-block mx-auto" width="500">
            <a href="{{route('categories')}}" class="btn btn-lg btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        @endif
    </div>
    {{-- end asset card --}}

    <div class="text-center d-flex justify-content-center">
        {!! $assets->links() !!}
    </div>
</div>
@endsection

@push('script')
    <script src="{{asset('vendor/masonry.pkgd.min.js')}}"></script>
    <script src="js/custom.js"></script>
@endpush