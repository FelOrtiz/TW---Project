<header class="main-header">
	<nav class="navbar navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<a href="/" class="navbar-brand"><b>Gestión</b> Canchas</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<i class="fa fa-bars"></i>
				</button>
			</div>

			<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
				<ul class="nav navbar-nav">
					@if(\Auth::user()->isAdmin())
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Instituciones <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/institution/create"><i class="fa fa-plus"></i> Registrar</a></li>
							<li><a href="/institution/index"><i class="fa fa-list"></i> Ver Todas</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Recintos <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/enclosure/create"><i class="fa fa-plus"></i> Registrar</a></li>
							<li><a href="/enclosure/index"><i class="fa fa-list"></i> Ver Todas</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Canchas <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/field/create"><i class="fa fa-plus"></i> Registrar</a></li>
							<li><a href="/field/index"><i class="fa fa-list"></i> Ver Todas</a></li>
						</ul>
					</li>
					@elseif(\Auth::user()->isPlayer())
					<li><a href="#">Crear equipo</a></li>
					<li><a href="#">Buscar equipo</a></li>
					@endif
					<li><a href="#">Link <span class="sr-only">(current)</span></a></li>
					<li><a href="#">Link</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
							<li class="divider"></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

					<li class="dropdown notifications-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i>
							<span class="label label-warning">10</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have 10 notifications</li>
							<li>
								<ul class="menu">
									<li>
										<a href="#">
											<i class="fa fa-users text-aqua"></i> 5 new members joined today
										</a>
									</li>
								</ul>
							</li>
							<li class="footer"><a href="#">View all</a></li>
						</ul>
					</li>
					<li class="dropdown notifications-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-user" style="margin-right: 5px;"></i> {{ \Auth::user()->person->name() }}
						</a>
						<ul class="dropdown-menu">
							<li class="header text-center"></li>
							<li style="height: auto;">
								<ul class="menu" style="height: auto;">
	                            	<li>
	                                    <a href="#"
	                                        onclick="event.preventDefault();
	                                                 document.getElementById('logout-form').submit();">
	                                        <i class="fa fa-sign-out"></i> Cerrar Sesión
	                                    </a>

	                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                        {{ csrf_field() }}
	                                    </form>
	                                </li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>