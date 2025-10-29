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
            <h4 class="mb-0">Total Customer : {{ @$customerList }}</h4>
        </div>

        <!-- Add + Search Section -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Left side: Add button -->
            <a href="{{ route('customer.create') }}" class="btn btn-success">Add New Customer</a>

            <!-- Right side: Search form -->
            <form action="#" method="GET" class="d-flex" style="max-width: 300px;">
                <input type="text" class="form-control" placeholder="Search heare" name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-primary ms-2" type="submit">Search</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#Sl</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Phone</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td scope="row">{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>
                            @if ($customer->deleted_at != null)
                                <span class="badge bg-danger">Deleted</span>
                            @else
                                <span class="badge bg-success">Active</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            @if ($customer->deleted_at === null)
                                <form action="{{ route('customer.delete', $customer->id) }}" method="POST" style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this shop?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @else
                                <a href="{{ route('customer.restore', $customer->id) }}" class="btn btn-sm btn-warning">Restore</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Customer Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $customers->links() }}
    </div>

@endsection