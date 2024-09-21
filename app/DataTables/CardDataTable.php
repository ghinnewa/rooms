<?php

namespace App\DataTables;

use App\Models\Card;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

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
    
        return $dataTable->addColumn('checkbox', function ($card) {
            return '<input type="checkbox" class="card-checkbox" value="' . $card->id . '">';
        })
        ->addColumn('image', function ($card) {
            $url = asset('storage/profile/'.$card->image);
            return '<img src="'.$url.'" style="width:50px; height:50px;  object-fit: cover;" class="rounded-circle"/>';
        })
        ->addColumn('user', function ($card) {
            if ($card->user) {
                return '<a href="' . route('users.show', $card->user->id) . '">' . $card->user->name . '</a>';
            } else {
                return 'N/A';
            }
        })
        ->rawColumns(['checkbox', 'image', 'action', 'user']) // Include 'checkbox' in rawColumns to render HTML.
        ->addColumn('action', 'cards.datatables_actions');
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
        if (Route::is('cards.exp')) {
            return $model->where('expiration', '<', Carbon::now())->newQuery();
        }  
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
                    'url' => asset('lang/datatables_ar.json'), // Local path to your JSON file
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
            'checkbox' => [
                'data' => 'checkbox', 
                'title' => '<input type="checkbox" id="select-all" />', 
                'orderable' => false, 
                'searchable' => false, 
                'exportable' => false, 
                'printable' => false
            ], 
            'image' => new Column(['title' => __('models/cards.fields.image'), 'data' => 'image']),
            'membership_number' => new Column(['title' => __('models/cards.fields.membership_number'), 'data' => 'membership_number']),
            'name_ar' => new Column(['title' => __('models/cards.fields.name_ar'), 'data' => 'name_ar']),
            'user' => new Column(['title' => 'User', 'data' => 'user', 'searchable' => true, 'orderable' => true]),
            'phone1' => new Column(['title' => __('models/cards.fields.phone1'), 'data' => 'phone1']),
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
