<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="{{asset('admincss/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h5">Pravin Kumar</h1>
            <p>Administrator</p>
        </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="active">
            <a href="{{url('/admin/dashboard')}}"> <i class="icon-home"></i>Home </a>
        </li>
        <li>
            <a href="{{url('view_category')}}"> <i class="fa fa-tag"></i> Categories </a>
        </li>
        <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Products </a>
            <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="{{url('add_product')}}">Add Products</a></li>
                <li><a href="{{url('view_product')}}">View Products</a></li>
            </ul>
        </li>
        <li><a href="{{url('order_page')}}"> <i class="icon-grid"></i>Orders </a></li>
        <li>
            <a href="{{ route('admin.chats') }}">
                <i class="bi bi-bell-fill"></i> Chat Message
                @php $c = $adminUnreadChatCount ?? 0; @endphp
                <span id="chatBadge"
                    class="badge badge-pill {{ $c ? 'badge-danger' : 'badge-secondary' }} ml-1">
                    {{ $c }}
                </span>
            </a>

        </li>
        <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>
        <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li>


    </ul>

    <script>
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
                })
                .catch(() => {});
        }
        setInterval(refreshChatBadge, 10000);
        document.addEventListener('DOMContentLoaded', refreshChatBadge);
    </script>


</nav>