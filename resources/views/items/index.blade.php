@extends('layouts/main')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" />
@endpush

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
                    <table id="myTable" class="" style="width: 80%;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <!-- <th>Description</th> -->
                                <th style="text-align: left;">Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="col-4 text-truncate">{{ $item->name }}</td>
                                    <!-- <td>{{ $item->description }}</td> -->
                                    <td style="text-align: left;" class="col-3 text-start">{{ $item->price }}</td>
                                    <td>
                                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm"><i class="fa fa-pencil"></i></a>
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
@push('scripts')
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endpush

@endsection