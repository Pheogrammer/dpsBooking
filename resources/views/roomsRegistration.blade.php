@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Room Registration') }}</div>

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

                        <form action="{{ route('roomsRegistrationPost') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="">Room Name</label>
                                <input type="text" name="room_name" id="" class="form-control" placeholder=""
                                    aria-describedby="helpId">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="">Room Location</label>
                                <input type="text" name="location" id="" class="form-control" placeholder=""
                                    aria-describedby="helpId">
                            </div>
                            <br>
                            <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                                <div class="col  ">
                                    <div class="form-group">
                                        <label for="">Maximum Capacity</label>
                                        <input type="number" name="max_capacity" id="" class="form-control"
                                            placeholder="" aria-describedby="helpId">
                                    </div>
                                </div>
                                <div class="col  ">
                                    <div class="form-group">
                                        <label for="">Minimum Capacity</label>
                                        <input type="number" name="min_capacity" id="" class="form-control"
                                            placeholder="" aria-describedby="helpId">
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
                                <input type="file" class="form-control" name="image3" id="image3" accept="image/*"
                                    onchange="previewImage(this, 'imagePreview3')">
                                <img id="imagePreview3" class="image-preview" src="#" alt="Image Preview">
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" onclick="">Cancel</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
