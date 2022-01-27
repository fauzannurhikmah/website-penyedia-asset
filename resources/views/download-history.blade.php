@extends('layouts.app',['title'=>"Your Download History"])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="font-weight-normal mb-4 custom-font"><i class="fas fa-1x fa-download mr-2"></i>Your Download History</h2>
                <div class="card">
                    <ul class="list-group list-group-flush">
                        @foreach ($downloads as $item)
                          <li class="list-group-item"><a href="{{route('detail-asset',$item->asset->slug)}}">{{$item->asset->name}}</a> &bull; {{$item->created_at}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="text-center d-flex justify-content-center">
                  {!! $downloads->links() !!}
              </div>
            </div>
        </div>
    </div>
@endsection