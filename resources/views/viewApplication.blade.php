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

                        <h4 class="mb-3">Personal Information</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <b for="name">Full Name<sup class='text-danger'>*</sup></b>
                                {{ $data->name }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <b for="email">Email<sup class='text-danger'>*</sup></b>
                                {{ $data->email }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <b for="phone">Phone Number<sup class='text-danger'>*</sup></b>
                                {{ $data->phone }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <b for="address">Address</b>
                                {{ $data->adress }}
                            </div>
                        </div>

                        <br>
                        <h4 class="mb-3">Booking Information</h4>

                        <div class="mb-3">
                            <b for="purpose">Purpose of Booking/Name of event<sup class='text-danger'>*</sup></b>
                            {{ $data->purpose }}
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <b for="entity">Name of the entity booking<sup class='text-danger'>*</sup></b>
                                {{ $data->entity }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <b for="participants">Approximately total participants<sup class='text-danger'>*</sup></b>
                                {{ $data->number_of_participants }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col  ">
                                <b> From:</b> {{ (new DateTime($data->start_date))->format('d/m/Y') }} - <b>To:</b>
                                {{ (new DateTime($data->end_date))->format('d/m/Y') }}

                            </div>
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
                                </tr>
                            </thead>
                            <tbody>

                               @foreach ($other as $other)
                               <tr>
                                <td>{{$other->name}}</td>
                                <td>{{$other->from}}</td>
                                <td>{{$other->number_of_participants}}</td>
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
