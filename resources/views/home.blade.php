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
                            action="{{ route('home.index') }}" role="search">
                            <select id="filter_month"
                                class="mx-2 form-control custom-select @error('filter_month') is-invalid @enderror"
                                name="filter_month" required>
                                <option selected disabled>Select Month</option>
                                @foreach($months as $key => $data)
                                <option value="{{$key}}" {{ ( $filter_month==$key) ? 'selected' : '' }}>{{$data}}
                                </option>
                                @endforeach
                            </select>
                            <select id="filter_year"
                                class="form-control custom-select @error('filter_year') is-invalid @enderror"
                                name="filter_year" required>
                                <option selected disabled>Select Year</option>
                                @foreach($years as $data)
                                <option value="{{$data}}" {{ ( $filter_year==$data) ? 'selected' : '' }}>{{$data}}
                                </option>
                                @endforeach
                                {{-- <option value="2021" {{ ( $filter_year=='2021' ) ? 'selected' : '' }}>2021</option>
                                <option value="2022" {{ ( \Carbon\Carbon::now()->year == '2022') ? 'selected'
                                    : '' }}>2022</option>
                                <option value="2023" {{ ( \Carbon\Carbon::now()->year == '2023') ? 'selected'
                                    : '' }}>2023</option>
                                <option value="2024" {{ ( \Carbon\Carbon::now()->year == '2024') ? 'selected'
                                    : '' }}>2024</option> --}}
                            </select>
                            <button type="submit" class="btn btn-primary mx-2">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Name</th>
                            <th>Total Present</th>
                            <th>Result Present in Month</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td>{{$data->month_date}}</td>
                            <td>{{$data->year_date}}</td>
                            <td>{{$data->user_name}}</td>
                            <td>{{$data->total_present}}</td>
                            <td>{{$data->total_present}}/{{$total_day}}</td>
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