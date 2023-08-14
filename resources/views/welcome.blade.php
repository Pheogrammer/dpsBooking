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
                                <div class="blog-entry">
                                    <a href="#" class="block-20 d-flex align-items-start"
                                        style="background-image: url('{{ $imageUrls[0] }}');">
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

                        <div class="item">
                            <div class="blog-entry">
                                <a href="#" class="block-20 d-flex align-items-start"
                                    style="background-image: url('images/image_6.jpg');">

                                </a>
                                <div class="text border border-top-0 p-4">
                                    <h3 class="heading"><a href="#">Finance And Legal Working Streams
                                            Occur
                                            Throughout</a></h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia
                                        and
                                        Consonantia, there live the blind texts.</p>
                                    <div class="d-flex align-items-center mt-4">
                                        <p class="mb-0"><a href="#" class="btn btn-primary">Read More
                                                <span class="ion-ios-arrow-round-forward"></span></a></p>
                                        <p class="ml-auto meta2 mb-0">
                                            <a href="#" class="mr-2">Admin</a>
                                            <a href="#" class="meta-chat"><span class="ion-ios-chatboxes"></span>
                                                3</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
