@extends('layouts.view')

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row">

                <div class="col-md-12 text-center">
                    <h2 class="heading-section mb-5 pb-md-4">
                        <span class="flaticon-bed"></span>Choose a Venue/Room you would like to book today
                    </h2>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{ Session::get('message') }}</li>
                        </ul>
                    </div>
                @endif
                </div>

                <div class="col-md-12">
                    <div class="featured-carousel owl-carousel">
                        @foreach ($rooms as $item)
                            @php
                                $imageUrls = [];
                                if ($item->image1) {
                                    $imageUrls[] = asset($item->image1);
                                }
                                if ($item->image2) {
                                    $imageUrls[] = asset($item->image2);
                                }
                                if ($item->image3) {
                                    $imageUrls[] = asset($item->image3);
                                }
                                shuffle($imageUrls); // Shuffle the array to mix images
                            @endphp
                            <div class="item">
                                <div class="blog-entry" style="height: 470px;">
                                    <a href="#" class="block-20 d-flex align-items-start"
                                        style="background-image: url('{{ $imageUrls[0] }}');">
                                    </a>
                                    <div class="text border border-top-0 p-4">
                                        <h3 class="heading"><a href="#">{{ $item->room_name }}</a></h3>
                                        <p>{{ \Illuminate\Support\Str::limit($item->location, 50, '...') }}</p>
                                        <div class="d-flex align-items-center mt-4">
                                            <p class="mb-0"><a href="{{ route('viewDetails', $item->id) }}"
                                                    class="btn btn-primary">View Details
                                                    <span class="ion-ios-arrow-round-forward"></span></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($rooms as $item1)
                            @php
                                $imageUrls1 = [];
                                if ($item1->image1) {
                                    $imageUrls1[] = asset($item1->image1);
                                }
                                if ($item1->image2) {
                                    $imageUrls1[] = asset($item1->image2);
                                }
                                if ($item1->image3) {
                                    $imageUrls1[] = asset($item1->image3);
                                }
                                shuffle($imageUrls1); // Shuffle the array to mix images
                            @endphp
                            <div class="item">
                                <div class="blog-entry" style="height: 470px;">
                                    <a href="#" class="block-20 d-flex align-items-start"
                                        style="background-image: url('{{ $imageUrls1[0] }}');">
                                    </a>
                                    <div class="text border border-top-0 p-4">
                                        <h3 class="heading"><a href="#">{{ $item1->room_name }}</a></h3>
                                        <p>{{ \Illuminate\Support\Str::limit($item1->location, 50, '...') }}</p>
                                        <div class="d-flex align-items-center mt-4">
                                            <p class="mb-0"><a href="{{ route('viewDetails', $item1->id) }}"
                                                    class="btn btn-primary">View Details
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
