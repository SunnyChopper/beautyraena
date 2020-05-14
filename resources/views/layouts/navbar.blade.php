<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
	<div class="container">
		<a class="navbar-brand" href="{{ url('/') }}">Beauty Raena</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="main-navbar">
			@if(Auth::guest())
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ url('/#intro') }}">Intro</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ url('/reviews') }}">Reviews</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Members</a>
					<div class="dropdown-menu" aria-labelledby="dropdown07">
						<a class="dropdown-item" href="{{ url('/login') }}">Login</a>
						<a class="dropdown-item" href="{{ url('/register') }}">Register</a>
					</div>
				</li>
			</ul>
			@elseif((!Auth::guest()) && (App\Helpers\AdminHelper::isAdmin() == false))
			@elseif((!Auth::guest()) && (App\Helpers\AdminHelper::isAdmin() == true))
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/admin/dashboard') { echo "active"; } ?>" href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
				<li class="nav-item"><a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/admin/products') { echo "active"; } ?>" href="{{ url('/admin/products') }}">Products</a></li>
				<li class="nav-item"><a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/admin/orders') { echo "active"; } ?>" href="{{ url('/admin/orders') }}">Orders</a></li>
				<li class="nav-item"><a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/admin/tickets') { echo "active"; } ?>" href="{{ url('/admin/tickets') }}">Tickets</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ url('/admin/logout') }}">Logout</a></li>
			</ul>
			@endif
		</div>
	</div>
</nav>