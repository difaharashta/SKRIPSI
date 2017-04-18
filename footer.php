  <!-- jQuery Version 1.11.0 -->
    <script src="admin/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin/js/plugins/metisMenu/metisMenu.min.js"></script>



    <!-- DataTables JavaScript -->
    <script src="admin/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
    <script type="text/javascript">
    $('document').ready(function(){
        $('.importBtn').click(function(){
            // alert('haha');
            $(this).next().fadeIn();
            $('#formupload').fadeIn();
            return false;
        });
		
		$('.katalogclick').click(function(){
			/*
			$('.childkatalog').hide();
			$(this).next().fadeIn();
			$(this).next().next().fadeIn();
			*/
			return false;
		});
    })
    </script>

</body>

</html>
