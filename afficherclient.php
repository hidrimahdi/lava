<?php
    include "../Controller/clientC.php";


session_start();

    $clientC =  new clientC();
    $liste=$clientC->afficherclient();

	// Pourcentage
	
	$Sexe1="Homme";
	$Sexe2="Femme";
	$nsexe1=$clientC->calculerClient($Sexe1);   
	$nsexe2=$clientC->calculerClient($Sexe2);

  $denominator = $nsexe1 + $nsexe2;

  // Check if the denominator is not zero before performing the division
  if ($denominator != 0) {
      $stathomme = ($nsexe1 * 100) / $denominator;
      $statfemme = ($nsexe2 * 100) / $denominator;
  } else {
      // Handle the case where division by zero is not allowed
      // You can set default values or show an error message
      $stathomme = 0;
      $statfemme = 0;
      echo "Cannot divide by zero";
  }
	

// Rechercher
	if (isset($_POST["Search"]))
{ 
  if($_POST["choix"]=='id')
{$clientC=new clientC();
$liste=$clientC->recupId($_POST["Search"]);
}
if($_POST["choix"]=='Nom')
{$clientC=new clientC();
$liste=$clientC->recupNom($_POST["Search"]);
}
if($_POST["choix"]=='NumTel')
{$clientC=new clientC();
$liste=$clientC->recupNum_Tel($_POST["Search"]);
}

if($_POST["choix"]=='Prenom')
{$clientC=new clientC();
$liste=$clientC->recupPrenom($_POST["Search"]);
}

if($_POST["choix"]=='Sexe')
{$clientC=new clientC();
$liste=$clientC->recupSexe($_POST["Search"]);
}

if($_POST["choix"]=='Mail')
{$clientC=new clientC();
$liste=$clientC->recupMail($_POST["Search"]);
}

if($_POST["choix"]=='Adresse')
{$clientC=new clientC();
$liste=$clientC->recupAdresse($_POST["Search"]);
}

//tri

}


?>
    


    <html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">

	<link rel="shortcut icon" href="../img/icons/icon-48x48.png" />
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>


	<title>Tables | AdminKit Demo</title>

	<link href="css/app.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
    <nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
          <span class="align-middle">virtuart Admin</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						
					</li>


					<li class="sidebar-item ">
						<a class="sidebar-link" href="ajouteradmine.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle"> Gestion Admins </span>
            </a>

			<li class="sidebar-item active" >
						<a href="#ui1" data-toggle="collapse" class="sidebar-link">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle"> Gestion des clients</span>
            </a>
            <ul id="ui1" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item active"><a class="sidebar-link" href="afficherclient.php">La liste des Clients : </a></li>
							<li class="sidebar-item "><a class="sidebar-link" href="ajouterclient.php">Ajouter des clients</a></li>
						</ul>

					</li>

					
					
					<li class="sidebar-item ">
					<ul id="ui5" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">

					<li class="sidebar-item  "><a class="sidebar-link " href="stat.php"> statistique </a></li>

				</ul>

          

					

				
			</div>
		</nav>


		
		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>

				

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
								
						
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-toggle="dropdown">
								
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row no-gutters align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
											</div>
											
										</div>
									</a>
									
									</a>
									<a href="#" class="list-group-item">
										<div class="row no-gutters align-items-center">
											
											
										</div>
									</a>
									
								</div>
								<div class="dropdown-menu-footer">
									
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

<!-- image et mail efface  -->
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="deconnexion.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
</nav>






<main class="content">
                <div class="container-fluid p-0">
                <div class="text-center">
				<h1 class="h3 mb-3" align ="left" >Rechercher</h1>
				<br>
                            <form method="POST">
                            <div class="col-12 col-md-3"><select class="form-control"  placeholder="Choix" name="choix" id="choix" ></div>
			  <option>Choisir :</option>
			  <option>id</option>
              <option>Nom</option>
              <option>Prenom</option>
			  <option>Sexe</option>
			  <option>Mail</option>
			  <option>NumTel</option>
			  <option>Adresse</option>
              
			</select>
<input type="text"  name="Search" name="Search" class="form-control" placeholder="Ecrire Ici">
<br>

<button class="btn btn-primary">Rechercher</button>
<button onclick="window.print()" class="btn btn-primary">Print</button>
<br><br>
<form name="f1"  method="POST" action="pdf2.php" onSubmit="return verif()" >
        <center>
        <td><button type="submit" name="Imprimer" value="Imprimer" class="btn btn-danger">Imprimer</button></td>
      </center>
    </form>

</div>

<br>
	
     
</form>	
<h1 class="h3 mb-3">La liste liste des Clients : </h1>

<br><br>

<div class="row">
	<div class="col-12 col-xl-15">
		<div class="card">
			
		<table class="table table-bordered" id="myTable">
<tr>
            <th style="width:10%;" onclick="sortTable(0)">id<span class="sort-symbol"></span></th>
            <th style="width:10%" onclick="sortTable(1)">Nom<span class="sort-symbol"></span></th>
            <th style="width:10%" onclick="sortTable(2)">Prenom<span class="sort-symbol"></span></th>
						<th style="width:10%;" onclick="sortTable(3)">Sexe<span class="sort-symbol"></span></th>
						<th style="width:10%" onclick="sortTable(4)" >mail<span class="sort-symbol"></span></th>
						<th style="width:10%" onclick="sortTable(5)" >num_tel<span class="sort-symbol"></span></th>
						
						<th style="width:10%" onclick="sortTable(6)">Adresse<span class="sort-symbol"></span></th>
	<th class="d-none d-md-table-cell" style="width:10%" onclick="sortTable(7)">Date de naissance<span class="sort-symbol"></span></th>
					
						<th style="width:10%" >Actions</th>

</tr>

<?PHP
foreach($liste as $clientC){
?>
<tr>
<td><?PHP echo $clientC['id']; ?></td>
<td><?PHP echo $clientC['Nom']; ?></td>
<td><?PHP echo $clientC['Prenom']; ?></td>
<td><?PHP echo $clientC['Sexe']; ?></td>
<td><?PHP echo $clientC['mail']; ?></td>
<td><?PHP echo $clientC['num_tel']; ?></td>
<td><?PHP echo $clientC['adresse']; ?></td>
<td><?PHP echo $clientC['date_anniversaire']; ?></td>
<td class="table-action">
<a href="ajouterclient.php"><i class="align-middle" data-feather="user-plus"></i></a>
<a href="modifierclient.php?id=<?= $clientC['id'] ?>"><i class="align-middle" data-feather="edit-2"></i></a>							
<a href="supp-client.php?id=<?= $clientC['id'] ?>"><i class="align-middle" data-feather="trash"></i></a>


                        </td>
    
</tr>

<?PHP
}
?>
</table>
        </div>
    </div>

<!-- Pourcentage -->

<div class="col-12 col-lg-6">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Statistiques du Sexe des Clients :</h5>
        </div>
        <div class="card-body">
            <div class="chart chart-sm">
                <canvas id="chartjs-doughnut"></canvas>
            </div>
            <div class="row" align ="left">
                <div class="col-12">
                    Homme: <?php echo round($stathomme, 2); ?>%
                </div>
                <div class="col-12">
                    Femme: <?php echo round($statfemme, 2); ?>%
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pourcentage -->

    
    
                        
</main>


</div>
</div>

<script src="js/vendor.js"></script>
<script src="js/app.js"></script>
<!-- Pourcentage  -->

<script>
		$(function() {
			// Doughnut chart
			new Chart(document.getElementById("chartjs-doughnut"), {
				type: "doughnut",
				data: {
					labels: ["Femme", "Homme"],
					datasets: [{
						data: [<?php echo $nsexe2;?> , <?php echo $nsexe1; ?>],
						backgroundColor: [
							window.theme.warning,
						],
						borderColor: "transparent"
					}]
				},
				options: {
					maintainAspectRatio: false,
					cutoutPercentage: 70,
					legend: {
						display: true
                        
					}
                    
				}
			});
		});
	</script>

<!-- pdf  -->


<script>
function exportTableToPDF() {
  var doc = new jsPDF();
  var table = document.getElementById("myTable");
  var rows = table.rows;

  // Add title to the PDF document
  doc.setFontSize(25);
  doc.setTextColor(0, 0, 0);
  doc.setTextColor(0, 100, 0); // Vert foncé
  
  doc.text("La liste des clients :", doc.internal.pageSize.width / 30, 20, { align: "center" });
  doc.setFontSize(12);
  // Add table to the PDF document
  var col = [];
  var data = [];
  for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].cells;
    var temp = [];
    for (var j = 0; j < cells.length -4 ; j++) {
      if (i === 0) {
        // Store the table column headers
        col.push(cells[j].textContent);
      }
      temp.push(cells[j].textContent);
    }
    data.push(temp);
  }

  // Draw table
  var tableTop = 50;
  var tableLeft = 0;
  var cellWidth = 35;
  var cellHeight = 7;
  var lineHeight = 12;
  var startY = tableTop + cellHeight;
  for (var i = 1; i < data.length; i++) {
    var row = data[i];
    for (var j = 0; j < row.length; j++) {
      var cellText = row[j];
      doc.setFillColor(255, 255, 255); // Blanc
      doc.rect(tableLeft + j * cellWidth, startY + (i-1) * lineHeight, cellWidth, cellHeight, "F");
      doc.setTextColor(0, 0, 0); // Noir
      doc.text(cellText, tableLeft + j * cellWidth + 1, startY + (i-1) * lineHeight + 5);
    }
  }
  
  // Draw column headers
  doc.setFillColor(144, 238, 144); // Vert clair
  doc.rect(tableLeft, startY - cellHeight, table.clientWidth, cellHeight, "F");
  doc.setTextColor(255, 255, 255); // Blanc
  for (var j = 0; j < col.length; j++) {
    doc.text(col[j], tableLeft + j * cellWidth + 1, startY - 2 );
  }

  doc.save("table.pdf");
}

</script>


<!-- trier le tableau -->


<script>
 
 function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];

      var xValue = getValue(x.innerHTML, n);
      var yValue = getValue(y.innerHTML, n);

      if (dir === "asc") {
        if (xValue > yValue) {
          shouldSwitch = true;
          break;
        }
      } else if (dir === "desc") {
        if (xValue < yValue) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount++;
    } else {
      if (switchcount === 0 && dir === "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }

  // Remove the sorting class from all columns
  var headers = table.getElementsByTagName("TH");
  for (var i = 0; i < headers.length; i++) {
    headers[i].classList.remove("asc", "desc");
  }

  // Add the sorting class to the current column header
  var currentHeader = headers[n];
  currentHeader.classList.add(dir);

  // Update the symbol next to the column header
  var symbols = table.getElementsByClassName("sort-symbol");
  for (var i = 0; i < symbols.length; i++) {
    symbols[i].innerHTML = "";
  }
  var symbol = dir === "asc" ? "&#9650;" : "&#9660;";
  currentHeader.getElementsByClassName("sort-symbol")[0].innerHTML = symbol;
}

function getValue(value, columnIndex) {
  if (columnIndex === 0 || columnIndex === 5) {
    return parseInt(value);
  } else if (columnIndex === 7) {
    // Invert the date value for sorting
    var date = new Date(value);
    return -date.getTime();
  } else {
    return value.toLowerCase();
  }
}


</script>




<!-- Fin du tri  -->

<style>
  .sort-symbol {
    margin-left: 5px;
  }

  .asc .sort-symbol:after {
    content: "\25B2";
  }

  .desc .sort-symbol:after {
    content: "\25BC";
  }
</style>




</body>

</html>