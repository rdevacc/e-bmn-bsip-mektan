<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $currentYear = Carbon::parse(now())->translatedFormat('Y');
        $dataBarang = Barang::orderBy('jenis_id', 'desc')->get();

        $jumlahTotalBarang = count($dataBarang);

        $totalBmn = 0;
        $totalRoyalti = 0;
        $totalInventaris = 0;
        $totalPribadi = 0;

        
        /**
         * * Looping for Jumlah Total
         */
        foreach ($dataBarang as $data) {
            if ($data["jenis_id"] == 1){
                $totalBmn += 1;
            } elseif ($data["jenis_id"] == 2){
                $totalInventaris += 1;
            } elseif ($data["jenis_id"] == 3){
                $totalRoyalti += 1;
            } elseif($data["jenis_id"] == 4) {
                $totalPribadi += 1;
            }
        }


        return view('apps.dashboard.index', [
            'currentYear' => $currentYear,
            'jumlahTotalBarang' => $jumlahTotalBarang,
            'totalBmn' => $totalBmn,
            'totalInventaris' => $totalInventaris,
            'totalRoyalti' => $totalRoyalti,
            'totalPribadi' => $totalPribadi,
        ]);
    }
}
