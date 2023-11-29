<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Validator;

class UserController extends Controller
{
    /**
     * index
     *
     */
    public function index(Request $request)
    {
        $datas = User::where([
            ['name', '!=', Null],
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
            ->paginate(10);
        return view('users.index', compact('datas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            Alert::error('Validation Error', implode(",", $validator->errors()->all()));
            return redirect()->back();
        }

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        alert()->success('Success.', 'Successfully added data!');
        return redirect()->route('users.index');
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
        $data = User::findOrFail($id);
        $user = User::get();
        return view('users.edit', compact('data', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            Alert::error('Validation Error', implode(",", $validator->errors()->all()));
            return redirect()->back();
        }

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->update();

        alert()->success('Success.', 'Successfully update data!');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        alert()->success('Success.', 'Successfully delete data!');
        return redirect()->route('users.index');
    }
}
