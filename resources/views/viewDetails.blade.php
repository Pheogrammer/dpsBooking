@extends('layouts.view')

@section('content')
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">{{ $room->room_name }}</h1>
                <p class="lead text-muted">This Venue/Room is located at {{ $room->location }} </p>
                <p>Capacity: The Venue/Room can accomodate a maximum of <b>{{ $room->max_capacity }}</b> people and minimum
                    of <b>{{ $room->min_capacity }} people</b></p>
                <p>
                    <a href="{{ route('bookVenue', $room->id) }}" class="btn btn-primary my-2">Book This Venue</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="px-3">

                <div class="row">
                    @if ($room->image1)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" src="{{ asset($room->image1) }}" alt="Card image cap"
                                    style="height: 300px; object-fit: cover;">
                            </div>
                        </div>
                    @endif
                    @if ($room->image2)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" src="{{ asset($room->image2) }}" alt="Card image cap"
                                    style="height: 300px; object-fit: cover;">
                            </div>
                        </div>
                    @endif
                    @if ($room->image3)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" src="{{ asset($room->image3) }}" alt="Card image cap"
                                    style="height: 300px; object-fit: cover;">
                            </div>
                        </div>
                    @endif
                </div>


            </div>
        </div>

    </main>
@endsection
