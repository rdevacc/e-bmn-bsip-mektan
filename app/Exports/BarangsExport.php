<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class BarangsExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $dataExport;

    public function __construct($dataExport)
    {
        $this->dataExport = $dataExport;
    }

    public function view(): View
    {
        $dataExport = $this->dataExport;

        return view('apps.export.excel-export',[
            'dataExport' => $dataExport,
        ]); 
    }

    public function styles(Worksheet $sheet){
        return [
            // 'A' => ['font' => ['bold' => true,]],
            // 'A8:A1000' => [
            //     'alignment' => [
            //         'horizontal' => Alignment::HORIZONTAL_CENTER,
            //         'vertical' => Alignment::VERTICAL_CENTER,
            //     ],
            // ],
            '1' => [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],

            ],
        ];
    }
}
