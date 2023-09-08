@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                            <div class="col">
                                Room Booking </div>

                        </div>
                    </div>

                    <div class="card-body">
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

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <h4>Personal Information</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b for="name">Full Name </b>
                                        {{ $data->name }}
                                    </td>
                                    <td>
                                        <b for="email">Email </b>
                                        {{ $data->email }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <b for="phone">Phone Number </b>
                                        {{ $data->phone }}
                                    </td>
                                    <td>
                                        <b for="address">Address </b>
                                        {{ $data->adress }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h4>Booking Information</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <b for="purpose">Purpose of Booking/Name of event</b>
                                        {{ $data->purpose }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b for="entity">Name of the entity booking</b>
                                        {{ $data->entity }}
                                    </td>
                                    <td>
                                        <b for="participants">Approximately total participants</b>
                                        {{ $data->number_of_participants }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                        <b> From:</b> {{ (new DateTime($data->start_date))->format('d/m/Y') }} - <b>To:</b>
                                        {{ (new DateTime($data->end_date))->format('d/m/Y') }}

                                    </td>
                                    <td>
                                        <b>Applied on</b>
                                        {{ (new DateTime($data->created_at))->format('d/m/Y') }}

                                    </td>

                                </tr>
                            </tbody>
                        </table>



                        <br>






                    </div>
                    <div class="card-footer">
                        <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                            @if ($data->status == 1)
                                <H3 class="bg-success">ACCEPTED</H3>
                            @elseif($data->status == 2)
                                <H3 class="bg-danger">REJECTED</H3>
                            @else
                                <div class="col  ">
                                    <a href="{{ route('AcceptApplication', $data->id) }}"
                                        class="btn btn-primary">Accept</a>
                                    <a href="{{ route('RejectApplication', $data->id) }}" class="btn btn-danger">Reject</a>

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="card">
                    <div class="card-header">
                        Other Applications for this Venue which shares date
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th>Applicant Name</th>
                                    <th>From</th>
                                    <th>Total Participants</th>
                                    <th>Application Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($other as $other)
                                    <tr @if ($other->status == 1) class='bg-success text-light' @endif>
                                        <td>{{ $other->name }}</td>
                                        <td>{{ $other->from }}</td>
                                        <td>{{ $other->number_of_participants }}</td>
                                        <td> {{ (new DateTime($other->created_at))->format('d/m/Y') }}</td>
                                        <td>
                                            @if ($other->status == 0)
                                                New Application
                                            @else
                                                Accepted Application
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
