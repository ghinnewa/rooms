<?php

namespace App\DataTables;

use App\Models\Notification;
use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Carbon\Carbon;

class NotificationDataTable extends DataTable
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

        return $dataTable
            ->addColumn('notification_type', function ($notification) {
                // Display a user-friendly type based on the notification class
                if ($notification->type === 'App\\Notifications\\CardCreatedNotification') {
                    return 'Card Created';
                } elseif ($notification->type === 'App\\Notifications\\CardApprovalNotification') {
                    $data = json_decode($notification->data, true);
                    return strpos($data['message'], 'approved') !== false ? 'Card Accepted' : 'Card Rejected';
                }
                return 'Unknown Notification';
            })
            ->addColumn('recipient', function ($notification) {
                // Determine if the notification is sent to a student or an admin
                $user = User::find($notification->notifiable_id);
                return $user && $user->role === 'student' ? 'Sent to Student' : 'Sent to Admin';
            })
            ->addColumn('status', function ($notification) {
                // Display read/unread status as a badge
                return $notification->read_at ? '<span class="badge badge-success">Read</span>' : '<span class="badge badge-warning">Unread</span>';
            })
            ->editColumn('data', function ($notification) {
                // Parse and format the JSON data for better display
                $data = json_decode($notification->data, true);
                $message = $data['message'] ?? 'No message';
                $url = $data['url'] ?? '#';
                $cardId = $data['card_id'] ?? 'N/A';

                return "<strong>Message:</strong> {$message}<br>
                        <strong>URL:</strong> <a href='{$url}' target='_blank'>{$url}</a><br>
                        <strong>Card ID:</strong> {$cardId}";
            })
            ->addColumn('created_at', function ($notification) {
                // Format the created_at timestamp to look nicer
                return Carbon::parse($notification->created_at)->diffForHumans();
            })
            ->rawColumns(['status', 'data']); // Ensure these columns render HTML
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Notification $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Notification $model)
    {
        // Fetch notifications query and order by the latest notifications
        return $model->newQuery()->select([
            'id',
            'type',
            'notifiable_type',
            'notifiable_id',
            'data',
            'read_at',
            'created_at',
            'updated_at',
            'deleted_at'
        ])->orderBy('created_at', 'desc'); // Order by created_at to show the latest notifications first
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
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[4, 'desc']], 
                'responsive' => true, // Enable responsive behavior
                'autoWidth' => false, // Disable automatic width for better mobile adaptation
                'columnDefs' => [
                    ['width' => '10%', 'targets' => 0], // You can adjust column widths here
                    ['width' => '30%', 'targets' => 1]
                ],// Order by 'created_at' column by default
                'buttons'   => [
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
            'notification_type' => new Column(['title' => 'Notification Type', 'data' => 'notification_type']),
            'recipient' => new Column(['title' => 'Recipient', 'data' => 'recipient']),
            'data' => new Column(['title' => __('models/notifications.fields.data'), 'data' => 'data']),
            'status' => new Column(['title' => 'Status', 'data' => 'status']),
            'created_at' => new Column(['title' => 'Created At', 'data' => 'created_at']),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'notifications_datatable_' . time();
    }
}
