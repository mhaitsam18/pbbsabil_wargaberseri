<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

	<div class="slimscroll-menu">

		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<ul class="metismenu" id="side-menu">
				<li class="menu-title">Navigation</li>

				<?php
				$role = $this->session->userdata('role_id');
				if ($role == 1 || $role == 6 || $role == 7) : ?>
					<li>
						<a href="<?php echo base_url('admin/Dashboard') ?>">
							<i class="fe-pocket"></i>
							<span> Dashboard </span>
						</a>
					</li>
					<li>
						<a href="javascript: void(0);">
							<i class="fe-users"></i>
							<span> Pendataan Warga </span>
							<span class="menu-arrow"></span>
						</a>
						<ul class="nav-second-level" aria-expanded="false">
							<li>
								<a href="<?php echo base_url('admin/warga/data_warga') ?>">
									</i>
									<span> Data Warga </span>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url('admin/warga/info_warga') ?>">
									</i>
									<span> Info Warga </span>
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript: void(0);">
							<i class="fe-clipboard"></i>
							<span> Surat </span>
							<span class="menu-arrow"></span>
						</a>
						<ul class="nav-second-level" aria-expanded="false">
							<li>
								<a href="<?php echo base_url('admin/surat/template_surat') ?>">
									<span> Penyediaan Surat </span>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url('admin/surat') ?>">
									<span> Pengajuan Surat </span>
								</a>
							</li>
						</ul>
					</li>
				<?php endif ?>
				<li>
					<a href="javascript: void(0);">
						<!-- <i class="fe-users"></i> -->
						<i class="fas fa-donate"></i>
						<span> Iuran </span>
						<span class="menu-arrow"></span>
					</a>
					<ul class="nav-second-level" aria-expanded="false">
						<li>
							<a href="<?php echo base_url('admin/pemasukan') ?>">
								</i>
								<span> Pemasukan </span>
							</a>
						</li>
						<li>

							<a href="<?php echo base_url('admin/iuran/view_dataIuran') ?>">
								</i>
								<span> Data Pembayaran Iuran </span>
							</a>

						</li>
						<li>
							<a href="<?php echo base_url('admin/iuran/riwayat_iuran') ?>">
								<span> Riwayat Verifikasi Iuran </span>
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript: void(0);">
						<i class="far fa-money-bill-alt"></i>
						<span> Keuangan </span>
						<span class="menu-arrow"></span>
					</a>
					<ul class="nav-second-level" aria-expanded="false">
						<li>
							<a href="<?php echo base_url('admin/penggunaan') ?>">
								<span> Pengeluaran </span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/keuangan') ?>">
								<span> Data Keuangan </span>
							</a>
						</li>
					</ul>
				</li>

				<?php
				$role_id = $this->session->userdata('role_id');
				$queryMenu = "SELECT um.id, menu, icon FROM user_menu AS um JOIN user_access_menu AS uam ON um.id = uam.menu_id WHERE uam.role_id = $role_id AND active = 1 ORDER BY uam.menu_id ASC";
				$menu = $this->db->query($queryMenu)->result_array();
				?> <?php foreach ($menu as $m) : ?> <li>
						<a href="javascript: void(0);">
							<i class="<?= $m['icon'] ?>"></i>
							<span><?= $m['menu'] ?></span>
							<span class="menu-arrow"></span>
						</a>
						<ul class="nav-second-level" aria-expanded="false">
							<?php
							$queryMenu = "SELECT *, usm.icon AS usm_icon FROM user_sub_menu AS usm JOIN user_menu AS um ON usm.menu_id = um.id WHERE usm.menu_id = $m[id] AND usm.is_active = 1";
							$subMenu = $this->db->query($queryMenu)->result_array();
							?>
							<?php foreach ($subMenu as $sm) : ?>
								<?php if ($sm['title'] == $title) : ?>
									<li class="nav-item active">
								<?php else : ?>
									<li class="nav-item">
								<?php endif ?>
								<a href="<?= base_url('/admin/' . $sm['url']) ?>">
									<i class="<?= $sm['usm_icon'] ?>"></i>
									<span><?= $sm['title'] ?></span>
								</a>
								</li>
							<?php endforeach ?>
						</ul>
					</li>
				<?php endforeach ?>

			</ul>
		</div>
		<!-- End Sidebar -->
		<div class="clearfix"></div>
	</div>
	<!-- Sidebar -left -->
</div>
