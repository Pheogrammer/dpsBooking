@extends('layouts.view')

@section('content')
    <div class="container">
        <div class="py-5 text-center">
            <h2>Booking Form</h2>
            <p class="lead">Please fill the form below, make sure to fill all required sections and validate your data
                before submitting.
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
        <div class="row">

            <div class="col order-md-1">
                <form class="needs-validation" action="{{ route('bookVenuePost') }}"  enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <h4 class="mb-3">Personal Information</h4>
                    <input type="text" name="id" value="{{ $room->id }}" hidden>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Full Name<sup class='text-danger'>*</sup></label>
                            <input type="text" placeholder="Your name"
                                class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                placeholder="" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email<sup class='text-danger'>*</sup></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Your email" value="{{ old('email') }}" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address for receiving updates.
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone">Phone Number<sup class='text-danger'>*</sup></label>
                            <input type="tel" placeholder="Your phone"
                                class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                placeholder="" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Your address" value="{{ old('address') }}">
                        </div>
                    </div>

                    <br>
                    <h4 class="mb-3">Booking Information</h4>

                    <div class="mb-3">
                        <label for="purpose">Purpose of Booking/Name of event<sup class='text-danger'>*</sup></label>
                        <input type="text" class="form-control @error('purpose') is-invalid @enderror" id="purpose"
                            name="purpose" placeholder="Write the purpose of booking or the name of event"
                            value="{{ old('purpose') }}" required>
                        <div class="invalid-feedback">
                            Purpose is required.
                        </div>
                        @error('purpose')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="entity">Name of the entity booking<sup class='text-danger'>*</sup></label>
                            <input type="text" placeholder="Entity/company name"
                                class="form-control @error('entity') is-invalid @enderror" id="entity" name="entity"
                                placeholder="" value="{{ old('entity') }}" required>
                            @error('entity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="participants">Approximately total participants<sup
                                    class='text-danger'>*</sup></label>
                            <input type="number" max="{{ $room->max_capacity }}" min="{{ $room->min_capacity }}"
                                class="form-control @error('participants') is-invalid @enderror" name="participants"
                                id="participants" placeholder="Total participants" value="{{ old('participants') }}"
                                >
                            <small class="form-text text-danger">
                                Max: {{ $room->max_capacity }}, Min: {{ $room->min_capacity }}
                            </small>
                            @error('participants')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date">Start date<sup class='text-danger'>*</sup></label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                id="start_date" name="start_date" value="{{ old('start_date') }}"
                                min="{{ date('Y-m-d') }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date">End date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                id="end_date" name="end_date" value="{{ old('end_date') }}"
                                min="{{ date('Y-m-d') }}">
                            <small class="form-text text-muted">
                                If the event is single day, the end date can be left out.
                            </small>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="attachment">Attachment <span class="text-muted">(Optional)</span></label>
                        <input type="file" class="form-control @error('attachment') is-invalid @enderror"
                            id="attachment" name="attachment" >
                        @error('attachment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="mb-4">
                    <b>Would you like us to include conference services?</b>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" value="yes" name="paymentMethod" type="radio"
                                class="custom-control-input" required>
                            <label class="custom-control-label" for="credit">Yes</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" value="no" name="paymentMethod" type="radio"
                                class="custom-control-input" checked required>
                            <label class="custom-control-label" for="debit">No</label>
                        </div>
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                </form>

            </div>
        </div>


    </div>
@endsection
