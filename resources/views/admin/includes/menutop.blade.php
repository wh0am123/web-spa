<div class="top_nav">
	<div class="nav_menu">
		<nav>
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="{{asset('/images/icono.png')}}" alt="">{{Auth::guard('admin')->user()->name}}
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						<li><a href="{{ route('admin.profile') }}"> Configuración <i class="fa fa-cogs pull-right"></i></a></li>
						<li><a href="{{ url('admin/logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
					</ul>
				</li>

				<form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>

				<li role="presentation" class="dropdown">
					<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-envelope-o"></i>
						<span class="badge bg-green">0</span>
					</a>
					<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
						<li>
							<a>
								<span class="image"><img src="{{asset('/images/icono.png')}}" alt="Profile Image" /></span>
								<span>
									<span>John Smith</span>
									<span class="time">3 mins ago</span>
								</span>
								<span class="message">
									Film festivals used to be do-or-die moments for movie makers. They were where...
								</span>
							</a>
						</li>

						<li>
							<a>
								<span class="image"><img src="{{asset('/images/icono.png')}}" alt="Profile Image" /></span>
								<span>
									<span>John Smith</span>
									<span class="time">3 mins ago</span>
								</span>
								<span class="message">
									Film festivals used to be do-or-die moments for movie makers. They were where...
								</span>
							</a>
						</li>
						<li>
							<a>
								<span class="image"><img src="{{asset('/images/icono.png')}}" alt="Profile Image" /></span>
								<span>
									<span>John Smith</span>
									<span class="time">3 mins ago</span>
								</span>
								<span class="message">
									Film festivals used to be do-or-die moments for movie makers. They were where...
								</span>
							</a>
						</li>
						<li>
							<a>
								<span class="image"><img src="{{asset('/images/icono.png')}}" alt="Profile Image" /></span>
								<span>
									<span>John Smith</span>
									<span class="time">3 mins ago</span>
								</span>
								<span class="message">
									Film festivals used to be do-or-die moments for movie makers. They were where...
								</span>
							</a>
						</li>
						<li>
							<div class="text-center">
								<a>
									<strong>See All Alerts</strong>
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
