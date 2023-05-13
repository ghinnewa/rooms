<?php

namespace App\DataTables;

use App\Models\Card;
use Illuminate\Support\Facades\Route;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CardDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('image', function ($card) {
           $url = asset('storage/profile/'.$card->image);
            return '<img src='.$url.' style="width:50px; height:50px" class="rounded-circle"/>';
        })->rawColumns(['image', 'action','title'])->addColumn('action', 'cards.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Card $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Card $model)
    {
        if(Route::is('cards.index')) return $model->where('paid',1)->newQuery();
        if(Route::is('cards.requests')) return $model->where('paid',0)->newQuery();


    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'image',
            'membership_number',
            'name_ar',
            'company_ar',
            'email',
            'phone1',

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'cards_datatable_' . time();
    }
}
