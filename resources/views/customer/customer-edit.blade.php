@extends('layouts.index')
@section('content')

    <div class="container mt-4">
        <h4>Update Customer</h4>

        <a href="{{ route('customer.index') }}" class="btn btn-primary mb-3">Customer List</a>


        <!-- Display success message if available -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $customer->name) }}"
                        placeholder="Enter customer name" aria-describedby="emailHelp" id="customer_name" name="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customer_number" class="form-label">Customer Number</label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $customer->phone) }}" placeholder="Enter customer number" id="customer_number" name="phone">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customer_email" class="form-label">Customer Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $customer->email) }}" placeholder="Enter customer email" id="email" name="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
@endsection