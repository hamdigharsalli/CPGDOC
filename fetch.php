<?php
require_once 'dbconnect.php';
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
    $search = trim($search);
                             $condition = '';  
                          $query = explode(" ", $search);  
                          foreach($query as $text)  
                          {  
                               $condition .= "CONCAT(n_boite, ' ', intitule, ' ', direction, '', division, '', service, '', date_debut, '', date_fin, '', ecriture, '', remarque) LIKE '%".mysqli_real_escape_string($conn, $text)."%' AND ";
                          }  
                          $condition = substr($condition, 0, -4);  
                          $sql_query = "SELECT * FROM documents WHERE " . $condition;
}
else
{

	$sql_query = "
	SELECT * FROM documents ORDER BY id_docs LIMIT 10";
}
$result = mysqli_query($conn, $sql_query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table id="example" class="" style="width:100%">
					<thead>	
                  <tr>
							<th>N° boite</th>
							<th>Intitulé</th>
							<th>Direction</th>
							<th>Division</th>
							<th>Service</th>
							<th>Date début</th>
							<th>Date fin</th>
							<th>Écriture</th>
							<th>Remarque</th>
						</tr>
                  </thead>
              <tbody>';
if(isset($_POST["query"])) {

    $search = mysqli_real_escape_string($conn, $_POST["query"]);
    $search = trim($search);
    while($row = mysqli_fetch_array($result))
    {       // put in bold the written text
        $querys = explode(" ", $search);
        $boite=$row["n_boite"];
        $intitule=$row["intitule"];
        $direction=$row["direction"];
        $division=$row["division"];
        $service=$row["service"];
        $date_debut=$row["date_debut"];
        $date_fin=$row["date_fin"];
        $ecriture=$row["ecriture"];
        $remarque=$row["remarque"];
        foreach($querys as $text)
        {
            $boite = preg_replace('#'.$text.'#i', '<b>'.$text.'</b>', $boite);
            $intitule = preg_replace('#'.$text.'#i', '<b>'.$text.'</b>', $intitule);
            $direction = preg_replace('#'.$text.'#i', '<b>'.$text.'</b>', $direction);
            $division = preg_replace('#'.$text.'#i', '<b>'.$text.'</b>', $division);
            $service = preg_replace('#'.$text.'#i', '<b>'.$text.'</b>', $service);
            $date_debut = preg_replace('#'.$text.'#i', '<b>'.$text.'</b>', $date_debut);
            $date_fin = preg_replace('#'.$text.'#i', '<b>'.$text.'</b>', $date_fin);
            $ecriture = preg_replace('#'.$text.'#i', '<b>'.$text.'</b>', $ecriture);
            $remarque = preg_replace

            ('#'.$text.'#i', '<b>'.$text.'</b>', $remarque);
        }
        $output .= '
			<tr>
				<td>'.$boite.'</td>
				<td>'.$intitule.'</td>
				<td>'.$direction.'</td>
				<td>'.$division.'</td>
				<td>'.$service.'</td>
				<td>'.$date_debut.'</td>
				<td>'.$date_fin.'</td>
				<td>'.$ecriture.'</td>
				<td>'.$remarque.'</td>
			</tr>
		';
    }
}
else
{
    while($row = mysqli_fetch_array($result))
    {
        $output .= '
			<tr>
				<td>'.$row['n_boite'].'</td>
				<td>'.$row["intitule"].'</td>
				<td>'.$row["direction"].'</td>
				<td>'.$row["division"].'</td>
				<td>'.$row["service"].'</td>
				<td>'.$row["date_debut"].'</td>
				<td>'.$row["date_fin"].'</td>
				<td>'.$row["ecriture"].'</td>
				<td>'.$row["remarque"].'</td>
			</tr>
		';
    }
}

  $output .= '</tbody>';
	echo $output;
}
else
{
	echo 'Données non trouvées';
}
?>
<script>
$(document).ready(function() {
    $('#example').DataTable(
        {

            "order": [[ 0, "asc" ]],
            "language": {
                "url": "js/French.json"
            },
            dom: 'Bfrtip',
            buttons: [

                'excelHtml5',

            ],
        }
    );
} );
</script>