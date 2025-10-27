@extends('layouts.index')

@section('content')

    <div class="container mt-4">
        <!-- Display success message if available -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Shop List Total :</h4>
        </div>

        <!-- Add + Search Section -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Left side: Add button -->
            <a href="{{ route('shop.create') }}" class="btn btn-success">Add New Shop</a>

            <!-- Right side: Search form -->
            <form action="#" method="GET" class="d-flex" style="max-width: 300px;">
                <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
                <button class="btn btn-primary ms-2" type="submit">Search</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#Sl</th>
                    <th scope="col">Shop Name</th>
                    <th scope="col">Shop Number</th>
                    <th scope="col">Shop Phone</th>
                    <th scope="col">Shop Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($shopList as $shop)
                    <tr>
                        <th scope="row">{{ $shop->id }}</th>
                        <td>{{ $shop->shop_name }}</td>
                        <td>{{ $shop->shop_number }}</td>
                        <td>{{ $shop->shop_phone }}</td>
                        <td>{{ $shop->shop_email }}</td>
                        <td>
                            <a href="{{ route('shop.edit', $shop->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('shop.delete', $shop->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this shop?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Shop Found</td>
                    </tr>

                @endforelse
            </tbody>
        </table>
    </div>

@endsection