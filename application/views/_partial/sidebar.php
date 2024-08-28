<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link">
		<img src="<?= base_url('assets/'); ?>dist/img/AdminLTELogo.png" alt="Logo"
			class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">Manajemen Gudang</span>
	</a>
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
				<li class="nav-item has-treeview">
					<a href="<?=base_url('dashboard')?>" class="nav-link <?= $title == 'Dashboard' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item has-treeview <?= $this->uri->segment('1') == 'master' ? 'menu-open' : '' ?>">
					<a href="#" class="nav-link <?= $this->uri->segment('1') == 'master' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-folder"></i>
						<p>
							Master Data
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<?php if($this->session->userdata('hak_akses') == '1'):?>
						<li class="nav-item has-treeview <?= $this->uri->segment('1') == 'master' ? 'menu-open' : '' ?>">
							
							<a href="<?= base_url('master/role') ?>"
								class="nav-link <?= $title == 'Role' ? 'active' : ''?>">
								<i class="fas fa-user nav-icon"></i>
								<p>Role</p>
							</a>

							<a href="<?= base_url('master/Departement') ?>"
								class="nav-link <?= $title == 'Departemen' ? 'active' : ''?>">
								<i class="fas fa-laptop-code"></i>
								<p>Departement</p>
							</a>

							<a href="<?= base_url('master/pengguna') ?>"
								class="nav-link <?= $title == 'Pengguna' ? 'active' : ''?>">
								<i class="fas fa-users nav-icon"></i>
								<p>Pengguna</p>
							</a>

							<a href="<?= base_url('master/Permintaan_barang') ?>"
								class="nav-link <?= $title == 'permintaan_barang' ? 'active' : ''?>">
								<i class="fas fa-bullhorn nav-icon"></i>
								<p>Permintaan Barang</p>
							</a>

							<a href="<?= base_url('master/Master_barang') ?>"
								class="nav-link <?= $title == 'Master_barang' ? 'active' : ''?>">
								<i class="fas fa-box nav-icon"></i>
								<p>Master Barang</p>
							</a>

							<a href="<?= base_url('master/Jenis_gudang') ?>"
								class="nav-link <?= $title == 'Jenis_gudang' ? 'active' : ''?>">
								<i class="fas fa-clipboard-list nav-icon"></i>
								<p>Master Jenis Gudang</p>
							</a>

							<a href="<?= base_url('master/Master_rack') ?>"
								class="nav-link <?= $title == 'Master_rack' ? 'active' : ''?>">
								<i class="fas fa-shopping-cart nav-icon"></i>
								<p>Master rack</p>
							</a>

							
							
							
						</li>
						<?php endif; ?>
					</ul>
				</li>
				<!-- 
				<li class="nav-item">
					<a href="#" class="nav-link" onclick="logout()">
						<i class="nav-icon fas fa-sign-out-alt text-danger"></i>
						<p class="text">Keluar</p>
					</a>
				</li> -->
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>