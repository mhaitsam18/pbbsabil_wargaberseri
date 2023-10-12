<!-- footer Start -->
<footer class="footer bg-black-50">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
				<h2 class="text-white mb-4">Warga Berseri</h2>
				<p>Aplikasi Warga Berseri adalah aplikasi yang dapat mempermudah warga dalam melakukan pendataan. Aplikasi ini pun akan membantu warga dalam mengakses informasi seputar Perumahan Permata Buah Batu.</p>
			</div>


			<div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
				<div class="footer-widget recent-blog">
					<h4 class="mb-4 text-white letter-spacing text-uppercase">Postingan Baru-baru ini</h4>
					<div>
						<a href="javascript:void(0);" class="text-white">Pendataan Warga</a>
						<p class="text-sm mt-2 text-white-50">30 february 2019</p>
					</div>
					<div class="mt-4">
						<a href="javascript:void(0);" class="text-white">Informasi Fasilitas</a>
						<p class="text-sm mt-2 text-white-50">30 february 2019</p>
					</div>

				</div>
			</div>
			<div class="col-lg-2 col-md-5 mb-5 mb-lg-0">
				<div class="footer-widget">
					<h4 class="mb-4 text-white letter-spacing text-uppercase">Link Cepat</h4>
					<ul class="list-unstyled footer-menu lh-40 mb-0">
						<li><a href="javascript:void(0);"><i class="ti-angle-double-right mr-2"></i>Pendataan Warga</a></li>
						<li><a href="javascript:void(0);"><i class="ti-angle-double-right mr-2"></i>Pendataan Iuran</a></li>
						<li><a href="javascript:void(0);"><i class="ti-angle-double-right mr-2"></i>Data Fasilitas</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-5">
				<div class="footer-widget">
					<h4 class="mb-4 text-white letter-spacing text-uppercase">Lokasi</h4>
					<p>PBB- Permata Buah Batu,
						Kabupaten Bandung </p>
					<span class="text-white">082219725523</span>
					<span class="text-white">pbb@gmail.com</span>
				</div>
			</div>
		</div>

		<div class="row align-items-center mt-5 px-3 bg-black mx-1">
			<div class="col-lg-4">
				<p class="text-white mt-3">Warga Berseri © 2020 </p>
			</div>
			<div class="col-lg-6 ml-auto text-right">
				<ul class="list-inline mb-0 footer-socials">
					<li class="list-inline-item"><a href="javascript:void(0);"><i class="ti-facebook"></i></a></li>
					<li class="list-inline-item"><a href="javascript:void(0);"><i class="ti-twitter"></i></a></li>
					<li class="list-inline-item"><a href="javascript:void(0);"><i class="ti-github"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<!-- Section Footer End -->

<!-- Section Footer Scripts -->
</div>
<!-- Main jQuery -->
<script src="<?php echo base_url('assets/user/') ?>plugins/jquery/jquery.js"></script>
<!-- Bootstrap 4.3.1 -->
<script src="<?php echo base_url('assets/user/') ?>plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- Slick Slider -->
<script src="<?php echo base_url('assets/user/') ?>plugins/slick-carousel/slick/slick.min.js"></script>
<!--  Magnific Popup-->
<script src="<?php echo base_url('assets/user/') ?>plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<!-- Form Validator -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.32/jquery.form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu5nZKbeK-WHQ70oqOWo-_4VmwOwKP9YQ"></script>
<script src="<?php echo base_url('assets/user/') ?>plugins/google-map/gmap.js"></script>
<script src="<?php echo base_url('assets/user/') ?>js/script.js"></script>


<!-- SWEETALLERT -->


<?php if ($this->uri->segment(3) == "strukturOrganisasiRW") { ?>
	<script src="<?php echo base_url('assets/user/asset_chart/go.js') ?>"></script>
	<script>
		function init() {
			var $ = go.GraphObject.make; // for conciseness in defining templates

			myDiagram =
				$(go.Diagram, "struktur_organisasi_rw-chart", // must be the ID or reference to div
					{
						maxSelectionCount: 1, // users can select only one part at a time
						validCycle: go.Diagram.CycleDestinationTree, // make sure users can only create trees
						layout: $(go.TreeLayout, {
							treeStyle: go.TreeLayout.StyleLastParents,
							arrangement: go.TreeLayout.ArrangementHorizontal,
							// properties for most of the tree:
							angle: 90,
							layerSpacing: 35,
							// properties for the "last parents":
							alternateAngle: 90,
							alternateLayerSpacing: 35,
							alternateAlignment: go.TreeLayout.AlignmentBus,
							alternateNodeSpacing: 20
						}),
						'allowMove': false,
						"undoManager.isEnabled": true // enable undo & redo
					});

			// This function provides a common style for most of the TextBlocks.
			// Some of these values may be overridden in a particular TextBlock.
			function textStyle() {
				return {
					font: "9pt 'Poppins',sans-serif"
				};
			}

			// This converter is used by the Picture.
			function findHeadShot(key) {
				if (key) {
					// console.log(key);
					return `<?= base_url('uploads/struktur-organisasi-rw/'); ?>${key}`;
				} else {
					// console.log(key);
					return `<?= base_url('uploads/struktur-organisasi-rw/'); ?>default.png`;
				}
			}

			// define the Node template
			myDiagram.nodeTemplate =
				$(go.Node, "Auto", {
						click: function(e, obj) {
							var diagram = obj.diagram;

							diagram.startTransaction("highlight");
							diagram.clearHighlighteds();
							diagram.commitTransaction("highlight");

							if (obj.part.data.name) {
								window.open(obj.part.data.url);
							}
						}
					},
					// for sorting, have the Node.text be the data.name
					new go.Binding("text", "name"),
					// define the node's outer shape
					$(go.Shape, "RoundedRectangle", {
						name: "SHAPE",
						stroke: 'black',
						strokeWidth: 0.5,
						fill: '#FFF',
						// set the port properties:
						portId: "",
						cursor: "pointer"
					}),
					$(go.Panel, "Horizontal",
						$(go.Picture, {
								name: "Picture",
								desiredSize: new go.Size(70, 70),
								imageStretch: go.GraphObject.UniformToFill,
								imageAlignment: go.Spot.Top
							},
							new go.Binding("source", "avatar", findHeadShot)),
						// define the panel where the text will appear
						$(go.Panel, "Table", {
								minSize: new go.Size(100, NaN),
								maxSize: new go.Size(100, NaN),
								height: 100,
								margin: new go.Margin(6, 10, 0, 6),
								defaultAlignment: go.Spot.Left
							},
							$(go.RowColumnDefinition, {
								column: 1,
								width: 4
							}),
							$(go.TextBlock, textStyle(), // the name
								{
									row: 0,
									column: 0,
									columnSpan: 5,
									font: "bold 10pt 'Poppins',sans-serif",
									isMultiline: false,
									minSize: new go.Size(10, 16)
								},
								new go.Binding("text", "name")),
							$(go.TextBlock, textStyle(), {
									row: 1,
									column: 0,
									columnSpan: 4,
									isMultiline: false,
									margin: new go.Margin(6, 0, 0, 0),
									minSize: new go.Size(10, 14)
								},
								new go.Binding("text", "title"))
						) // end Table Panel
					) // end Horizontal Panel
				); // end Node

			// define the Link template
			myDiagram.linkTemplate =
				$(go.Link, go.Link.Orthogonal, {
						corner: 5,
						relinkableFrom: true,
						relinkableTo: true
					},
					$(go.Shape, {
						strokeWidth: 1.5,
						stroke: "#000"
					})); // the link shape

			// read in the JSON-format data from the "mySavedModel" element
			load();

			myDiagram.toolManager.panningTool.isEnabled = false;

			myDiagram.commandHandler.zoomToFit();
			myDiagram.isReadOnly = true;
		} // end init

		function load() {
			myDiagram.model = go.Model.fromJson(data_struktur_petugas_rw);
			// make sure new data keys are unique positive integers
			var lastkey = 1;
			myDiagram.model.makeUniqueKeyFunction = function(model, data) {
				var k = data.key || lastkey;
				while (model.findNodeDataForKey(k)) k++;
				data.key = lastkey = k;
				return k;
			};
		}

		let data_organisasi_rw = <?= json_encode($petugas_rw); ?>;
		// console.log(data_organisasi_rw);
		let data_struktur_petugas_rw = {
			'class': 'go.TreeModel',
			'nodeDataArray': [

			]
		}

		data_organisasi_rw.forEach(element => {
			if ($.isEmptyObject(element.parent_id)) {
				data_struktur_petugas_rw.nodeDataArray.push({
					'key': element.id,
					'avatar': element.foto,
					'name': element.nama,
					'title': element.jabatan,
				});
			} else {
				data_struktur_petugas_rw.nodeDataArray.push({
					'key': element.id,
					'avatar': element.foto,
					'name': element.nama,
					'title': element.jabatan,
					'parent': element.parent_id
				});
			}
		});

		$(document).ready(() => {
			init();
			// console.log(data_struktur_petugas_rw);
			// console.log(data_organisasi_rw);

			setTimeout(() => {
				if ($('body').hasClass('menu-expanded')) {
					$(".modern-nav-toggle").trigger("click");
					$(".main-menu").trigger("mouseleave");
				}

				setTimeout(() => {
					myDiagram.commandHandler.zoomToFit();
				}, 250);
			}, 500);

			let _zoom_calc = 100;
			$('#zoom-plus').click(() => {
				_zoom_calc += 10;
				$('#zoom-calc').html(`${_zoom_calc}%`);
				myDiagram.commandHandler.increaseZoom();

				if ($('#zoom-minus').prop('disabled')) {
					$('#zoom-minus').prop('disabled', false);
				}
			});

			$('#zoom-minus').click(() => {
				_zoom_calc -= 10;
				$('#zoom-calc').html(`${_zoom_calc}%`);
				myDiagram.commandHandler.decreaseZoom();

				if (_zoom_calc == 10) {
					$('#zoom-minus').prop('disabled', true);
				}
			});

			$('#zoom-reset').click(() => {
				_zoom_calc = 100;
				$('#zoom-calc').html(`${_zoom_calc}%`);
				myDiagram.commandHandler.zoomToFit();

				if ($('#zoom-minus').prop('disabled')) {
					$('#zoom-minus').prop('disabled', false);
				}
			});
		});
	</script>
<?php } ?>

</body>

</html>
