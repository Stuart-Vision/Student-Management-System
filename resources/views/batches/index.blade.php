@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Batches</h2>
        </div>
        <div class="card-body">
            <a href="{{ url('/batches/create') }}" class="btn btn-success btn-sm" title="Add New Batch">
                <i class="fa fa-plus"></i> Add New
            </a>
            <br/><br/>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Start Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($batches as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->course->name }}</td>
                                <td>{{ $item->start_date }}</td>
                                <td>
                                    <a href="{{ url('/batches/' . $item->id) }}" title="View Course">
                                        <button class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i> View
                                        </button>
                                    </a>
                                    <a href="{{ url('/batches/' . $item->id . '/edit') }}" title="Edit Batch">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </button>
                                    </a>
                                    <form method="POST" action="{{ url('/batches/' . $item->id) }}" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete course" onclick="return confirm('Confirm delete?')">
                                            <i class="fa fa-trash-o"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
