@extends('layouts.index')
@section('content')

    <div class="container mt-4">
        <h4>Create Customer</h4>

        <a href="{{ route('customer.index') }}" class="btn btn-primary mb-3">Customer List</a>


        <!-- Display success message if available -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Enter customer name" aria-describedby="emailHelp"
                        id="customer_name" name="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customer_number" class="form-label">Customer Number</label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone') }}" placeholder="Enter customer number" id="customer_number"
                        name="phone">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customer_email" class="form-label">Customer Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="Enter customer email" id="email"
                        name="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customer_image" class="form-label">Customer Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                        value="{{ old('image') }}" id="customer_image" name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customer_payment" class="form-label">Customer Payment</label>
                    <input type="text" class="form-control @error('payment') is-invalid @enderror"
                        value="{{ old('payment') }}" placeholder="Enter customer payment" id="customer_payment"
                        name="payment">
                    @error('payment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
@endsection