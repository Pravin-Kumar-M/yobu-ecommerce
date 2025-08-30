  <header class="header">
      <nav class="navbar navbar-expand-lg">

          <!-- search panel -->
          <div class="search-panel">
              <div class="search-inner d-flex align-items-center justify-content-center">
                  <div class="close-btn">Close <i class="fa fa-close"></i></div>
                  <form id="searchForm" action="#">
                      <div class="form-group">
                          <input type="search" name="search" placeholder="What are you searching for...">
                          <button type="submit" class="submit">Search</button>
                      </div>
                  </form>
              </div>
          </div>


          <div class="container-fluid d-flex align-items-center justify-content-between">
              <div class="navbar-header">
                  <!-- Navbar Header--><a href="{{url('admin/dashboard')}}" class="navbar-brand">
                      <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Dark</strong><strong>Admin</strong></div>
                      <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div>
                  </a>
                  <!-- Sidebar Toggle Btn-->
                  <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
              </div>
              <div class="right-menu list-inline no-margin-bottom">
                  <div class="list-inline-item"><a href="#" class="search-open nav-link"><i class="icon-magnifying-glass-browser"></i></a></div>

                  <!-- notification -->
                  <div class="list-inline-item dropdown">
                      <a id="navbarDropdownMenuLink1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle">
                          <i class="icon-email"></i>
                          @php
                          $unreadCount = Auth::user()->unreadNotifications->count();
                          @endphp
                          @if($unreadCount > 0)
                          <span class="badge dashbg-1">{{ $unreadCount }}</span>
                          @endif
                      </a>

                      <div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages">
                          @forelse(Auth::user()->unreadNotifications as $notification)
                          <a href="{{ route('mark_as_read', $notification->id) }}" class="dropdown-item message d-flex align-items-center">
                              <div class="profile">
                                  <img src="{{ asset('admincss/img/avatar-3.jpg') }}" alt="..." class="img-fluid">
                                  <div class="status online"></div>
                              </div>
                              <div class="content">
                                  <strong class="d-block">{{ $notification->data['title'] ?? 'Notification' }}</strong>
                                  <span class="d-block">{{ $notification->data['message'] ?? '' }}</span>
                                  <small class="date d-block">{{ $notification->created_at->diffForHumans() }}</small>
                              </div>
                          </a>
                          @empty
                          <div class="dropdown-item text-center text-white">
                              No new notifications
                          </div>
                          @endforelse
                      </div>
                  </div>

                  <!-- Tasks-->
                  <!-- <div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink2" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link tasks-toggle"><i class="icon-new-file"></i><span class="badge dashbg-3">9</span></a>
                      <div aria-labelledby="navbarDropdownMenuLink2" class="dropdown-menu tasks-list"><a href="#" class="dropdown-item">
                              <div class="text d-flex justify-content-between"><strong>Task 1</strong><span>40% complete</span></div>
                              <div class="progress">
                                  <div role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-1"></div>
                              </div>
                          </a><a href="#" class="dropdown-item">
                              <div class="text d-flex justify-content-between"><strong>Task 2</strong><span>20% complete</span></div>
                              <div class="progress">
                                  <div role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-3"></div>
                              </div>
                          </a><a href="#" class="dropdown-item">
                              <div class="text d-flex justify-content-between"><strong>Task 3</strong><span>70% complete</span></div>
                              <div class="progress">
                                  <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-2"></div>
                              </div>
                          </a><a href="#" class="dropdown-item">
                              <div class="text d-flex justify-content-between"><strong>Task 4</strong><span>30% complete</span></div>
                              <div class="progress">
                                  <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-4"></div>
                              </div>
                          </a><a href="#" class="dropdown-item">
                              <div class="text d-flex justify-content-between"><strong>Task 5</strong><span>65% complete</span></div>
                              <div class="progress">
                                  <div role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-1"></div>
                              </div>
                          </a><a href="#" class="dropdown-item text-center"> <strong>See All Tasks <i class="fa fa-angle-right"></i></strong></a>
                      </div>
                  </div> -->
                  <!-- Tasks end-->



                  <!-- Languages dropdown    -->
                  <div class="list-inline-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle">
                          <img src="https://th.bing.com/th/id/R.4f4158b9f77975a7ff15ec51d9073cec?rik=HPralaPEsUKnlA&riu=http%3a%2f%2fwww.clipartbest.com%2fcliparts%2faTe%2fX99%2faTeX99q6c.png&ehk=CcLZBTigUU4yBbPcka5Q90TfdashRRqohaVCHQTBBn4%3d&risl=&pid=ImgRaw&r=0" alt="UK Flag" width="16" height="11">
                          <span class="d-none d-sm-inline-block">UK English</span></a>
                      <div aria-labelledby="languages" class="dropdown-menu"><a rel="nofollow" href="#" class="dropdown-item">
                              <img src="img/flags/16/DE.png" alt="English" class="mr-2"><span>German</span></a><a rel="nofollow" href="#" class="dropdown-item">
                              <img src="img/flags/16/FR.png" alt="English" class="mr-2"><span>French </span></a></div>
                  </div>


                  <!-- Log out               -->
                  <form method="POST" action="{{ route('logout') }}" class="list-inline-item m-0 p-0">
                      @csrf
                      <button type="submit" class="nav-link btn btn-link p-0" style="color: inherit; background: none; border: none;">
                          {{ __('Logout') }} <i class="icon-logout"></i>
                      </button>
                  </form>

              </div>
          </div>
      </nav>
  </header>



  <!-- <a href="#" class="dropdown-item message d-flex align-items-center">
                              <div class="profile"><img src="{{asset('admincss/img/avatar-2.jpg')}}" alt="..." class="img-fluid">
                                  <div class="status away"></div>
                              </div>
                              <div class="content"> <strong class="d-block">Peter Ramsy</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">7:40am</small></div>
                          </a> -->
  <!-- <a href="#" class="dropdown-item message d-flex align-items-center">
                              <div class="profile"><img src="img/avatar-1.jpg" alt="..." class="img-fluid">
                                  <div class="status busy"></div>
                              </div>
                              <div class="content"> <strong class="d-block">Sam Kaheil</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">6:55am</small></div>
                          </a> -->
  <!-- <a href="#" class="dropdown-item message d-flex align-items-center">
                              <div class="profile"><img src="img/avatar-5.jpg" alt="..." class="img-fluid">
                                  <div class="status offline"></div>
                              </div>
                              <div class="content"> <strong class="d-block">Sara Wood</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">10:30pm</small></div>
                          </a><a href="#" class="dropdown-item text-center message"> <strong>See All Messages <i class="fa fa-angle-right"></i></strong></a> -->