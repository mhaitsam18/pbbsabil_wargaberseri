<!-- SWEETALLERT -->
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js') ?>"></script>

<!-- Vendor js -->
<script src="<?php echo base_url() ?>assets/admin/js/vendor.min.js"></script>

<!-- Plugins js -->
<script src="<?php echo base_url() ?>assets/admin/libs/morris-js/morris.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/libs/raphael/raphael.min.js"></script>

<!-- Dashboard init-->
<script src="<?php echo base_url() ?>assets/admin/js/pages/dashboard-4.init.js"></script>

<!-- App js -->
<script src="<?php echo base_url() ?>assets/admin/js/app.min.js"></script>

<!-- Footable js -->
<script src="<?php echo base_url() ?>assets/admin/libs/footable/footable.all.min.js"></script>

<!-- Init js -->
<script src="<?php echo base_url() ?>assets/admin/js/pages/foo-tables.init.js"></script>

<script src="<?php echo base_url() ?>assets/admin/libs/ladda/spin.js"></script>
<script src="<?php echo base_url() ?>assets/admin/libs/ladda/ladda.js"></script>

<!-- Buttons init js-->
<script src="<?php echo base_url() ?>assets/admin/js/pages/loading-btn.init.js"></script>

<script src="<?php echo base_url() ?>assets/libs/dropzone/dropzone.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/libs/dropify/dropify.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/pages/form-fileuploads.init.js"></script>
<!-- Summernote css -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?= base_url('assets/admin/js/demo/datatables-demo.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/demo/datatables2-demo.js') ?>"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>


<script type="text/javascript">
    const flashData = $('.flash-data').data('flashdata');
    const objek = $('.flash-data').data('objek');
    if (flashData) {
        //'Data ' + 
        Swal.fire({
            title: objek,
            text: flashData,
            icon: 'success'
        });
    }
    $('.tombol-hapus').on('click', function(e) {
        const hapus = $(this).data('hapus');
        const href = $(this).attr('href');
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data " + hapus + " akan dihapus!",
            icon: 'warning',
            confirmButtonText: 'Hapus',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    });

    $('.tombol-terima').on('click', function(e) {
        const href = $(this).attr('href');
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Pesanan yang diterima, tidak dapat dikembalikan!",
            icon: 'warning',
            confirmButtonText: 'diterima',
            showCancelButton: true,
            confirmButtonColor: '#32a852',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    });
    $('.tombol-yakin').on('click', function(e) {
        const href = $(this).attr('href');
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "",
            icon: 'warning',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            showCancelButton: true,
            confirmButtonColor: '#32a852',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    });
    $('.minta-password').on('click', function(e) {
        Swal.fire({
            title: 'Masukkan Password',
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Look up',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                return fetch(`//api.github.com/users/${login}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: `${result.value.login}'s avatar`,
                    imageUrl: result.value.avatar_url
                })
            }
        })
    });
</script>
<script type="text/javascript">
	$('.custom-file-input').on('change', function() {
		let filename = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(filename);
	});

	$(function() {
		$('.newMenuModalButton').on('click', function() {
			$('#newMenuModalLabel').html('Tambah Menu');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/menu'); ?>");
		});

		$('.updateMenuModalButton').on('click', function() {
			$('#newMenuModalLabel').html('Edit Menu');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/menu/updateMenu'); ?>");
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/menu/getUpdateMenu'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#menu').val(data.menu);
					$('#icon').val(data.icon);
					$('#active').attr("checked", true);
					if (data.is_active == 1) {
						$('#active').attr("checked", true);
					} else {
						$('#active').attr("checked", false);
					}
				}
			});
		});
	});

	$(function() {
		$('.newRoleModalButton').on('click', function() {
			$('#newRoleModalLabel').html('Tambah Role');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/admin/role'); ?>");
		});

		$('.updateRoleModalButton').on('click', function() {
			$('#newRoleModalLabel').html('Edit Role');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/admin/updateRole'); ?>");
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/admin/getUpdateRole'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#role').val(data.role);
				}
			});
		});
	});

	$(function() {
		$('.setRoleButton').on('click', function() {
			$('#setRoleLabel').html('Set User Role');
			$('.modal-footer button[type=submit]').html('Save');
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/admin/getUserData'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#name').val(data.name);
					$('#role_id').val(data.role_id);
				}
			});
		});
	});

	$(function() {
		$('.newSubMenuModalButton').on('click', function() {
			$('#newSubMenuModalLabel').html('Tambah SubMenu');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/menu/subMenu'); ?>");
		});

		$('.updateSubMenuModalButton').on('click', function() {
			$('#newSubMenuModalLabel').html('Edit SubMenu');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/menu/updateSubMenu'); ?>");
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/menu/getUpdateSubMenu'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#title').val(data.title);
					$('#menu_id').val(data.menu_id);
					$('#url').val(data.url);
					$('#icon').val(data.icon);
					$('#is_active').attr("checked", true);
					if (data.is_active == 1) {
						$('#is_active').attr("checked", true);
					} else if (data.is_active == 0) {
						$('#is_active').attr("checked", false);
					}
				}
			});
		});
	});

	$(function() {
		$('.newAgamaModalButton').on('click', function() {
			$('#newAgamaModalLabel').html('Tambah Agama');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/DataMaster/agama'); ?>");
		});

		$('.updateAgamaModalButton').on('click', function() {
			$('#newAgamaModalLabel').html('Edit Agama');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/DataMaster/updateAgama'); ?>");
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/DataMaster/getUpdateAgama'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#agama').val(data.agama);
				}
			});
		});
	});

	$(function() {
		$('.newPengumumanModalButton').on('click', function() {
			$('#newPengumumanModalLabel').html('Tambah Pengumuman');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/Pengurus/pengumuman'); ?>");
		});

		$('.updatePengumumanModalButton').on('click', function() {
			$('#newPengumumanModalLabel').html('Edit Pengumuman');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/Pengurus/updatePengumuman'); ?>");
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/Pengurus/getUpdatePengumuman'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#judul').val(data.judul);
					$('#isi').val(data.isi);
					$('#penulis').val(data.penulis);
				}
			});
		});
	});

	$(function() {
		$('.newBeritaModalButton').on('click', function() {
			$('#newBeritaModalLabel').html('Tambah Berita');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/Pengurus/berita'); ?>");
		});

		$('.updateBeritaModalButton').on('click', function() {
			$('#newBeritaModalLabel').html('Edit Berita');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/Pengurus/updateBerita'); ?>");
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/Pengurus/getUpdateBerita'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#judul').val(data.judul);
					$('#isi').val(data.isi);
					$('#penulis').val(data.penulis);
				}
			});
		});
	});

	$(function() {
		$('.newPeraturanModalButton').on('click', function() {
			$('#newPeraturanModalLabel').html('Tambah Peraturan');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/Pengurus/peraturan'); ?>");
		});

		$('.updatePeraturanModalButton').on('click', function() {
			$('#newPeraturanModalLabel').html('Edit Peraturan');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/Pengurus/updatePeraturan'); ?>");
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/Pengurus/getUpdatePeraturan'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#judul').val(data.judul);
					$('#isi').val(data.isi);
					$('#penulis').val(data.penulis);
				}
			});
		});
	});

	$(function() {
		$('.newNotulensiModalButton').on('click', function() {
			$('#newNotulensiModalLabel').html('Tambah Notulensi');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/Pengurus/notulensi'); ?>");
		});

		$('.updateNotulensiModalButton').on('click', function() {
			$('#newNotulensiModalLabel').html('Edit Notulensi');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/Pengurus/updateNotulensi'); ?>");
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/Pengurus/getUpdateNotulensi'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#judul').val(data.judul);
					$('#isi').val(data.isi);
					$('#penulis').val(data.penulis);
				}
			});
		});
	});

	$(function() {
		$('.newMusrembangModalButton').on('click', function() {
			$('#newMusrembangModalLabel').html('Tambah Musrembang');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/Pengurus/musrembang'); ?>");
		});

		$('.updateMusrembangModalButton').on('click', function() {
			$('#newMusrembangModalLabel').html('Edit Musrembang');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/Pengurus/updateMusrembang'); ?>");
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/Pengurus/getUpdateMusrembang'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#program').val(data.program);
					$('#kegiatan').val(data.kegiatan);
					$('#sasaran').val(data.sasaran);
					$('#volume_lokasi').val(data.volume_lokasi);
					$('#pengusul').val(data.pengusul);
					$('#keterangan').val(data.keterangan);
					$('#status_musrembang').val(data.status);
				}
			});
		});
	});

	$(function() {
		$('.detailKeluhanModalButton').on('click', function() {
			$('.modal-content form').attr('action', "<?= base_url('admin/KeluhanAspirasi/updateKeluhan'); ?>");
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/KeluhanAspirasi/getUpdateKeluhan'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#idk').val(data.id);
					$('#nama_keluhan').val(data.nama);
					$('#email_keluhan').val(data.email);
					$('#no_wa_keluhan').val(data.no_wa);
					$('#jenis_keluhan').val(data.jenis_keluhan);
					$('#keluhan').val(data.keluhan);
					$('#status_keluhan').val(data.status);
					$('#waktu_kirim_keluhan').val(data.waktu_kirim);
					$('#bukti_keluhan').attr('src', "<?= base_url('uploads/keluhan-aspirasi/') ?>" + data.bukti);
				}
			});
		});
	});

	$(function() {
		$('.detailAspirasiModalButton').on('click', function() {
			$('.modal-content form').attr('action', "<?= base_url('admin/KeluhanAspirasi/updateAspirasi'); ?>");
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/KeluhanAspirasi/getUpdateAspirasi'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#ida').val(data.id);
					$('#nama_aspirasi').val(data.nama);
					$('#email_aspirasi').val(data.email);
					$('#no_wa_aspirasi').val(data.no_wa);
					$('#jenis_aspirasi').val(data.jenis_aspirasi);
					$('#aspirasi').val(data.aspirasi);
					$('#status_aspirasi').val(data.status);
					$('#waktu_kirim_aspirasi').val(data.waktu_kirim);
					$('#bukti_aspirasi').attr('src', "<?= base_url('uploads/keluhan-aspirasi/') ?>" + data.bukti);
				}
			});
		});
	});

	$(function() {
		$('.newStrukturModalButton').on('click', function() {
			$('#newStrukturModalLabel').html('Tambah Pengurus RT');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/admin/strukturOrganisasi') ?>");
		});

		$(document).on('click', '.updateStrukturModalButton', function() {
			event.preventDefault();
			$('#newStrukturModalLabel').html('Edit Pengurus RT');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/admin/updateStruktur') ?>");
			const id = $(this).data('id');
			$.getJSON({
				url: "<?= base_url('admin/admin/getUpdateStruktur/') ?>" + id,
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#nama').val(data.nama);
					$('#jabatan').val(data.jabatan);
					$('#atasan').val(data.parent_id);
					$('#foto').removeAttr("required");
				}
			});
		});
	});


	$(function() {
		$('.newStrukturPetugasKeamananModalButton').on('click', function() {
			$('#newStrukturPetugasKeamananModalLabel').html('Tambah Petugas Keamanan');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/admin/strukturOrganisasiPetugasKeamanan') ?>");
		});

		$(document).on('click', '.updateStrukturPetugasKeamananModalButton', function() {
			event.preventDefault();
			$('#newStrukturPetugasKeamananModalLabel').html('Edit Petugas Keamanan');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/admin/updateStrukturPetugasKeamanan') ?>");
			const id = $(this).data('id');
			$.getJSON({
				url: "<?= base_url('admin/admin/getUpdateStrukturPetugasKeamanan/') ?>" + id,
				// data: {id : id},
				// method: 'get',
				// dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#nama').val(data.nama);
					$('#jabatan').val(data.jabatan);
					$('#atasan').val(data.parent_id);
					$('#foto').removeAttr("required");
				}
			});
		});
	});

	$(function() {
		$('.newStrukturPetugasRWModalButton').on('click', function() {
			$('#newStrukturPetugasRWModalLabel').html('Tambah Petugas RW');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/admin/strukturOrganisasiPetugasRW') ?>");
		});

		$(document).on('click', '.updateStrukturPetugasRWModalButton', function() {
			event.preventDefault();
			$('#newStrukturPetugasRWModalLabel').html('Edit Petugas RW');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/admin/updateStrukturPetugasRW') ?>");
			const id = $(this).data('id');
			$.getJSON({
				url: "<?= base_url('admin/admin/getUpdateStrukturPetugasRW/') ?>" + id,
				// data: {id : id},
				// method: 'get',
				// dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#nama').val(data.nama);
					$('#jabatan').val(data.jabatan);
					$('#atasan').val(data.parent_id);
					$('#foto').removeAttr("required");
				}
			});
		});
	});

	$(function() {
		$('.newKontenModalButton').on('click', function() {
			$('#newKontenModalLabel').html('Tambah Konten');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-content form')[0].reset();
			$('.modal-content form').attr('action', "<?= base_url('admin/DataMaster/konten'); ?>");
		});

		$('.updateKontenModalButton').on('click', function() {
			$('#newKontenModalLabel').html('Edit Konten');
			$('.modal-footer button[type=submit]').html('Simpan');
			$('.modal-content form').attr('action', "<?= base_url('admin/DataMaster/updateKonten'); ?>");
			const id = $(this).data('id');
			jQuery.ajax({
				url: "<?= base_url('admin/DataMaster/getUpdateKonten'); ?>",
				data: {
					id: id
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#id').val(data.id);
					$('#header').val(data.header);
					$('#konten').val(data.content);
					$('#footer').val(data.footer);
				}
			});
		});
	});
</script>
<script type="text/javascript">
	$('.form-check-input').on('click', function() {
		const menuId = $(this).data('menu');
		const roleId = $(this).data('role');

		$.ajax({
			url: "<?= base_url('admin/admin/changeAccess') ?>",
			type: 'post',
			data: {
				menuId: menuId,
				roleId: roleId
			},
			success: function() {
				document.location.href = "<?= base_url('admin/admin/roleAccess/'); ?>" + roleId;
			}
		});
	})
</script>