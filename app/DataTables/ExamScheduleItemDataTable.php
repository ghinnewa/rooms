<?php

namespace App\DataTables;

use App\Models\ExamScheduleItem;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ExamScheduleItemDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'exam_schedule_items.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ExamScheduleItem $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExamScheduleItem $model)
    {
        $query = $model->newQuery()->with('category', 'subject');
    
        if ($this->request()->has('exam_schedule_id')) {
            $query->where('exam_schedule_id', $this->request()->get('exam_schedule_id'));
        }
    
        
        return $query;
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
        'exam_date' => new Column(['title' => __('models/examScheduleItems.fields.exam_date'), 'data' => 'exam_date']),
        'category.name_en' => new Column(['title' => __('models/examScheduleItems.fields.category_id'), 'data' => 'category.name_en']),
        'subject.title' => new Column(['title' => __('models/examScheduleItems.fields.subject_id'), 'data' => 'subject.title']),
        'semester' => new Column(['title' => __('models/examScheduleItems.fields.semester'), 'data' => 'semester']),
        'start_time' => new Column(['title' => __('models/examScheduleItems.fields.start_time'), 'data' => 'start_time']),
        'end_time' => new Column(['title' => __('models/examScheduleItems.fields.end_time'), 'data' => 'end_time']),
        'action' => new Column(['title' => __('crud.action'), 'data' => 'action', 'exportable' => false, 'printable' => false, 'orderable' => false, 'searchable' => false])
    ];
}


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'exam_schedule_items_datatable_' . time();
    }
}
