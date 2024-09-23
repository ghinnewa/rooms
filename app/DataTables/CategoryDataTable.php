<?php

namespace App\DataTables;
use Yajra\DataTables\Html\Column;

use App\Models\Category;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CategoryDataTable extends DataTable
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

        return $dataTable->addColumn('image', function ($category) {
            $url = asset('storage/categories/'.$category->image);
             return '<img src='.$url.' style="width:50px; height:50px;  object-fit: cover;" class="rounded-circle"/>';
         })->rawColumns(['image', 'action','title'])->addColumn('action', 'categories.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        return $model->newQuery();
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
                'responsive' => true, // Enable responsive behavior
                'autoWidth' => false, // Disable automatic width for better mobile adaptation
                'columnDefs' => [
                    ['width' => '10%', 'targets' => 0], // You can adjust column widths here
                    ['width' => '30%', 'targets' => 1]
                ],
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
            'id' => new Column(['title' => 'الرقم التعريفي', 'data' => 'id']),
            'image' => new Column(['title' => 'الصورة', 'data' => 'image']),
            'name_ar' => new Column(['title' => 'الاسم بالعربية', 'data' => 'name_ar']),
            'name_en' => new Column(['title' => 'الاسم بالإنجليزية', 'data' => 'name_en']),
        ];
    }
    

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'categories_datatable_' . time();
    }
}
