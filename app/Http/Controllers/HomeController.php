<?php

namespace App\Http\Controllers;

use App\Models\AttendanceList;
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
        $datas = AttendanceList::
            select('attendance_date', DB::raw('count(total_hour) as total_hour'))
            ->where([
                ['attendance_date', '!=', Null],
                [
                    function ($query) use ($request) {
                        if (($keyword = $request->keyword)) {
                            $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                                ->orWhere('email', 'LIKE', '%' . $keyword . '%')->get();
                        }
                    }
                ]
            ])
            ->orderBy("id", "desc")
            ->groupBy('attendance_date', 'id')
            ->paginate(10);
        return view('home', compact('datas', 'months'))
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
