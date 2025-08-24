<!DOCTYPE html>
<html>

<head>
    @include('Admin.headTag')
    <style>
        .chat-wrapper {
            display: flex;
            gap: 16px;
        }

        .chat-threads {
            width: 30%;
            max-height: 70vh;
            overflow: auto;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        .chat-thread {
            padding: 10px;
            border-bottom: 1px solid #f1f1f1;
            cursor: pointer;
        }

        .chat-thread.active {
            background: #f8f9fa;
        }

        .chat-thread .count {
            float: right;
        }

        .chat-box {
            flex: 1;
            display: flex;
            flex-direction: column;
            border: 1px solid #eee;
            border-radius: 8px;
            max-height: 70vh;
        }

        .chat-messages {
            flex: 1;
            overflow: auto;
            padding: 12px;
        }

        .msg {
            margin: 6px 0;
            padding: 8px 10px;
            border-radius: 8px;
            max-width: 70%;
        }

        .msg.user {
            background: #f1f1f1;
            align-self: flex-start;
        }

        .msg.admin {
            background: #25d366;
            color: #fff;
            align-self: flex-end;
        }

        .chat-input {
            display: flex;
            border-top: 1px solid #eee;
        }

        .chat-input input {
            flex: 1;
            border: 0;
            padding: 10px;
        }

        .chat-input button {
            border: 0;
            padding: 0 16px;
        }
    </style>

</head>

<body>

    @include('Admin.header')

    <div class="d-flex align-items-stretch">

        <!-- Sidebar Navigation-->
        @include('Admin.sidebar')
        <!-- Sidebar Navigation end-->

        <!-- Page Content -->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Users Chat Message</h2>
                </div>
            </div>
            <div class="container-fluid">
                <h3 class="mb-3">Support Chats</h3>

                <div class="chat-wrapper">
                    <!-- Left: Threads -->
                    <div class="chat-threads" id="threadList"></div>

                    <!-- Right: Conversation -->
                    <div class="chat-box">
                        <div id="conversationTitle" class="px-3 py-2 border-bottom"><strong>Select a user</strong></div>
                        <div id="messages" class="chat-messages d-flex flex-column"></div>
                        <div class="chat-input">
                            <input id="adminMessage" type="text" placeholder="Type a reply..." disabled>
                            <button id="adminSend" class="btn btn-dark" disabled>Send</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Page Content end-->

    </div>
    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
    <script>
        let currentUserId = null;
        let pollTimer = null;

        function loadThreads() {
            fetch("{{ url('/admin/chat/threads') }}")
                .then(r => r.json())
                .then(list => {
                    const box = document.getElementById('threadList');
                    box.innerHTML = '';
                    list.forEach(u => {
                        const div = document.createElement('div');
                        div.className = 'chat-thread';
                        div.dataset.userId = u.id;
                        div.innerHTML = `<strong>${u.name}</strong>
                           ${u.unread_count>0 ? `<span class="badge badge-danger count">${u.unread_count}</span>` : ''}
                           <div class="text-muted small">${u.latest ?? ''}</div>`;
                        div.onclick = () => openThread(u.id, u.name);
                        box.appendChild(div);
                    });
                });
        }

        function renderMessages(msgs) {
            const M = document.getElementById('messages');
            M.innerHTML = '';
            msgs.forEach(m => {
                const div = document.createElement('div');
                div.className = 'msg ' + (m.sender === 'admin' ? 'admin' : 'user');
                div.textContent = m.message;
                M.appendChild(div);
            });
            M.scrollTop = M.scrollHeight;
        }

        function loadMessages() {
            if (!currentUserId) return;
            fetch(`{{ url('/admin/chat') }}/${currentUserId}`)
                .then(r => r.json())
                .then(renderMessages);
        }

        function markRead() {
            if (!currentUserId) return;
            fetch(`{{ url('/admin/chat') }}/${currentUserId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }).then(() => {
                refreshChatBadge();
                loadThreads();
            });
        }

        function openThread(userId, name) {
            currentUserId = userId;
            document.getElementById('conversationTitle').innerHTML = `<strong>${name}</strong>`;
            document.getElementById('adminMessage').disabled = false;
            document.getElementById('adminSend').disabled = false;

            // highlight selected
            Array.from(document.querySelectorAll('.chat-thread')).forEach(el => {
                el.classList.toggle('active', Number(el.dataset.userId) === Number(userId));
            });

            loadMessages();
            markRead();

            if (pollTimer) clearInterval(pollTimer);
            pollTimer = setInterval(() => {
                loadMessages();
                refreshChatBadge();
                loadThreads();
            }, 3000);

        }

        document.getElementById('adminSend').addEventListener('click', () => {
            const input = document.getElementById('adminMessage');
            const txt = input.value.trim();
            if (!txt || !currentUserId) return;
            fetch(`{{ url('/admin/chat') }}/${currentUserId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        message: txt
                    })
                }).then(r => r.json())
                .then(() => {
                    input.value = '';
                    loadMessages();
                    loadThreads();
                });
        });

        document.getElementById('adminMessage').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') document.getElementById('adminSend').click();
        });

        // init
        document.addEventListener('DOMContentLoaded', () => {
            loadThreads();
        });

        // Badge refresher (same function used in sidebar polling)
        function refreshChatBadge() {
            fetch("{{ url('/admin/chat/unread-count') }}", {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(r => r.json())
                .then(({
                    count
                }) => {
                    const badge = document.getElementById('chatBadge');
                    if (!badge) return;
                    if (count > 0) {
                        badge.textContent = count;
                        badge.style.display = '';
                        badge.classList.remove('badge-secondary');
                        badge.classList.add('badge-danger');
                    } else {
                        badge.textContent = 0;
                        badge.style.display = 'none';
                        badge.classList.remove('badge-danger');
                        badge.classList.add('badge-secondary');
                    }
                });
        }
    </script>

</body>

</html>