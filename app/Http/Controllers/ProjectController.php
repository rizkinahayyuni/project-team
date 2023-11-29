<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Validator;

class ProjectController extends Controller
{
    /**
     * index
     *
     */
    public function index(Request $request)
    {
        $datas = Project::where([
            ['name', '!=', Null],
            [
                function ($query) use ($request) {
                    if (($keyword = $request->keyword)) {
                        $query->orWhere('name', 'LIKE', '%' . $keyword . '%')->get();
                    }
                }
            ]
        ])
            ->orderBy("id", "desc")
            ->paginate(10);
        return view('projects.index', compact('datas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Validation Error', implode(",", $validator->errors()->all()));
            return redirect()->back();
        }

        $projects = new Project();
        $projects->name = $request['name'];
        $projects->save();

        alert()->success('Success.', 'Successfully added data!');
        return redirect()->route('projects.index');
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
        $data = Project::findOrFail($id);
        $projects = Project::get();
        return view('projects.edit', compact('data', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $projects = Project::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Validation Error', implode(",", $validator->errors()->all()));
            return redirect()->back();
        }

        $projects->name = $request['name'];
        $projects->update();

        alert()->success('Success.', 'Successfully update data!');
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projects = Project::find($id);
        $projects->delete();

        alert()->success('Success.', 'Successfully delete data!');
        return redirect()->route('projects.index');
    }
}
