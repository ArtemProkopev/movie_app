<nav class="sidebar col-md-2 d-block bg-dark">
	<div class="sidebar-sticky">
			<ul class="nav flex-column">
					<li class="nav-item">
							<a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
									Dashboard
							</a>
					</li>
					<li class="nav-item">
							<a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
									Users
							</a>
					</li>
			</ul>
	</div>
</nav>