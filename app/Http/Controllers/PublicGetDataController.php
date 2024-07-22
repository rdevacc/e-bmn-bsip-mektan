<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class PublicGetDataController extends Controller
{
    public function index(Barang $id){
        $data = $id;

        return view('apps.barangs.public-show', compact('data'));
    }
}
