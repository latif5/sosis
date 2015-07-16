<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;

use App\Contact;
use App\Group;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    /**
     * Menampilkan daftar contact.
     */
    public function index()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'nama');
        $mode = Input::get('mode', 'asc');
        $cari = Input::get('cari', '');

        $contact_all = Contact::with('group')
            ->where('nama', 'like', "%$cari%")
            ->orderBy($sort, $mode)
            ->paginate(7);

        return view('contact.index', compact('contact_all', 'sort', 'mode', 'cari'));
    }

    /**
     * Menampilkan form penambahan data contact.
     */
    public function create()
    {
        // Ambil data group, lalu format menjadi list
        $group_options = Group::orderBy('nama')->lists('nama', 'id');

        return view('contact.create', compact('group_options'));
    }

    /**
     * Menyimpan data contact baru ke database.
     */
    public function store(CreateContactRequest $request)
    {
        $contact = new Contact;

        $contact->nama = $request->nama;
        $contact->ponsel = $request->ponsel;
        $contact->keterangan = $request->keterangan;

        $contact->save();

        $contact_last = Contact::findOrFail($contact->id);

        // Merelasikan contact yang baru ditambahkan dengan group terpilih
        $contact_last->group()->attach($request->group);

        return redirect()->route('contact.create')
            ->with('successMessage', 'Kontak berhasil disimpan');
    }

    /**
     * Menampilkan detil data contact terpilih.
     */
    public function show($id)
    {
        //
    }

    /**
     * Menampilkan form ubah data contact terpilih.
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);

        // Ambil data group, lalu format menjadi list
        $group_options = Group::orderBy('nama')->lists('nama', 'id');

        // Buat array dari daftar id group yang dimiliki contact
        foreach ($contact->group as $group) {
            $group_selected[] = $group->id;
        }

        return view('contact.edit', compact('contact','group_options', 'group_selected'));
    }

    /**
     * Memperbaharui data contact terpilih.
     */
    public function update(UpdateContactRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->nama = $request->nama;
        $contact->ponsel = $request->ponsel;
        $contact->keterangan = $request->keterangan;

        $contact->save();

        return redirect()->route('contact.index')
            ->with('successMessage', 'Kontak berhasil diperbaharui');
    }

    /**
     * Mengapus data contact terpilih.
     */
    public function delete($id)
    {
        $contact = Contact::destroy($id);

        return redirect()->back()
            ->with('infoMessage', 'Kontak telah dihapus');
    }
}
