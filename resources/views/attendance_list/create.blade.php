@extends('layouts.sidebar')

@section('content')
<form method="POST" action="{{ route('attendance_list.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Attendance Data</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/attendance_list') }}">Attendance</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date <code>*</code></label>
                                    <div class="input-group date" id="attendance_date" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#attendance_date" name="attendance_date" />
                                        <div class="input-group-append" data-target="#attendance_date"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @if ($errors->has('attendance_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attendance_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Total Hour <code>*</code></label>
                                    <input type="number" class="form-control" placeholder="Input Total Hour"
                                        id="total_hour" name="total_hour" value="{{ old('total_hour') }}" data-mask
                                        required>
                                    @if ($errors->has('total_hour'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('total_hour') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>User <code>*</code></label>
                                    <select id="user_id"
                                        class="form-control custom-select @error('user_id') is-invalid @enderror"
                                        name="user_id" required>
                                        <option selected disabled>Select User</option>
                                        @foreach($users as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Project <code>*</code></label>
                                    <select id="project_id"
                                        class="form-control custom-select @error('project_id') is-invalid @enderror"
                                        name="project_id" required>
                                        <option selected disabled>Select Project</option>
                                        @foreach($projects as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('project_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('project_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </section>
</form>
@endsection