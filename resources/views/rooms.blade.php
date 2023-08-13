@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                            <div class="col">
                                {{ __('Rooms') }}
                            </div>
                            <div class="col text-end">
                                <a href="{{ route('roomsRegistration') }}" class="btn btn-primary">Add Room</a>
                            </div>
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

                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>SN</th>
                                    <th>Room Name</th>
                                    <th>Location</th>
                                    <th>Capacity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $x = 1;
                                @endphp
                                @foreach ($rooms as $item)
                                    <tr>
                                        <td>{{ $x }}</td>
                                        <td>{{ $item->room_name }}</td>
                                        <td>{{ $item->location }}</td>
                                        <td>Max: {{ $item->max_capacity }} - Min: {{ $item->min_capacity }}</td>
                                        <td>

                                        </td>
                                    </tr>
                                    @php
                                        $x++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
