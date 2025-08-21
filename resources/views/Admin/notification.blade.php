<!DOCTYPE html>
<html>

<head>
    @include('Admin.headTag')

    <style>
        /* General card styles */
        .notification-card {
            border-left: 5px solid transparent;
            transition: all 0.3s ease-in-out;
            border-radius: 12px;
        }

        /* Unread notifications */
        .unread-notification {
            border-left: 5px solid #dc3545;
            background: #fff9f9;
        }

        .unread-notification:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(220, 53, 69, 0.15);
        }

        /* Read notifications */
        .read-notification {
            border-left: 5px solid #28a745;
            background: #f9fffa;
        }

        .read-notification:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(40, 167, 69, 0.15);
        }

        /* Avatar */
        .profile img {
            border: 2px solid #e9ecef;
            padding: 2px;
        }

        /* Titles */
        .notification-title {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
        }

        /* Message */
        .notification-message {
            font-size: 0.9rem;
            color: #6c757d;
        }

        /* Time */
        .notification-time {
            font-size: 0.8rem;
            color: #999;
        }

        /* Section headers */
        .section-title {
            border-bottom: 2px solid #eee;
            padding-bottom: 5px;
            margin: 20px 0 15px;
            font-weight: 600;
            color: #495057;
        }

        .badge {
            font-size: 0.75rem;
            padding: 4px 8px;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    @include('Admin.header')

    <div class="d-flex align-items-stretch">

        @include('Admin.sidebar')

        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h4 fw-bold mb-0">
                        <i class="bi bi-bell-fill text-primary me-2"></i> Notifications
                    </h2>
                </div>
            </div>

            {{-- Read Notifications --}}
            <h4 class="px-3 mt-4 section-title">
                <i class="bi bi-check2-circle text-success me-1"></i> Read
            </h4>

            @forelse($read as $notification)
            <div class="d-flex align-items-center notification-card read-notification mb-3 p-3 shadow-sm">
                <div class="profile me-3">
                    <img src="{{ asset('admincss/img/avatar-3.jpg') }}" alt="..." class="rounded-circle" width="50"
                        height="50">
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong class="notification-title">{{ $notification->data['title'] ?? 'Notification' }}</strong>
                        <span class="badge bg-success text-white">Read</span>
                    </div>
                    <p class="mb-1 notification-message">{!! $notification->data['message'] !!}</p>
                    <small class="notification-time">
                        <i class="bi bi-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
            @empty
            <div class="alert alert-secondary text-center m-3">
                No read notifications
            </div>
            @endforelse

        </div>

        <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"></script>
        <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{asset('admincss/js/charts-home.js')}}"></script>
        <script src="{{asset('admincss/js/front.js')}}"></script>

</body>

</html>