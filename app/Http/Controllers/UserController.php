<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;

use App\User;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;

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
     * Menampilkan daftar user.
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
            ->paginate(25);

        return view('user.index', compact('user_all', 'sort', 'mode', 'cari'));
    }

    /**
     * Menampilkan form penambahan data user.
     *
     * @return Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Menyimpan data user baru ke database.
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
     * Menampilkan form ubah data user terpilih.
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
     * Memperbaharui data user terpilih.
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

        $user->save();

        return redirect()->route('user.index')
            ->with('successMessage', 'Data berhasil diperbaharui');
    }

    /**
     * Menampilkan form ubah data password user saat ini.
     *
     * @return Response
     */
    public function passwordEdit()
    {
        return view('user.passwordEdit');
    }

    /**
     * Memperbaharui password data user saat ini.
     */
    public function passwordUpdate(UpdateUserPasswordRequest $request)
    {
        $id = \Auth::user()->id;

        $user = User::findOrFail($id);

        if (\Hash::check($request->passwordLama, $user->password)) {
            $user->password = \Hash::make($request->password);
            $user->save();

            return redirect()->route('home.index')
                ->with('successMessage', 'Kata sandi berhasil diubah.');
        } else {
            return redirect()->back()
                ->with('dangerMessage', ' Password lama tidak cocok. Kata sandi gagal diubah.');
        }
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
