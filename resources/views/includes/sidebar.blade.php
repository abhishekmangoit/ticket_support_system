@php $user = auth()->user(); @endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <span class="brand-text font-weight-light">Ticket Support System</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="{{ route('profile.edit') }}" class="d-block">{{$user->name}} 
            @if($user->role=='3')
                (user)
            @elseif ($user->role=='2') 
                (agent)
            @else
                (admin)
            @endif
        </a>
        </div>
      </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
          <a href="#" class="nav-link ">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Manage
            <i class="right fas fa-angle-left"></i>
          </p>
          </a>

          @if($user->role == '1')

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('category.index') }}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('user.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('ticket.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tickets</p>
              </a>
            </li>
          </ul>


          @elseif($user->role == '2')
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('ticket.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tickets</p>
              </a>
            </li>
          </ul>

          @else

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('ticket.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tickets</p>
              </a>
            </li>
          </ul>

          @endif

          </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
</aside>