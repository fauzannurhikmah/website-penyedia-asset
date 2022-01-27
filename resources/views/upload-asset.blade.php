@extends('layouts.app',['title'=>'Upload Asset'])

@section('style')
    {{-- <link rel="stylesheet" href="{{asset('vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}"> --}}
    <style>
        .list-group .list-group-item{
            border:none;
        }
        .list-group-item.active{
            background:#6c757d;
            border-radius:.25rem;
        }
        .bootstrap-tagsinput {
            background-color: #fdfdff;
            border-color: #e4e6fc;
            display: block;
            min-height: 46px;
            box-shadow: none;
            line-height: 2.5;
            overflow: auto; }
        .bootstrap-tagsinput input {
            height: 100%;
            padding: 0 8px; }
        .bootstrap-tagsinput .tag {
            background-color: #6777ef;
            border-radius: 3px;
            padding: 5px 10px; }
        .bootstrap-tagsinput .tag:first-child {
            margin-left: 5px; }
        .bootstrap-tagsinput:focus {
            background-color: #fefeff;
            border-color: #95a0f4; }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="mb-4"><i class="fas fa-1x fa-upload mr-2"></i>Upload</h3>
                <upload-form></upload-form>
            </div>
        </div>
    </div>
@endsection

{{-- @push('script')
    <script src="{{asset('vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
@endpush --}}