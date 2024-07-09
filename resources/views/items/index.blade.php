@extends('layouts/main')

@section('title', 'Rendez-vous')


@section('content')


<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="content-body">
                <div class="container">
                    <h1>Items</h1>
                    <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Add Item</a>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <!-- <th>Description</th> -->
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <!-- <td>{{ $item->description }}</td> -->
                                    <td>${{ $item->price }}</td>
                                    <td>
                                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
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