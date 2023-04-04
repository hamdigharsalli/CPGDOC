<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Recherche documentaire CPG</title>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome/css/font-awesome.min.css">
        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css"/>
        <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css"/>

        <script type="text/javascript" src="assets/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="assets/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="assets/js/jszip.min.js"></script>
        <script type="text/javascript" src="assets/js/pdfmake.min.js"></script>
        <script type="text/javascript" src="assets/js/vfs_fonts.js"></script>
        <script type="text/javascript" src="assets/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="assets/js/buttons.print.min.js"></script>

        <style>

            body {

                background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%);

            }
        </style>
	</head>
	<body>
        <script>
                    $("#search_text").val("");

        </script>
		<div class="container-fluid">
			<br />

			<h2 align="center">Recherche documentaire CPG</h2><br />


            <!-- Avec un bouton à droite -->
                <div class="input-group">
                    <input type="text" class="form-control" name="search_text" id="search_text" placeholder="Saisissez des termes à rechercher séparés par des espaces">
                    <span class="input-group-btn">
           <button class="btn btn-primary" id="subsearch" type="button"><span class="glyphicon glyphicon-search"></span> Recherche</button>
                    </span>
                </div>
			<br />
			<div id="result" style="background-color: #ffffff;padding-top: 5px;padding-left: 5px;padding-right: 5px;"></div>
		</div>
		<div style="clear:both"></div>
		<br />
		
		<br />
		<br />
		<br />
	</body>
</html>


<script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"fetch.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}
    $('#search_text').keyup(function(e) {
        if (e.keyCode == 13) {
            var search = $('#search_text').val();
            if(search != '')
            {
                load_data(search);
            }
            else
            {
                load_data();
            }
        }
    });
	$('#subsearch').click(function(){
		var search = $('#search_text').val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
});
</script>




