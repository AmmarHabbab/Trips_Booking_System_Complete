
@extends('pages.master')

@section('content')
        <!-- Blog Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Blog Detail Start -->
                        <div class="pb-3">
                            <div class="blog-item">
                            </div>
                            <div class="bg-white mb-3" style="padding: 30px;">
                                <h1>{{$chart->options['chart_title']}}</h1>
                                {!! $chart->renderHtml() !!} 
                               
                            </div>
                        </div>
                        <!-- Blog Detail End -->


  

    {!!$chart->renderChartJsLibrary()!!}
    {!!$chart->renderJs()!!}


    @endsection