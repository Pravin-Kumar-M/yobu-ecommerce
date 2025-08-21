<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')
    <!-- Font Awesome -->
    <style>
        .notification-item {
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 8px;
        }

        .notification-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Unread Notifications */
        .notification-unread {
            background-color: #e8f4ff;
            border-left: 5px solid #0d6efd;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(13, 110, 253, 0.1);
        }

        /* Read Notifications */
        .notification-read {
            background-color: #f8f9fa;
            border-left: 5px solid transparent;
            opacity: 0.85;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include ('Home.home_header')

    <div class="container mt-5 mb-5">
        @foreach($notifications as $notification)
        <a href="{{ route('mark_as_read', $notification->id) }}"
            class="text-decoration-none text-dark">
            <div class="notification-item p-3 mb-2 
            {{ $notification->read_at ? 'notification-read' : 'notification-unread' }}">
                <strong>{{ $notification->data['title'] ?? 'Notification' }}</strong>
                <p class="mb-1">{{ $notification->data['message'] ?? '' }}</p>
                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </div>
        </a>
        @endforeach
    </div>


    @include ('Home.home_footer')


</body>

</html>