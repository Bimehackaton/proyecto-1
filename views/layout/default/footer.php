		</div>
        <!-- /#page-wrapper -->
		
		
		<!-- jQuery Version 1.11.0 -->
		<script src="<?php echo $_layoutParams['ruta_js']; ?>jquery-1.11.0.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="<?php echo $_layoutParams['ruta_js']; ?>bootstrap.min.js"></script>

		<!-- Metis Menu Plugin JavaScript -->
		<script src="<?php echo $_layoutParams['ruta_js']; ?>plugins/metisMenu/metisMenu.min.js"></script>

		<!-- Custom Theme JavaScript -->
		<script src="<?php echo $_layoutParams['ruta_js']; ?>sb-admin-2.js"></script>

		<?php
		
		if(isset($_layoutParams['js']) && count($_layoutParams['js'])): ?>
			<?php for($i=0;$i<count($_layoutParams['js']);$i++): ?>
				<script type="text/javascript" src="<?php echo $_layoutParams['js'][$i]; ?>"></script>
			<?php endfor; ?>
		<?php endif; ?>
					
					
		<?php if($this->opcion == 'conciertos'):
			?>					
				<script>
				$(document).ready(function() {
					$('#dataTables-example').dataTable({
						"order": [[ 1, "asc" ]]
					});
				});
				</script>
			<?php
		endif;
		?>
	</body>

</html>