<?php

namespace App\Http\Controllers;

use App\Models\AttendanceList;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Validator;

class AttendanceListController extends Controller
{
    /**
     * index
     *
     */
    public function index(Request $request)
    {
        $datas = AttendanceList::where([
            ['attendance_date', '!=', Null]
        ])
            ->orderBy("id", "desc")
            ->paginate(10);
        return view('attendance_list.index', compact('datas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $projects = Project::all();
        return view('attendance_list.create', compact('users', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attendance_date' => 'required',
            'total_hour' => 'required|numeric|gt:0',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        if ($validator->fails()) {
            Alert::error('Validation Error', implode(",", $validator->errors()->all()));
            return redirect()->back();
        }

        $attendance_list = new AttendanceList();
        $attendance_list->attendance_date = $request['attendance_date'];
        $attendance_list->total_hour = $request['total_hour'];
        $attendance_list->user_id = $request['user_id'];
        $attendance_list->project_id = $request['project_id'];
        $attendance_list->save();

        alert()->success('Success.', 'Successfully added data!');
        return redirect()->route('attendance_list.index');
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
        $data = AttendanceList::findOrFail($id);
        $attendance_list = AttendanceList::get();
        $users = User::all();
        $projects = Project::all();
        return view('attendance_list.edit', compact('data', 'attendance_list', 'users', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attendance_list = AttendanceList::find($id);

        $validator = Validator::make($request->all(), [
            'attendance_date' => 'required',
            'total_hour' => 'required|numeric|gt:0',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        if ($validator->fails()) {
            Alert::error('Validation Error', implode(",", $validator->errors()->all()));
            return redirect()->back();
        }

        $attendance_list->attendance_date = $request['attendance_date'];
        $attendance_list->total_hour = $request['total_hour'];
        $attendance_list->user_id = $request['user_id'];
        $attendance_list->project_id = $request['project_id'];
        $attendance_list->update();

        alert()->success('Success.', 'Successfully update data!');
        return redirect()->route('attendance_list.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attendance_list = AttendanceList::find($id);
        $attendance_list->delete();

        alert()->success('Success.', 'Successfully delete data!');
        return redirect()->route('attendance_list.index');
    }
}
