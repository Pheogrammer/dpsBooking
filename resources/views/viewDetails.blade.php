@extends('layouts.calenda')

@section('content')
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">{{ $room->room_name }}</h1>
                <p class="lead text-muted">This Venue/Room is located at {{ $room->location }} </p>
                <p>Capacity: The Venue/Room can accomodate a maximum of <b>{{ $room->max_capacity }}</b> people and minimum
                    of <b>{{ $room->min_capacity }} people</b></p>
                <p>

                <table class="table">
                    <thead>
                        <tr>
                            <td colspan="2">
                                <b>Booking Pricing:</b>
                            </td>
                        </tr>
                        <tr>
                            <td>For UDSM Staff/Member/Directorates/Company</td>
                            <td>For non UDSM Staff/Member/Directorate/Company</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ number_format($room->price) }}
                            </td>
                            <td>
                                {{ number_format($room->outsidePrice) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                </p>
                <p>
                    <a href="{{ route('bookVenue', $room->id) }}" class="btn btn-primary my-2">Book This Venue</a>
                </p>
            </div>
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
        <div id="calendar"></div>

        <script>
            jQuery(document).ready(function() {
                // Your FullCalendar initialization code here
                jQuery('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: [
                        @foreach ($bookedDates as $booking)
                            {
                                title: 'Booked',
                                start: '{{ $booking->start_date }}',
                                end: '{{ $booking->end_date }}',
                                color: '{{ $booking->color }}', // Set the color dynamically based on the booking
                            },
                        @endforeach
                    ],
                    eventRender: function(event, element) {
                        // Customize the event rendering here
                        element.css({
                            'background-color': event
                            .color, // Set the background color for the entire box
                            'color': 'white',
                            'text-align': 'center',
                            'text-transform': 'uppercase'
                        });
                        element.find('.fc-title').remove(); // Remove the default event title
                        element.html('<div style="line-height: 1.5;">Booked</div>');
                    }
                });
            });
        </script>



    </main>
@endsection
