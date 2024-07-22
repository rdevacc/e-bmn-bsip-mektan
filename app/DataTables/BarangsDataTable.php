<?php

namespace App\DataTables;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BarangsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query, Request $request): EloquentDataTable
    {

        if($request->ajax()){
            $query = Barang::with(['jenis', 'uraian'])->select('barangs.*');

            return (new EloquentDataTable($query))
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
            ->editColumn('tanggal_pembuatan', function($data){
                return $data->created_at;
            })
            ->addColumn('action', 'apps.components.admin.button')
            ->rawColumns(['action']);
            // ->addColumn('action', 'barangs.action');
        }
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Barang $model): QueryBuilder
    {
        $query = Barang::with(['jenis', 'uraian'])->select('barangs.*');

        return $model->newQuery($query);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->orderBy(1, 'asc')
                    ->orderBy(2, 'asc')
                    ->orderBy(4, 'asc')
                    ->selectStyleSingle()
                    ->buttons([
                        // Button::make('excel'),
                        // Button::make('csv'),
                        // Button::make('pdf'),
                        // Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('#')->searchable(false)->orderable(false),
            Column::make('jenis_id')->title('Jenis Barang')->searchable(true)->orderable(true),
            Column::make('uraian_id')->title('Uraian Barang'),
            Column::make('kode_barang'),
            Column::make('nup')->title('NUP'),
            Column::make('tahun')->title('Tahun Perolehan'),
            Column::make('nama'),
            Column::make('kuantitas'),
            Column::make('lokasi'),
            Column::make('nilai')->title('Nilai (Rp)'),
            Column::make('keterangan'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Barangs_' . date('YmdHis');
    }
}
