<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function checkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email'
        ], [
            'required' => 'Email 須填寫',
            'email' => '須為Email格式',
            'unique' => 'Email 已存在',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => 'false',
                'msg' => $validator->messages(),
            ]);
        }

        return response()->json(['result' => 'true']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->groupBy('group');
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|string|min:6',
            'confirm' => 'required|same:password',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:0,1',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->password = bcrypt($request->input('password'));
        $user->email = $request->input('email');
        $user->group = $request->input('role');
        if ($user->save() < 1) {
            return redirect()->route('user.create')->with('error', 'create user error :(');
        }

        return redirect()->route('user.create')->with('success', 'create user success :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'role' => 'required|in:0,1',
        ]);

        if ($user->id == '1') {
            return redirect()->route('user.edit', $user)->with('warning', 'This Admin Cannot Edit');
        }

        $user->group = $request->input('role');
        if ($user->save() < 1) {
            return redirect()->route('user.edit', $user)->with('error', 'Edit Error :(');
        }

        return redirect()->route('user.edit', $user)->with('success', 'Edit Success :)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id == '1') {
            return redirect()->route('user.index')->with('warning', 'This Admin Cannot Destroy');
        }

        if ($user->delete() < 1) {
            return redirect()->route('user.index')->with('error', 'Destroy Error');
        }

        return redirect()->route('user.index')->with('success', 'Destroy Success');
    }
}
