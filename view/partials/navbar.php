<nav class="navbar navbar-light bg-primary justify-content-between">
    <div class="container-fluid">
        <a class="navbar-brand">Navbar</a>
            <form class="navbar-left navbar-form nav-search" action="">
                <div class="input-group">
                    <input type="text" placeholder="Search ..." class="form-control" />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-search">
                                <i class="fa fa-search search-icon"></i>
                            </button>
                        </div>
                </div>
        </form>
    </div>
</nav>
<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-secondary">
						<li class="nav-item">
							<a data-bs-toggle="collapse" href="#submenu">
								<i class="fas fa-bars"></i>
								<p>Menu Levels</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="submenu">
								<ul class="nav nav-collapse">
									<li>
										<a data-bs-toggle="collapse" href="#subnav1">
											<span class="sub-item">Level 1</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subnav1">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="#">
														<span class="sub-item">Level 2</span>
													</a>
												</li>
												<li>
													<a href="#">
														<span class="sub-item">Level 2</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<a data-bs-toggle="collapse" href="#subnav2">
											<span class="sub-item">Level 1</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subnav2">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="#">
														<span class="sub-item">Level 2</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<a href="#">
											<span class="sub-item">Level 1</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>