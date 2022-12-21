<!-- Navbar -->
	  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
		<div class="container">
		  <a href="{{ route('Company.index') }}" class="navbar-brand">
			<img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light">Company Data</span>
		  </a>

		  <!-- Right navbar links -->
		  <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="{{ route('logout') }}">Logout</a>
			</li>
		  </ul>
		</div>
	  </nav>
	  <!-- /.navbar -->