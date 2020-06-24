<!DOCTYPE html>
<html lang="en">

<head>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>

      @php
            function nav($key,$navigation){
                if(array_key_exists($key,$navigation)){
                    if($navigation[$key] == 1){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }

            function nav_array($keys,$navigation){
                foreach($keys as $key){
                    if(nav($key, $navigation)){
                        return true;
                    }
                }
                return false;
            }

            function active($key,$page_name){
                if($key == $page_name){
                    return "active";
                }
            }
      @endphp
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      @if(nav('dashboard',$navigation) || 1)
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
      @endif
      @if(nav_array(['video.index','channel.index'],$navigation))
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVideoChannel" aria-expanded="true" aria-controls="collapseVideoChannel">
              <i class="fas fa-fw fa-wrench"></i>
              <span>Video & Channel</span>
            </a>
            <div id="collapseVideoChannel" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                @if(nav('video.index',$navigation)) <a class="collapse-item" href="{{ route('video.index') }}">Videos</a> @endif
                @if(nav('channel.index',$navigation)) <a class="collapse-item" href="{{ route('channel.index') }}">Channels</a> @endif
              </div>
            </div>
          </li>
        @endif
      @if(nav_array(['roles_settings','color.index','department.index','status.index','user.index','gender.index','role.index','function.index'],$navigation))
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Settings
        </div>
        @if(nav_array(['color.index','department.index','status.index','user.index','gender.index','role.index','function.index'],$navigation))
          <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
              <i class="fas fa-fw fa-wrench"></i>
              <span>Variables</span>
              </a>
              <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Custom Variables:</h6>
                  @if(nav('user.index',$navigation))<a class="collapse-item" href="{{ route('user.index') }}"> Users </a>@endif
                  @if(nav('department.index',$navigation))<a class="collapse-item" href="{{ route('department.index') }}"> Departments </a>@endif
                  @if(nav('status.index',$navigation))<a class="collapse-item" href="{{ route('status.index') }}"> Status </a>@endif
                  @if(nav('gender.index',$navigation))<a class="collapse-item" href="{{ route('gender.index') }}"> Genders </a>@endif
                  @if(nav('role.index',$navigation))<a class="collapse-item" href="{{ route('role.index') }}"> Roles </a>@endif
                  @if(nav('variable.index',$navigation))<a class="collapse-item" href="{{ route('variable.index') }}"> Variables </a>@endif
                  <!-- @if(nav('function.index',$navigation))<a class="collapse-item" href="{{ route('function.index') }}"> Functions </a>@endif -->
              </div>
              </div>
          </li>
        @endif
        @if(nav_array(['roles_settings'],$navigation))
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmins" aria-expanded="true" aria-controls="collapseAdmins">
              <i class="fas fa-fw fa-wrench"></i>
              <span>Administration</span>
            </a>
            <div id="collapseAdmins" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                @if(nav('roles_settings',$navigation)) <a class="collapse-item" href="{{ route('roles_settings') }}">Roles Settings</a> @endif
              </div>
            </div>
          </li>
        @endif
      @endif

      <!-- Nav Item - Tables -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li> -->

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form method="GET" action="#" class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <input class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Notification
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <!-- <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt=""> -->
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    
                </span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
                @guest  
                @else
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        &nbsp;{{ Auth::user()->fname . ' ' . Auth::user()->lname }}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('words.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </a>
                    </div>
                @endguest   
                
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div> -->

          <?php
            if($authorization){
                ?>
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Error 401: Your not Authorized to Access This Page, Please contact System admin {{ $page_name ?? "unknown" }}
                        </div>
                    </div>
                <?php
            }else{
                ?>
                    @yield('content')
                <?php
            }
        ?>
        <br />
      </div>
      <!-- End of Main Content -->

        <button type="button" style="display:none" class="btn btn-success mb-1" data-toggle="modal" data-target="#errorModel" id="errorModelButton"> Large </button>
        <div class="modal fade" id="errorModel" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><div id="largeModalLabel"></div></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="body_sms"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Prime Consolidators</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

    <script>
        function removeA(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax= arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }
    </script>

    <div class="content">
             @yield('model_errors')
             <?php
                if($errors->has('sms')){
                    $call_model_sms($errors->first('heading'),$errors->first('sms'),$errors->first('type'));
                }
            ?>
    </div>
    <div class="content">
        <script>
            function get_clear_email(){
                $.ajax({
                    url : "{{ route('clear_pending_mail')}}",
                    type : "GET",
                    success : function(response){
                        console.log(response);
                    }
                });
            }

            $(document).ready(function(){
                get_clear_email();
            });
            dt_lengthMenu = [ [10, 25, 50, -1], [10, 25, 50, "All"] ];
            dt_dom = "lB<'pull-right'f>rti<'pull-right'p>";
            dt_buttons = "";
        </script>
        @yield('datatable_section')
    </div>
</body>

</html>
