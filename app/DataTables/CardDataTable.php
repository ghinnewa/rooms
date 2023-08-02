<?php

namespace App\DataTables;

use App\Models\Card;
use Illuminate\Support\Facades\Route;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

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
            return '<img src='.$url.' style="width:50px; height:50px;  object-fit: cover;" class="rounded-circle"/>';
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
            ->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    [
                       'extend' => 'create',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-plus"></i> ' .__('auth.app.create').''
                    ],
                    [
                       'extend' => 'export',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-download"></i> ' .__('auth.app.export').''
                    ],
                    [
                       'extend' => 'print',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-print"></i> ' .__('auth.app.print').''
                    ],
                    [
                       'extend' => 'reset',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-undo"></i> ' .__('auth.app.reset').''
                    ],
                    [
                       'extend' => 'reload',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-refresh"></i> ' .__('auth.app.reload').''
                    ],
                ],
                 'language' => [
                   'url' => url('//cdn.datatables.net/plug-ins/1.10.12/i18n/English.json'),
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
            'image' => new Column(['title' => __('models/cards.fields.image'), 'data' => 'image']),
            'membership_number' => new Column(['title' => __('models/cards.fields.membership_number'), 'data' => 'membership_number']),
            'name_ar' => new Column(['title' => __('models/cards.fields.name_ar'), 'data' => 'name_ar']),
            'email' => new Column(['title' => __('models/cards.fields.email'), 'data' => 'email']),
            'phone1' => new Column(['title' => __('models/cards.fields.phone1'), 'data' => 'phone1']),
            'company_ar' => new Column(['title' => __('models/cards.fields.company_ar'), 'data' => 'company_ar']),
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
