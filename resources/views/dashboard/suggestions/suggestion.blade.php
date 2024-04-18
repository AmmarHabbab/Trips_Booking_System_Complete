
@extends('pages.master')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="pb-3">
                    <div class="blog-item">

                    </div>
                    <div class="bg-white mb-3" style="padding: 30px;">
                        <div class="d-flex mb-3">
                            <a class="text-primary text-uppercase text-decoration-none" href="">{{$suggestion->type}}</a>       </div>
                        <p class="mb-3">{{$suggestion->body}}</p>
                       
                    </div>
                </div>


@endsection