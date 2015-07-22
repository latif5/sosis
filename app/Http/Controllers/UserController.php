<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;

use App\User;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'nama');
        $mode = Input::get('mode', 'asc');
        $cari = Input::get('cari', '');

        $user_all = User::
              where('nama', 'like', "%$cari%")
            ->orderBy($sort, $mode)
            ->paginate(7);

        return view('user.index', compact('user_all', 'sort', 'mode', 'cari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = new User;

        $user->nama = $request->nama;   
        $user->username = $request->username;   
        $user->group = $request->group;
        $user->keterangan = $request->keterangan;   
        $user->email = $request->email;   
        $user->password = \Hash::make($request->password);

        $user->save();

        return redirect()->route('user.create')
            ->with('successMessage', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->nama = $request->nama;   
        $user->username = $request->username;
        $user->group = $request->group;
        $user->keterangan = $request->keterangan;   
        $user->email = $request->email;   
        $user->password = $request->password;

        $user->save();

        return redirect()->route('user.index')
            ->with('successMessage', 'Data berhasil diperbaharui');
    }

    /**
     * Mengapus data terpilih dari user.
     */
    public function delete($id)
    {
        $user = User::destroy($id);

        return redirect()->back()
            ->with('infoMessage', 'Pesan telah dihapus');
    }
}
