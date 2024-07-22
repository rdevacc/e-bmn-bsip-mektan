<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\UraianBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Typography\FontFactory;
use Intervention\Image\Drivers\Imagick\Driver;

class QRCodeController extends Controller
{
    public function index(){
        $jenis_barang = JenisBarang::orderBy('nama')->get();
        $uraian_barang = UraianBarang::orderBy('nama')->get();

        $all_data = Barang::paginate(54);

        return view('apps.qrcodes.index',[
            'all_data' => $all_data,
            'jenis_barang' => $jenis_barang,
            'uraian_barang' => $uraian_barang,
        ]);
    }

    public function generateQR(Request $request){
        // Setup for QR Code
        $qrId = $request->qr_data_id;
        $qrData = Barang::find($qrId);
        $qrName = "BBPSI Mektan - " . $qrData->nama; 
        $qrUrl = $request->root() .'/get-data' . '/'  . $qrId;

        // Generate QR Code
        $qrCode = QrCode::format('png')->size(300)->merge('/public/admin/assets/img/logo-kementan.png')->generate($qrUrl);

        // Save QR Code PNG Image to local storage
        $filePath = 'qrcodes/' . $qrName . '.png';
        Storage::disk('local')->put($filePath, $qrCode);

        // Get Image Path and Load image
        $imagePath = Storage::disk('local')->path($filePath);
        $qrImage = ImageManager::imagick()->read($imagePath);


        // create new manager instance with desired driver
        $manager = new ImageManager(Driver::class);

        // create new image 500
        $image = $manager->create(300, 450);
        $image->place($qrImage, 'top', 0, 5);
        $image->toPng();

        // create test image
        $textImage = ImageManager::imagick()->read($image);

         // Get the image width and height
        $width = $textImage->width();
        $height = $textImage->height();

        // Calculate the x and y coordinates to position the text at the bottom center
        $x = $width / 2;
        $y = $height - 110; // Adjust the 50 to fit the text properly above the bottom edge

        // Create Text "BBPSI Mektan"
        $textImage->text('BBPSI Mektan', $x, $y, function (FontFactory $font){
            $font->file(base_path('public\admin\assets\fonts\ARIALUNI.TTF'));
            $font->size(32);
            $font->color('000');
            $font->align('center');
            $font->valign('center');
        });

        // Create Text kode barang
        $textImage->text($qrData->kode_barang, $x, $y+60, function (FontFactory $font){
            $font->file(base_path('public\admin\assets\fonts\ARIALUNI.TTF'));
            $font->size(32);
            $font->color('000');
            $font->align('center');
            $font->valign('center');
        });
        
        // Create Text nama barang
        $textImage->text($qrData->nama, $x, $y+30, function (FontFactory $font){
            $font->file(base_path('public\admin\assets\fonts\ARIALUNI.TTF'));
            $font->size(32);
            $font->color('000');
            $font->align('center');
            $font->valign('center');
        });
         
        // Save Image to PNG
        $finalImage = $textImage->toPng();

        // Save final image to local storage
        Storage::disk('local')->put($filePath, $finalImage);

        // download final image and then delete it after downloaded
        return Response::download(storage_path('app/' . $filePath))->deleteFileAfterSend(true);
    }
}
