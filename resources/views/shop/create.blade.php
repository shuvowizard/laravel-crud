@extends('layouts.index')
@section('content')

    <div class="container mt-4">
        <h4>Create Shop</h4>

        <a href="{{ route('shop.index') }}" class="btn btn-primary mb-3">Shop List</a>


        <!-- Display success message if available -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <form action="{{ route('shop.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Shop Name</label>
                    <input type="text" class="form-control @error('shop_name') is-invalid @enderror"
                        value="{{ old('shop_name') }}" placeholder="Enter shop name" aria-describedby="emailHelp"
                        id="exampleInputEmail1" name="shop_name">
                    @error('shop_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="shop_name" class="form-label">Shop Number</label>
                    <input type="number" class="form-control @error('shop_number') is-invalid @enderror"
                        value="{{ old('shop_number') }}" placeholder="Enter shop number" id="shop_name"
                        name="shop_number">
                    @error('shop_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="shop_address" class="form-label">Shop Address</label>
                    <input type="text" class="form-control @error('shop_address') is-invalid @enderror"
                        value="{{ old('shop_address') }}" placeholder="Enter shop address" id="shop_address"
                        name="shop_address">
                    @error('shop_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="shop_phone" class="form-label">Shop Phone</label>
                    <input type="phone" class="form-control @error('shop_phone') is-invalid @enderror"
                        value="{{ old('shop_phone') }}" placeholder="Enter shop phone" id="shop_phone"
                        name="shop_phone">
                    @error('shop_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="shop_email" class="form-label">Shop Email</label>
                    <input type="email" class="form-control @error('shop_email') is-invalid @enderror"
                        value="{{ old('shop_email') }}" placeholder="Enter shop email" id="shop_email"
                        name="shop_email">
                    @error('shop_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
@endsection