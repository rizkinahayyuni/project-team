<?php

namespace App\Http\Controllers;

use App\Models\AttendanceMonth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Validator;

class HomeController extends Controller
{
    /**
     * index
     *
     */
    public function index(Request $request)
    {
        $months = array(
            "1" => "Jan",
            "2" => "Feb",
            "3" => "Mar",
            "4" => "Apr",
            "5" => "Mei",
            "6" => "Jun",
            "7" => "Jul",
            "8" => "Aug",
            "9" => "Sep",
            "10" => "Oct",
            "11" => "Nov",
            "12" => "Des",
        );
        $years = array('2021', '2022', '2023', '2024');
        $filter_month = ($request->get('filter_month')) ? $request->get('filter_month') : Carbon::now()->month;
        $filter_year = ($request->get('filter_year')) ? $request->get('filter_year') : Carbon::now()->year;

        // Get total day in month
        $count = 0;
        $ignore = array(0, 6);
        $counter = mktime(0, 0, 0, $filter_month, 1, $filter_year);
        while (date("n", $counter) == $filter_month) {
            // $count++;
            if (in_array(date("w", $counter), $ignore) == false) {
                $count++;
            }
            $counter = strtotime("+1 day", $counter);
        }

        $total_day = $count;

        $datas = AttendanceMonth::where([
            ['month_date', '=', $filter_month],
            ['year_date', '=', $filter_year]
        ])->get();
        return view('home', compact('datas', 'months', 'years', 'total_day', 'filter_month', 'filter_year'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
