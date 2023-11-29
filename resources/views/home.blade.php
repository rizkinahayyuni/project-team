@extends('layouts.sidebar')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</a></li>
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
                    <div class="card-tools">
                        <form class="float-right form-inline" id="searchForm" method="get"
                            action="{{ route('attendance_list.index') }}" role="search">
                            <select id="user_id"
                                class="form-control custom-select @error('user_id') is-invalid @enderror" name="user_id"
                                required>
                                <option selected disabled>Select Month</option>
                                @foreach($months as $key => $data)
                                <option value="{{$key}}" {{ ( \Carbon\Carbon::now()->month == $key) ? 'selected'
                                    : '' }}>{{$data}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary mx-2">Cari</button>
                            <a href="{{ route('attendance_list.index') }}">
                                <button type="button" class="btn btn-danger">Reset</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Total Present</th>
                            <th>Total Absent</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td>{{$data->attendance_date}}</td>
                            <td>{{$data->total_hour}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{-- <div class="float-right">
                    {{ $datas->links() }}
                </div> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</section>
@endsection