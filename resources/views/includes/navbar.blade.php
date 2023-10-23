 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="{{ route('dashboard') }}" role="button">Dashboard</i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
      <form action="{{ route('logout') }}" method="POST" style="display:inline">
          @csrf
          <button type="submit" style="color:black;" onclick="return confirm('Confirm that you want to logout ?')"
            class="btn btn-primary">Logout</button>
      </form>
    </ul>
  </nav>
  <!-- /.navbar -->