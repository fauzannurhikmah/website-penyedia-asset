@extends('layouts.app',['title'=>'Subcription'])

@section('style')
    <style>
        .badge-best{
            position: relative;
            display: inline-block;
            width: 200px;
            left: -32px;
            color: #fff;
            font-weight: bold;
            background-color: #3abaf4 !important;
            padding:.25rem .75rem;
        }
    </style>
@endsection

@section('content')
<x-banner/>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th class="text-center">Free</th>
                        <th class="text-center">Premium</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Thousands of free resources</td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                      </tr>
                      <tr>
                        <td>100,000 Premium asset</td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                      </tr>
                      <tr>
                        <td>No Attribute required</td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                      </tr>
                      <tr>
                        <td>Unlimited downloads</td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                      </tr>
                      <tr>
                        <td>Priority support</td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-body">
                        <span class="badge-best">Best Value</span>
                        <div class="row">
                            <div class="col-8">
                                <p class="font-weight-bold mb-0">12 MONTHS</p>
                                <div class="mb-2"><h4 class="text-success d-inline">$7.49*</h4>/month</div>
                                <p class="mb-0"><span class="font-weight-bold">$88.99*</span> every <span class="font-weight-bold">12</span> months</p>
                            </div>
                            <div class="col text-center align-self-center">
                                <button class="btn btn-custom">Subcribe Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-8">
                                <p class="font-weight-bold mb-0">1 MONTH</p>
                                <div class="mb-2"><h4 class="text-success d-inline">$9.99*</h4>/month</div>
                                <p class="mb-0"><span class="font-weight-bold">$9.99*</span> every months</p>
                            </div>
                            <div class="col text-center align-self-center">
                                <button class="btn btn-custom">Subcribe Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection