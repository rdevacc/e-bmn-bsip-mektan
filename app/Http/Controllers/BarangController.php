<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\UraianBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    /**
     * * Display a listing of the resource. *
     */
    public function index(Request $request){
        
        $jenis_barang = JenisBarang::orderBy('nama')->get();
        $uraian_barang = UraianBarang::orderBy('nama')->get();
        
        if($request->ajax()){
            /**
             * * Get all data *
             */
            $query = Barang::with(['jenis', 'uraian'])->orderBy('created_at', 'desc')->select('barangs.*');

             /**
             * * Cari Berdasarkan Jenis dan Uraian Barang *
             */
            if(($request->jenis_id != '') && ($request->uraian_id != '')){
                $jenis_id = $request->jenis_id;
                $uraian_id = $request->uraian_id;
                $query = Barang::with(['jenis', 'uraian'])
                ->where('jenis_id', $jenis_id)
                ->where('uraian_id', $uraian_id)
                ->orderBy('created_at', 'desc')->select('barangs.*');

                return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('jenis_id', function($data){
                    return $data->jenis->nama;
                })
                ->editColumn('uraian_id', function($data){
                    return $data->uraian->nama;
                })
                ->editColumn('nilai', function($data){
                    return formatRupiahAngka($data->nilai);
                })
                ->editColumn('created_at', function($data){
                    $created_at = $data->created_at;
                    $tanggal_pembuatan = Carbon::parse($created_at);
                    
                    // Convert the Carbon instance to Jakarta timezone (Asia/Jakarta)
                    $createdAtLocal = $tanggal_pembuatan->timezone('Asia/Jakarta');
                    
                    // Convert to local date time 
                    $localDateTime = $createdAtLocal->format('d-M-Y H:i:s');
                    return $localDateTime;
                })
                ->addColumn('action', 'apps.components.admin.button')
                ->toJson();
                // ->addColumn('action', 'barangs.action');
            }
             
            /**
             * * Cari Berdasarkan Jenis Barang *
             */
            if($request->jenis_id != null || $request->jenis_id != ''){
                $query = Barang::with(['jenis', 'uraian'])->where('jenis_id', $request->jenis_id)->orderBy('created_at', 'desc')->select('barangs.*');
            }

            /**
             * * Cari Berdasarkan Uraian Barang *
             */
            if($request->uraian_id != null || $request->uraian_id != ''){
                $query = Barang::with(['jenis', 'uraian'])->where('uraian_id', $request->uraian_id)->orderBy('created_at', 'desc')->select('barangs.*');
            }

           return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('jenis_id', function($data){
                return $data->jenis->nama;
            })
            ->editColumn('uraian_id', function($data){
                return $data->uraian->nama;
            })
            ->editColumn('nilai', function($data){
                return formatRupiahAngka($data->nilai);
            })
            ->editColumn('created_at', function($data){
                $created_at = $data->created_at;
                $tanggal_pembuatan = Carbon::parse($created_at);
                
                // Convert the Carbon instance to Jakarta timezone (Asia/Jakarta)
                $createdAtLocal = $tanggal_pembuatan->timezone('Asia/Jakarta');
                
                // Convert to local date time 
                $localDateTime = $createdAtLocal->format('d-M-Y H:i:s');
                return $localDateTime;
            })
            ->addColumn('action', 'apps.components.admin.button')
            ->toJson();
            // ->addColumn('action', 'barangs.action');
        }

        return view('apps.barangs.index',[
            'jenis_barang' => $jenis_barang,
            'uraian_barang' => $uraian_barang,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $jenis_barang = JenisBarang::orderBy('nama')->get();
        $uraian_barang = UraianBarang::orderBy('nama')->get();

        return view('apps.barangs.create', [
            'jenis_barang' => $jenis_barang,
            'uraian_barang' => $uraian_barang,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        // Get input data for converting text to numeric
        $inputNilai = $request->nilai;

        // Strip non-numeric characters from the input
        $amountNilai = preg_replace('/[^0-9]/', '', $inputNilai);

        // Convert the amount to numeric value
        $numericNilai = (int) $amountNilai;

        $request['nilai'] = $numericNilai;

        /**
         * * Validate Data *
         */
        $validate = $request->validate([
            'jenis_id' => 'required',
            'uraian_id' => 'required',
            'kode_barang' => 'required|max:10',
            'nup' => 'required',
            'nama' => 'required',
            'tahun' => 'required',
            'kuantitas' => 'required',
            'lokasi' => 'required',
            'nilai' => 'required',
            'keterangan' => 'required',
        ],[
            'jenis_id.required' => 'Pilih Jenis Barang',
            'uraian_id.required' => 'Pilih Uraian Barang',
            'kode_barang.required' => 'Kode Barang Harus Diisi',
            'kode_barang.max' => 'Kode Barang Maksimal 10 Angka',
            'nup.required' => 'NUP Barang Harus Diisi',
            'nama.required' => 'Merk/Tipe Barang Harus Diisi',
            'tahun.required' => 'Tahun Perolehan Barang Harus Diisi',
            'kuantitas.required' => 'Kuantitas Barang Harus Diisi',
            'lokasi.required' => 'Lokasi Barang Harus Diisi',
            'nilai.required' => 'Nilai Barang Harus Diisi',
            'keterangan.required' => 'Keterangan Barang Harus Diisi',
        ]);

        // Store or Create Data to Database
        Barang::create($validate);

        return redirect()->route('barang-index')->with('success', 'Data Barang Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        $dataShow = $barang->find($barang->id);

        $created_at = $dataShow->created_at;

        $tanggal_pembuatan = Carbon::parse($created_at);
        
        
        // Convert the Carbon instance to Jakarta timezone (Asia/Jakarta)
        $createdAtLocal = $tanggal_pembuatan->timezone('Asia/Jakarta');
        
        // Convert to local date time 
        $localDateTime = $createdAtLocal->format('d-M-Y H:i:s');
        
        return view('apps.barangs.show',[
            'dataShow' => $dataShow,
            'localDateTime' => $localDateTime,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $jenis_barang = JenisBarang::orderBy('nama')->get();
        $uraian_barang = UraianBarang::orderBy('nama')->get();

        return view('apps.barangs.edit',[
            'dataEdit' => $barang,
            'jenis_barang' => $jenis_barang,
            'uraian_barang' =>$uraian_barang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
         // Get input data for converting text to numeric
         $inputNilai = $request->nilai;

         // Strip non-numeric characters from the input
         $amountNilai = preg_replace('/[^0-9]/', '', $inputNilai);
 
         // Convert the amount to numeric value
         $numericNilai = (int) $amountNilai;
 
        //  Initiate array value
         $request['nilai'] = $numericNilai;

         // Validate Data
         $validate = $request->validate([
            'jenis_id' => 'required',
            'uraian_id' => 'required',
            'kode_barang' => 'required',
            'nup' => 'required',
            'nama' => 'required',
            'tahun' => 'required',
            'kuantitas' => 'required',
            'lokasi' => 'required',
            'nilai' => 'required',
            'keterangan' => 'required',
        ],[
            'jenis_id.required' => 'Pilih Jenis Barang',
            'uraian_id.required' => 'Pilih Uraian Barang',
            'kode_barang.required' => 'Kode Barang Harus Diisi',
            'nup.required' => 'NUP Barang Harus Diisi',
            'nama.required' => 'Merk/Tipe Barang Harus Diisi',
            'tahun.required' => 'Tahun Perolehan Barang Harus Diisi',
            'kuantitas.required' => 'Kuantitas Barang Harus Diisi',
            'lokasi.required' => 'Lokasi Barang Harus Diisi',
            'nilai.required' => 'Nilai Barang Harus Diisi',
            'keterangan.required' => 'Keterangan Barang Harus Diisi',
        ]);

        // Update Data to Database
        Barang::where('id', $barang->id)->update($validate);

        return redirect()->route('barang-index')->with('success', 'Data Barang Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        // Destroy data by id
        Barang::destroy($barang->id);

        // Return to data index
        return redirect()->route('barang-index')->with('success', 'Data Barang Berhasil Dihapus');
    }
}
