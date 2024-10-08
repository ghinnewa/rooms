<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-toggle/3.6.1/bootstrap4-toggle.min.css"
        integrity="sha512-EzrsULyNzUc4xnMaqTrB4EpGvudqpetxG/WNjCpG6ZyyAGxeB6OBF9o246+mwx3l/9Cn838iLIcrxpPHTiygAA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css"
        integrity="sha512-mxrUXSjrxl8vm5GwafxcqTrEwO1/oBNU25l20GODsysHReZo4uhVISzAKzaABH6/tTfAxZrY2FprmeAP5UZY8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
        integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw=="
        crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/69393ee716.js" crossorigin="anonymous"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{  asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{  asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{  asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
   
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{  asset('assets/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{  asset('assets/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{  asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{  asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{  asset('assets/plugins/summernote/summernote-bs4.min.css')}}">
    <!-- <link rel="stylesheet" href="https://cdn.css.com/bootstrap/v4.5.3/css/bootstrap.min.css"> -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    @stack('third_party_stylesheets')

    @stack('styles')
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>


    @stack('page_css')

    <link rel="stylesheet" href="{{ asset('assets/app1.css') }}">

@auth

<link rel="stylesheet" href="{{ asset('assets/app.css') }}">
@endauth
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @auth

        <script>
            // Embed the user ID from Laravel into a JavaScript variable
            var userId = {{auth()->id()}};
        </script>

        <style>
            .dropdown-item.notification-approved {
                background-color: #d4edda;
                /* Light green */
            }

            .dropdown-item.notification-rejected {
                background-color: #f8d7da;
                /* Light red */
            }

            .dropdown-header {
                font-weight: bold;
            }

            .dropdown-item small {
                color: #6c757d;
            }

            .fa-bell {
                font-size: 1.8rem;
                /* Increase the size of the bell icon */
            }
            .dataTables_wrapper {
    padding: 20px!important;
  }
            .unread {
    background-color: #D2E0FB; /* Light red for unread */
}

.read {
    background-color: white; /* Light green for read */
}


        </style>
        @endauth

        @auth
        <!-- Main Header -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto ">
            <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-bell"></i>
        <span class="badge badge-warning navbar-badge" id="notification-count">
            {{ auth()->user()->unreadNotifications->count() }}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow" id="notification-list" style="width: 350px;">
      
        <div class="dropdown-divider"></div>

        <!-- Scrollable Notification List -->
        <div style="max-height: 300px; overflow-y: auto; padding: 5px;">
            @foreach(auth()->user()->notifications->sortByDesc('created_at') as $notification)
                @if ($notification->type === 'App\\Notifications\\CardCreatedNotification')
                    <!-- Link type notification for card creation -->
                    <a href="{{ route('notifications.readAndRedirect', ['id' => $notification->id, 'url' => $notification->data['url'] ?? '#']) }}"
                       class="dropdown-item d-flex align-items-start notification-item {{ $notification->read_at ? 'read' : 'unread' }}"
                       data-id="{{ $notification->id }}"
                       id="notification-{{ $notification->id }}">
                        <i class="fas fa-envelope mr-3 text-primary"></i>
                        <div class="flex-grow-1">
                            <p class="mb-0 text-truncate" style="font-size: 14px; font-weight: 500;">
                                {{ Str::limit($notification->data['message'], 50) }}
                            </p>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                    </a>
                @elseif ($notification->type === 'App\\Notifications\\CardApprovalNotification')
                    <!-- Modal type notification for card approval or rejection -->
                    <a href="#" class="dropdown-item d-flex align-items-start notification-item {{ $notification->read_at ? 'read' : 'unread' }}"
                       data-toggle="modal"
                       data-target="#notificationModal"
                       data-message="{{ $notification->data['message'] }}"
                       data-comment="{{ $notification->data['comment'] ?? '' }}"
                       data-card-id="{{ $notification->data['card_id'] }}"
                       id="notification-{{ $notification->id }}">
                        <i class="fas fa-envelope mr-3 text-danger"></i>
                        <div class="flex-grow-1">
                            <p class="mb-0 text-truncate" style="font-size: 14px; font-weight: 500;">
                                {{ Str::limit($notification->data['message'], 50) }}
                            </p>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                    </a>
                @endif
                <div class="dropdown-divider"></div>
            @endforeach
        </div>
        @role('admin|super admin')
        <a href="{{ route('notifications.index') }}" class="dropdown-item dropdown-footer text-center text-primary">See All Notifications</a>
        @endrole
    </div>
</li>




                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('glucc.png') }}"
                            class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header ">
                            <img src="{{ asset('glucc.png') }}"
                                class="img-circle elevation-2" alt="User Image">
                            <p>
                                {{ Auth::user()->name }}
                                <small>مشترك منذ {{ Auth::user()->created_at->format('M. Y') }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            
                            <a href="#" class="btn btn-primary btn-flat float-right"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               تسجيل خروج
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- Modal Structure in app.blade.php -->
        <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notificationModalLabel">Notification Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="notificationMessage"></p>
                        <p id="notificationComment"></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" id="editCardButton" class="btn btn-primary">Edit Card</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        @endauth

        <!-- Content Wrapper. Contains page content -->
        <div class=@if (!Route::is('publicForm')) "content-wrapper" @endif>
            <section class="content">
                @yield('content')
            </section>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
        </footer>
    </div>

    <!-- jQuery -->
   <!-- DataTables CSS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- DataTables Responsive CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

<!-- jQuery -->

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- DataTables Responsive JS -->
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
  
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"
        integrity="sha512-AJUWwfMxFuQLv1iPZOTZX0N/jTCIrLxyZjTRKQostNU71MzZTEPHjajSK20Kj1TwJELpP7gl+ShXw5brpnKwEg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
        integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg=="
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.3/bootstrapSwitch.min.js"
        integrity="sha512-DAc/LqVY2liDbikmJwUS1MSE3pIH0DFprKHZKPcJC7e3TtAOzT55gEMTleegwyuIWgCfOPOM8eLbbvFaG9F/cA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
<!-- jQuery -->

<!-- BootstrapSwitch -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-switch@3.6.1/dist/js/bootstrap-switch.min.js"></script>

<!-- Your Custom Scripts that use BootstrapSwitch -->
<script>
    $(function() {
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    });
</script>

   
    <script src="{{ mix('js/app.js') }}"></script>

    <script>
      // Handle showing the modal and updating its content based on the clicked notification
// Handle showing the modal and updating its content based on the clicked notification
$('#notificationModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var message = button.data('message'); // Extract message from data-* attributes
    var comment = button.data('comment'); // Extract comment if present
    var cardId = button.data('card-id'); // Extract card ID for the edit button

    // Update the modal's content.
    var modal = $(this);
    modal.find('#notificationMessage').text(message); // Set the message
    modal.find('#notificationComment').text(comment ? 'Comment: ' + comment : ''); // Set the comment if present

    // Update the edit button's href to link to the correct card
    modal.find('#editCardButton').attr('href', '/cards/' + cardId + '/edit');
});


        $(document).on('click', '.notification-item', function (e) {
    e.preventDefault(); // Prevent the link from navigating immediately

    const notificationId = $(this).data('id');
    const url = $(this).attr('href'); // Store the URL to navigate to later

    // Mark the notification as read using AJAX
    $.ajax({
        url: `/notifications/${notificationId}/read`, // Ensure this route exists in your Laravel app
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token header
        },
        success: function (response) {
            if (response.status === 'success') {
                // Change the appearance of the notification to indicate it's been read
                $(`#notification-${notificationId}`).removeClass('unread').addClass('read');

                // Update the notification count
                updateNotificationCount();

                // Now navigate to the link after the AJAX call is successful
                window.location.href = url;
            } else {
                console.error('Error:', response.message);
                // If marking as read fails, you may still want to navigate
                window.location.href = url;
            }
        },
        error: function (error) {
            console.error('Error marking notification as read:', error);
            // Navigate to the link even if there's an error
            window.location.href = url;
        }
    });
});

// Function to update the notification count
function updateNotificationCount() {
    let unreadCount = $('.notification-item.unread').length;
    $('#notification-count').text(unreadCount);
    $('#notification-count-text').text(unreadCount);
}


    // Optional: Redirect to the notification's URL (if applicable)
    const url = $(this).attr('href');
    if (url && url !== '#') {
        window.location.href = url;
    }




$(document).on('click', '.nav-link[data-toggle="dropdown"]', function () {
    // Reset the notification count to 0 when the dropdown is opened
    $('#notification-count').text(0);
    $('#notification-count-text').text(0);

    // Optional: mark all notifications as read when dropdown is opened
  
});



    </script>

@stack('third_party_scripts')


@stack('chart')


@stack('scriptss')
@stack('scripts')
@stack('scripts_subject')
@stack('subjects')
@stack('img')
@stack('paidscript')
@stack('filename1')
@stack('filename2')
@stack('scripts1')
@stack('page_scripts')
@stack('myscript')
</body>

</html>