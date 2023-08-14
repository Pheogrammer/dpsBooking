@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('View Room Details') }}</div>

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
                        <center>
                            <h4>{{ $room->room_name }} - {{ $room->location }}. | Capacity:
                                Min: {{ $room->max_capacity }} People - Max: {{ $room->min_capacity }} People</h4>
                        </center>
                        <div class="row">
                            <div class="row">
                                @if ($room->image1)
                                    <div class="col">
                                        <img src="{{ asset('' . $room->image1) }}" alt="Image 1" style="width: 300px;">
                                    </div>
                                @endif

                                @if ($room->image2)
                                    <div class="col">
                                        <img src="{{ asset('' . $room->image2) }}" alt="Image 2" style="width: 300px;">
                                    </div>
                                @endif

                                @if ($room->image3)
                                    <div class="col">
                                        <img src="{{ asset('' . $room->image3) }}" alt="Image 3" style="width: 300px;">
                                    </div>
                                @endif
                            </div>


                        </div>
                        <br>
                        <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                            <div class="col  ">
                                <a href="{{ route('roomsDelete', $room->id) }}" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this room and all its information?')">Delete</a>
                            </div>
                        </div>


                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">{{ __('Edit Room Details') }}</div>

                    <div class="card-body">
                        <form action="{{ route('roomsEditPost') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" value="{{ $room->id }}" hidden>
                            <div class="form-group">
                                <label for="">Room Name</label>
                                <input type="text" name="room_name" required value="{{ $room->room_name }}"
                                    id="" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="">Room Location</label>
                                <input type="text" name="location" required id="" value="{{ $room->location }}"
                                    class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                            <br>
                            <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                                <div class="col  ">
                                    <div class="form-group">
                                        <label for="">Maximum Capacity</label>
                                        <input type="number" required min="1" value="{{ $room->max_capacity }}"
                                            name="max_capacity" id="" class="form-control" placeholder=""
                                            aria-describedby="helpId">
                                    </div>
                                </div>
                                <div class="col  ">
                                    <div class="form-group">
                                        <label for="">Minimum Capacity</label>
                                        <input type="number" required min="1" value="{{ $room->min_capacity }}"
                                            name="min_capacity" id="" class="form-control" placeholder=""
                                            aria-describedby="helpId">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="image-upload form-group">
                                <label for="image1">Image 1</label>
                                <input type="file" class="form-control" name="image1" id="image1" accept="image/*"
                                    onchange="previewImage(this, 'imagePreview1')">
                                <img id="imagePreview1" class="image-preview" src="#" alt="Image Preview">
                            </div>
                            <br>
                            <div class="image-upload form-group">
                                <label for="image2">Image 2</label>
                                <input type="file" class="form-control" name="image2" id="image2" accept="image/*"
                                    onchange="previewImage(this, 'imagePreview2')">
                                <img id="imagePreview2" class="image-preview" src="#" alt="Image Preview">
                            </div>
                            <br>
                            <div class="image-upload form-group">
                                <label for="image3">Image 3</label>
                                <input type="file" class="form-control" name="image3" id="image3"
                                    accept="image/*" onchange="previewImage(this, 'imagePreview3')">
                                <img id="imagePreview3" class="image-preview" src="#" alt="Image Preview">
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-danger" onclick="">Cancel</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
