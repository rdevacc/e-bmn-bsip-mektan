<?php

namespace App\Http\Controllers;

use App\Exports\BarangsExport;
use App\Models\Barang;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export(Request $request){
        $dataExport = Barang::with(['jenis', 'uraian'])->get();     

        /**
         * * Export Data Excel by Jenis and Uraian * 
         */
        if(($request->export_by_jenis != null || $request->export_by_jenis != "") && ($request->export_by_uraian != null || $request->export_by_uraian != "")){
            $export_by_jenis = $request->export_by_jenis;
            $export_by_uraian = $request->export_by_uraian;
            $dataExport = Barang::with(['jenis', 'uraian'])
                        ->where('jenis_id', $export_by_jenis)
                        ->where('uraian_id', $export_by_uraian)
                        ->orderBy('tahun')
                        ->get();

            return Excel::download(new BarangsExport($dataExport), 'E-BMN BSIP Mektan.xlsx');
        }

        /**
         * * Export Data Excel by Jenis * 
         */
        if($request->export_by_jenis != null || $request->export_by_jenis != ""){
            $export_by_jenis = $request->export_by_jenis;
            $dataExport = Barang::with(['jenis', 'uraian'])
                        ->where('jenis_id', $export_by_jenis)
                        ->orderBy('tahun')
                        ->get();
        };

        /**
         * * Export Data Excel by Uraian * 
         */
        if($request->export_by_uraian != null || $request->export_by_uraian != ""){
            $export_by_uraian = $request->export_by_uraian;
            $dataExport = Barang::with(['jenis', 'uraian'])
                        ->where('uraian_id', $export_by_uraian)
                        ->orderBy('tahun')
                        ->get();
        };

        /**
         * * Export Data Excel by Search * 
         */
        if($request->export_by_search != null || $request->export_by_search != ""){
            $kata = $request->export_by_search;
            $dataExport = Barang::with(['jenis', 'uraian'])
                        ->whereHas('jenis', function (Builder $query) use ($kata){
                            $query->where('nama', 'like', '%' . $kata . '%');
                        })
                        ->orWhereHas('uraian', function (Builder $query) use ($kata){
                            $query->where('nama', 'like', '%' . $kata . '%');
                        })
                        ->orWhere('nama', 'like', '%' . $kata . '%')
                        ->orWhere('kode_barang', 'like', '%' . $kata . '%')
                        ->orWhere('nup', 'like', '%' . $kata . '%')
                        ->orWhere('tahun', 'like', '%' . $kata . '%')
                        ->get();                        
        }

        return Excel::download(new BarangsExport($dataExport), 'E-BMN BSIP Mektan.xlsx');
    }
}
