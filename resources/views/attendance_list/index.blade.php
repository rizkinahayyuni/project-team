@extends('layouts.sidebar')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Attendance List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Attendance List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="card-title">
                        <a href="{{ route('attendance_list.create') }}" class="btn btn-outline-primary btn-block"><i
                                class="fa fa-plus"></i> Add Attendance</a>
                    </div>
                    <div class="card-tools">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>Project</th>
                            <th>Total Hour</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td>{{$data->attendance_date}}</td>
                            <td>{{$data->user->name}}</td>
                            <td>{{$data->project->name}}</td>
                            <td>{{$data->total_hour}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('attendance_list.edit', $data->id)}}">
                                        <button type="button" class="btn btn-success mx-1">Edit</button>
                                    </a>
                                    <form action="{{ route('attendance_list.destroy', $data->id) }}" class="pull-left"
                                        method="post">
                                        <a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this data?')">
                                                Delete
                                            </button>
                                        </a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{-- <div class="d-flex"> --}}
                        {{ $datas->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
</section>
@endsection