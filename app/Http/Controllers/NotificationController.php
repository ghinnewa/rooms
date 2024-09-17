<?php

namespace App\Http\Controllers;

use App\DataTables\NotificationDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Repositories\NotificationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class NotificationController extends AppBaseController
{
    /** @var NotificationRepository $notificationRepository*/
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepo)
    {
        $this->notificationRepository = $notificationRepo;
    }

    /**
     * Display a listing of the Notification.
     *
     * @param NotificationDataTable $notificationDataTable
     *
     * @return Response
     */
    public function index(NotificationDataTable $notificationDataTable)
    {
        return $notificationDataTable->render('notifications.index');
    }

    /**
     * Show the form for creating a new Notification.
     *
     * @return Response
     */
 


    /**
     * Display the specified Notification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            Flash::error(__('messages.not_found', ['model' => __('models/notifications.singular')]));

            return redirect(route('notifications.index'));
        }

        return view('notifications.show')->with('notification', $notification);
    }

  
    public function readAndRedirect($id, Request $request)
    {
        // Find the notification by ID for the authenticated user
        $notification = auth()->user()->notifications()->find($id);

        // Check if the notification exists and mark it as read
        if ($notification) {
            $notification->markAsRead(); // Marks the notification as read
        }

        // Redirect to the intended URL (or a fallback if none is provided)
        return redirect($request->get('url', '/')); // Default to home if no URL is provided
    }
    public function markAsRead($id)
    {
        // Find the notification by ID for the authenticated user
        $notification = auth()->user()->notifications()->find($id);

        // Check if the notification exists
        if ($notification) {
            // Mark the notification as read by updating the read_at timestamp to the current time
            $notification->update(['read_at' => now()]);
            return response()->json(['status' => 'success', 'message' => 'Notification marked as read.']);
        }

        // If the notification doesn't exist, return an error response
        return response()->json(['status' => 'error', 'message' => 'Notification not found.'], 404);
    }
}
