<nav class="sidebar col-md-2 d-block bg-dark">
	<div class="sidebar-sticky">
			<ul class="nav flex-column">
					<li class="nav-item">
							<a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
									Dashboard
							</a>
					</li>
					<li class="nav-item">
							<a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
									Users
							</a>
					</li>
					<li class="nav-item">
							<a class="nav-link {{ request()->routeIs('movie.list') ? 'active' : '' }}" href="{{ route('movie.list') }}">
									Movies
							</a>
					</li>
					<li class="nav-item">
							<a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
									Home
							</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ request()->routeIs('admin.movies.create') ? 'active' : '' }}" href="{{ route('admin.movies.create') }}">
								Add movie
						</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ request()->routeIs('admin.tickets.index') ? 'active' : '' }}" href="{{ route('admin.tickets.index') }}">
							Tickets
					</a>
			</li>
			</ul>
	</div>
</nav>