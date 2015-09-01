<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;
use \Excel;
use \Session;

use App\Contact;
use App\Group;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Requests\DeleteContactRequest;
use App\Http\Requests\ImportContactRequest;

class ContactController extends Controller
{
    /**
     * Middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            ->paginate(25);

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

        // Ambil data contact yang terakhir ditambahkan
        $contact_last = Contact::findOrFail($contact->id);

        // Merelasikan contact yang baru ditambahkan dengan group terpilih
        $contact_last->group()->attach($request->group);

        return redirect()->route('contact.create')
            ->with('successMessage', 'Kontak berhasil disimpan');
    }

    /**
     * Menampilkan form import data contact.
     */
    public function import()
    {
        // Ambil data group, lalu format menjadi list
        $group_options = Group::orderBy('nama')->lists('nama', 'id');

        return view('contact.import', compact('group_options'));
    }

    /**
     * Menampilkan preview data import contact.
     */
    public function importPut(ImportContactRequest $request)
    {
        // Ambil data group, lalu format menjadi list
        $group_options = Group::orderBy('nama')->lists('nama', 'id');

        // Ambil data group yang telah dipilih sebelumnya
        $group_selected = $request->group;

        $excel = Excel::load($request->file('data'), function($reader) {
            // Agar tidak menganggap bahwa baris pertama adalah header
            // Serta agar mengubah offset array menjadi numeric, bukan string header
            $reader->noHeading();
        })->get();

        // Session kan data excel
        Session::put('data_excel', $excel);

        return view('contact.preview', compact('excel', 'group_options', 'group_selected'))
            ->with('successMessage', 'Sebanyak '.count($excel).' data akan diimpor');
    }

    /**
     * Memasukkan data import ke tabel contact.
     */
    public function importPost(ImportContactRequest $request)
    {
        $excel = Session::pull('data_excel');

        foreach ($excel as $excel_row) {
            // Memasukkan contact ke database
            $contact = new Contact;

            $contact->nama = $excel_row[0];
            $contact->keterangan = $excel_row[1];
            $contact->ponsel = $excel_row[2];

            $contact->save();

            // Ambil data contact yang terakhir ditambahkan
            $contact_last = Contact::findOrFail($contact->id);

            // Merelasikan contact yang baru ditambahkan dengan group terpilih
            $contact_last->group()->attach($request->group);
        }

        return redirect()->route('contact.index')
            ->with('successMessage', 'Sebanyak '.count($excel).' data telah diimpor');
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

        // Menambah nilai array untuk mencegah error jika contact tidak memiliki group satupun
        $group_selected[] = '';

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

        // Memperbaharui relasi contact dengan group terpilih
        // Jika nilai array adalah null, maka detach all relations
        if ($request->group != null) {
            $contact->group()->sync($request->group);
        } else {
            $contact->group()->detach();
        }

        return redirect()->back()
            ->with('successMessage', 'Kontak berhasil diperbaharui');
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

        $contact_all = Contact::with('group')
            ->where('nama', 'like', "%$cari%")
            ->orderBy($sort, $mode)
            ->get();

        return view('contact.plain', compact('contact_all', 'sort', 'mode', 'cari'));
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

        $contact_all = Contact::with('group')
            ->where('nama', 'like', "%$cari%")
            ->orderBy($sort, $mode)
            ->get();

        Excel::create('Data Kontak', function($excel) use ($sort, $mode, $cari, $contact_all){
            $excel->sheet('New sheet', function($sheet) use ($sort, $mode, $cari, $contact_all){
                $sheet->loadView('contact.plain', compact('sort', 'mode', 'cari', 'contact_all'));
                
                $sheet->setOrientation('landscape');
                
            });
        })->export($format);
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

    /**
     * Mengapus beberapa data terpilih dari contact.
     */
    public function deleteMultiple(DeleteContactRequest $request)
    {
        // Cek jika ceklist terisi
        if ($request->check != null) {
            $contact = Contact::destroy($request->check);

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
