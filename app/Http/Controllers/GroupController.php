<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;
use \Excel;

use App\Group;
use App\Contact;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Requests\UpdateGroupMemberRequest;
use App\Http\Requests\DeleteGroupRequest;

class GroupController extends Controller
{
    /**
     * Middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan data group.
     */
    public function index()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'nama');
        $mode = Input::get('mode', 'asc');
        $cari = Input::get('cari', '');

        $group_all = Group::with('contact')
            ->where('nama', 'like', "%$cari%")
            ->orderBy($sort, $mode)
            ->paginate(25);

        return view('group.index', compact('group_all', 'sort', 'mode', 'cari'));
    }

    /**
     * Menampilkan form penambahan data group.
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Menyimpan data group baru ke database.
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
     * Menampilkan form ubah data group terpilih.
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);

        return view('group.edit', compact('group'));
    }

    /**
     * Memperbaharui data group terpilih.
     */
    public function update(UpdateGroupRequest $request, $id)
    {
        $group = Group::findOrFail($id);

        $group->nama = $request->nama;
        $group->keterangan = $request->keterangan;

        $group->save();

        return redirect()->route('group.index')
            ->with('successMessage', 'Grup berhasil diperbaharui');
    }

    /**
     * Menampilkan form ubah member group terpilih.
     */
    public function memberEdit($id)
    {
        $group = Group::findOrFail($id);

        // Ambil data contact, lalu format menjadi list
        $contact_options = Contact::orderBy('nama')->lists('nama', 'id');

        // Buat array dari daftar id contact yang dimiliki group
        foreach ($group->contact as $contact) {
            $contact_selected[] = $contact->id;
        }

        // Menambah nilai array untuk mencegah error jika contact tidak memiliki contact satupun
        $contact_selected[] = '';

        return view('group.memberEdit', compact('group', 'contact_options', 'contact_selected'));
    }

    /**
     * Memperbaharui data member group terpilih.
     */
    public function memberUpdate(UpdateGroupMemberRequest $request, $id)
    {
        $group = Group::findOrFail($id);

        // Memperbaharui relasi group dengan contact terpilih
        // Jika nilai array adalah null, maka detach all relations
        if ($request->contact != null) {
            $group->contact()->sync($request->contact);
        } else {
            $group->contact()->detach();
        }

        return redirect()->route('group.member.edit', $group->id)
            ->with('successMessage', 'Anggota grup berhasil diperbaharui');
    }

    /**
     * Menampilkan data contact dalam bentuk plain.
     */
    public function exportPlain()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'nama');
        $mode = Input::get('mode', 'asc');
        $cari = Input::get('cari', '');

        $group_all = Group::with('contact')
            ->where('nama', 'like', "%$cari%")
            ->orderBy($sort, $mode)
            ->get();

        return view('group.plain', compact('group_all', 'sort', 'mode', 'cari'));
    }

    /**
     * Menampilkan data contact dalam bentuk format file.
     */
    public function export($format)
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'nama');
        $mode = Input::get('mode', 'asc');
        $cari = Input::get('cari', '');

        $group_all = Group::with('contact')
            ->where('nama', 'like', "%$cari%")
            ->orderBy($sort, $mode)
            ->get();

        Excel::create('Data Grup', function($excel) use ($sort, $mode, $cari, $group_all){
            $excel->sheet('New sheet', function($sheet) use ($sort, $mode, $cari, $group_all){
                $sheet->loadView('group.plain', compact('sort', 'mode', 'cari', 'group_all'));
                
                $sheet->setOrientation('landscape');
                
            });
        })->export($format);
    }

    /**
     * Menghapus data group terpilih.
     */
    public function delete($id)
    {
        $group = Group::destroy($id);

        return redirect()->back()
            ->with('infoMessage', 'Grup telah dihapus');
    }

    /**
     * Mengapus beberapa data terpilih dari group.
     */
    public function deleteMultiple(DeleteGroupRequest $request)
    {
        // Cek jika ceklist terisi
        if ($request->check != null) {
            $group = Group::destroy($request->check);

            $statusAlert = 'infoMessage';
            $messageAlert = 'Sebanyak '.count($request->check).' data telah dihapus';
        } else {
            $statusAlert = 'dangerMessage';
            $messageAlert = 'Tidak ada data terpilih';
        }

        return redirect()->back()
            ->with($statusAlert, $messageAlert);
    }
}
