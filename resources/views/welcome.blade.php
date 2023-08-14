@extends('layouts.view')

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="heading-section mb-5 pb-md-4">
                        <span class="flaticon-bed"></span>Choose a Venue/Room you would like to book today
                    </h2>
                    </h2>
                </div>
                <div class="col-md-12">
                    <div class="featured-carousel owl-carousel">
                        @foreach ($rooms as $item)
                            <div class="item">
                                <div class="blog-entry">
                                    <a href="#" class="block-20 d-flex align-items-start"
                                        style="background-image: url('{{ asset($item->image1) }}');">

                                    </a>
                                    <div class="text border border-top-0 p-4">
                                        <h3 class="heading"><a href="#">{{ $item->room_name }}</a></h3>
                                        <p>{{ $item->location }}.</p>
                                        <div class="d-flex align-items-center mt-4">
                                            <p class="mb-0"><a href="#" class="btn btn-primary">Read More
                                                    <span class="ion-ios-arrow-round-forward"></span></a></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($rooms as $item1)
                            <div class="item">
                                <div class="blog-entry">
                                    <a href="#" class="block-20 d-flex align-items-start"
                                        style="background-image: url('{{ asset($item1->image1) }}');">

                                    </a>
                                    <div class="text border border-top-0 p-4">
                                        <h3 class="heading"><a href="#">{{ $item1->room_name }}</a></h3>
                                        <p>{{ $item1->location }}.</p>
                                        <div class="d-flex align-items-center mt-4">
                                            <p class="mb-0"><a href="#" class="btn btn-primary">Read More
                                                    <span class="ion-ios-arrow-round-forward"></span></a></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>








                </div>
            </div>
        </div>
    </section>
@endsection
