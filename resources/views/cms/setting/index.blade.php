@extends('cms._layout.app')
@section('title', 'Settings')

<!-- Optional -->
@section('sub-title')
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Setting</li>
            </ol>
            <h6 class="slim-pagetitle">Setting</h6>
        </div><!-- slim-pageheader -->
@endsection

@section('content')
<div class="section-wrapper">
    <label class="section-title">Setting Web</label>
    <p class="mg-b-20 mg-sm-b-40">Setting configurable main Website</p>

    <div class="row form-group form-group">
        <div class="col-lg-2 mg-t-10 mg-lg-t-0">
            <label for="">Title</label>
        </div>
        <div class="col-lg-7 mg-t-10 mg-lg-t-0">
            <input class="form-control" placeholder="Input box" type="text">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2 mg-t-10 mg-lg-t-0">
            <label for="">Title</label>
        </div>
        <div class="col-lg-7 mg-t-10 mg-lg-t-0">
            <input class="form-control" placeholder="Input box" type="text">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2 mg-t-10 mg-lg-t-0">
            <label for="">Title</label>
        </div>
        <div class="col-lg-7 mg-t-10 mg-lg-t-0">
            <input class="form-control" placeholder="Input box" type="text">
        </div>
    </div>


</div>
@endsection

@push('css')
@endpush

@push('script')
@endpush