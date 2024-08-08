<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pegawai.index');
    }

    public function data()
    {
        $pegawai = Pegawai::all();

        return datatables()
            ->of($pegawai)
            ->addIndexColumn()
            ->addColumn('nip', function ($pegawai) {
                return '<span class="badge badge-success">' . $pegawai->nip . '</span>';
            })
            ->addColumn('nama', function ($pegawai) {
                return $pegawai->nama;
            })
            ->addColumn('jabatan', function ($pegawai) {
                return $pegawai->jabatan;
            })
            ->addColumn('tgl_lahir', function ($pegawai) {
                return $pegawai->tgl_lahir;
            })
            ->addColumn('umur', function ($pegawai) {
                return $pegawai->umur;
            })
            ->addColumn('alamat', function ($pegawai) {
                return $pegawai->alamat;
            })
            ->addColumn('foto', function ($pegawai) {
                return '<img src="' . $pegawai->foto . '" width="50">';
            })
            ->addColumn('aksi', function ($pegawai) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`' . route('pegawai.update', $pegawai->id) . '`)" class="btn btn-sm btn-info btn-flat"><i class="fa fa-pen"></i></button>
                    <button type="button" onclick="deleteData(`' . route('pegawai.destroy', $pegawai->id) . '`)" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'nip', 'foto'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $pegawai = new Pegawai();

        function kode($value, $threshold = null)
        {
            return sprintf("%0" . $threshold . "s", $value);
        }

        $p = Pegawai::latest()->first() ?? new Pegawai();
        $pegawai->nip = 'N' . kode((int)$p->id + 1, 6);

        $pegawai->nama = $request->nama;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->umur = $request->umur;
        $pegawai->alamat = $request->alamat;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namafoto = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $namafoto);

            $pegawai->foto = "img/$namafoto";
        }

        $pegawai->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pegawai = Pegawai::find($id);

        return response()->json($pegawai);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->nama = $request->nama;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->umur = $request->umur;
        $pegawai->alamat = $request->alamat;

        if ($request->hasFile('foto')) {
            File::delete($pegawai->foto);
            $file = $request->file('foto');
            $namafoto = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $namafoto);

            $pegawai->foto = "img/$namafoto";
        }

        $pegawai->update();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        return response(null, 204);
    }
}
