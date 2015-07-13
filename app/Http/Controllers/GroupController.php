<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;

use App\Group;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sort = Input::get('sort', 'nama');
        $mode = Input::get('mode', 'asc');
        $cari = Input::get('cari', '');

        $group_all = Group::
              where('nama', 'like', "%$cari%")
            ->orderBy($sort, $mode)
            ->paginate(7);

        return view('group.index', compact('group_all', 'sort', 'mode', 'cari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateGroupRequest $request)
    {
        $group = new Group;

        $group->nama = $request->nama;
        $group->keterangan = $request->keterangan;

        $group->save();

        return redirect()->route('group.create')
            ->with('successMessage', 'Grup berhasil disimpan');
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
        $group = Group::find($id);

        return view('group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateGroupRequest $request, $id)
    {
        $group = Group::find($id);

        $group->nama = $request->nama;
        $group->keterangan = $request->keterangan;

        $group->save();

        return redirect()->route('group.index')
            ->with('successMessage', 'Grup berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        $group = Group::destroy($id);

        return redirect()->route('group.index')
            ->with('infoMessage', 'Grup telah dihapus');
    }
}
