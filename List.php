<?php
	
	include 'php/connectdata.php';
	
	$Category = 1;

	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$Category = $_POST['Category'];
	}
	$Res = mysqli_query($dblink, "SELECT * FROM categories_of_items where idCOI = '".$Category."'");
	
	$CategoryQ = mysqli_fetch_assoc($Res);

	$CatTitle = $CategoryQ['CatTitle'];
	$CatLogo = $CategoryQ['CatIcon'];
	$Request = $CategoryQ['Request'];
	$UpLeft = $CategoryQ['UpLeftInfo'];
	$UpRight = $CategoryQ['UpRightInfo'];

	$Filters = array();
	if (isset($_POST['ByDeveloper']) & $_POST['ByDeveloper'] != "0")
	{
		array_push($Filters, "idVRDevs = ".$_POST['ByDeveloper']);
	}
	if (strlen($_POST['PFrom'])) {
		array_push($Filters, "Price > ".$_POST['PFrom']);
	}
	if (strlen($_POST['PTo'])) {
		array_push($Filters, "Price < ".$_POST['PTo']);
	}
	if ((isset($_POST['ByName']) & strlen($_POST['ByName']) > 0))
	{
		array_push($Filters, "Name LIKE '%".$_POST['ByName']."%'");
	}
	

	if (count($Filters) > 0)
	{
		$Request .= " where ";
		foreach ($Filters as $key => $value) {
			$Request .= $value." and ";
		}
		$Request = substr($Request, 0, strlen($Request)-4);
	}
	include 'php/checklogged.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Shop List</title>
	<link rel="stylesheet" type="text/css" href="css/styles-list.css">
	<link rel="stylesheet" type="text/css" href="css/styles-btn.css">
	<link rel="stylesheet" type="text/css" href="css/styles-bases.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<?php include "html/header.html"; ?>

	<div class="Block-1-L container-fluid row m-0 p-0 d-flex justify-content-center">
		
		<div class="Main col-md-8 d-flex flex-column justify-content-center align-items-start">
			<div class="Title relative d-flex justify-content-between">
				<div class="List-Name d-flex justify-content-between align-items-center">
					<?php
						echo '<img class="cat-logo" src="'.$CatLogo.'" alt="">';
						echo '<p class="cat-title">';
					
							echo $CatTitle;
						?>
					</p>
				</div>
				<div class="Site-Name d-flex align-items-center">
					<p>
						VR-STORE
					</p>
				</div>
			</div>
			<div class="Upper-Panel relative d-flex justify-content-center align-items-center">
				<div class="Buttons d-flex justify-content-end align-items-center">
				    <label>Sort by:</label>
				    <div class="Sort-Item" id="DivSortName">
				    	<label for="SortName">Name</label>
				    	<input type="radio" id="SortName" name="Sort" onclick="Sort('Name')">
				    </div>
				    <div class="Sort-Item" id="DivSortBtl">
				    	<label for="SortBtl">Price (Big to Low)</label>
				    	<input type="radio" id="SortBtl" name="Sort" onclick="Sort('BtL')">
				    </div>
				    <div class="Sort-Item" id="DivSortLtb">
				    	<label for="SortLtb">Price (Low to Big)</label>
				    	<input type="radio" id="SortLtb" name="Sort" onclick="Sort('LtB')">
				    </div>
				</div>
			</div>
		</div>	
	</div>
	<div class="Block-2-L container-fluid row m-0 p-0">
		<div class="Right-Panel col-md-2">
			<div class="Categories">
				<form action="List.php" method="post">

					<?php echo '<input type="hidden" value="'.$Category.'" name="Category">' ?>
					<div class="Sorting">
						
					</div>


					<div class="By-Name">
						<input type="text" placeholder="Name" name="ByName">
					</div>
					<div class="By-Price d-flex">
						<input name="PFrom" class="Price-Box" type="number" placeholder="From">
						<input name="PTo" class="Price-Box" type="number" placeholder="To">
					</div>

					<!-- <div class="Game-Categories">
						<div class="Cat d-flex align-items-center justify-content-between">
							<input type="checkbox">
							<p class="Cat-name">Cat</p>							
						</div>
						<div class="Cat d-flex align-items-center justify-content-between">
							<input type="checkbox">
							<p class="Cat-name">Cat</p>							
						</div>
						<div class="Cat d-flex align-items-center justify-content-between">
							<input type="checkbox">
							<p class="Cat-name">Cat</p>							
						</div>
						<div class="Cat d-flex align-items-center justify-content-between">
							<input type="checkbox">
							<p class="Cat-name">Cat</p>							
						</div>
						<div class="Cat d-flex align-items-center justify-content-between">
							<input type="checkbox">
							<p class="Cat-name">Cat</p>							
						</div>
						<div class="Cat d-flex align-items-center justify-content-between">
							<input type="checkbox">
							<p class="Cat-name">Cat</p>							
						</div>
						<div class="Cat d-flex align-items-center justify-content-between">
							<input id="cat" type="checkbox">
							<label for="cat">Cat</label>						
						</div>

					</div>	 -->

					<select required="false" name="ByDeveloper">
						<option value="0">Select dev</option>
						<?php
							$ListQ = mysqli_query($dblink, "Select idVRDevs,Name from vrdevs");

							while ($ResArr = mysqli_fetch_array($ListQ))
							{
								echo '<option value="'.$ResArr['idVRDevs'].'">'.$ResArr['Name'].'</option>';
							}
						?>
					</select>
					<input type="submit" value="Filter">
				</form>
				
			</div>
		</div>
		<div class="Main col-md-8">
			<div id="ItemsList" class="List d-flex flex-column justify-content-start align-items-center">
				<?php

					$ListQuery = mysqli_query($dblink, $Request);	
					// echo '<input type="hidden" value="'.$Request.'">';
					if (mysqli_num_rows($ListQuery) > 0)
					{
						while ($ResArr = mysqli_fetch_array($ListQuery))
						{

							echo '<a href = "Item.php?Category='.$Category.'&idItem='.$ResArr['idItem'].'"> <div class="Item d-flex">
						<div class="Image-Box relative">
							<img src="';
							echo $ResArr['Cover'];
							echo '" alt="">';
							echo '</div>
						<div class="Info-Box d-flex flex-column justify-content-between">
							<div class="Upper d-flex justify-content-between">
								<div class="Title-GT">
									<div name="NameData" class="Title">
										<p>';
							echo $ResArr['Name'];
							echo '</p>
							</div>';
							echo $UpLeft;
								// echo '<div class="Game-Type">';
								// echo $ResArr[''];
								// echo '</div>';	
							echo $UpRight;
							// echo '</div>
							// 	<div class="Dev-Pub d-flex flex-column justify-content-between">
							// 		<div class="Dev d-flex justify-content-between">
							// 			<p>Developer:</p>
							// 			<div class="Dev-Info">';
							
							// echo $ResArr['Developer'];
							// echo '</div>
							// 	</div>';
							// 	echo '<div class="Pub d-flex justify-content-between">
							// 			<p>Publisher:</p>
							// 			<div class="Dev-Info">';
							// echo $ResArr['Publisher'];
							// echo '</div>
							// 		</div>';
										
							echo '</div>
							</div>
							<div class="Middle d-flex justify-content-between">'.$ResArr['Description'].'
							</div>
							<div class="Down d-flex justify-content-between">
								<div class="d-flex flex-column justify-content-between">
									<div class="Date"><p>';
								echo date('j F Y',strtotime($ResArr['ReleaseDate']));
							echo '</p></div>
								<div class="Count">';
								if ($ResArr['Count'] > 0) 
								{
									echo '<font color = "#a1f720">Есть в наличии!</font>';
								}
								else
								{
									echo '<font color = "#f73520">Нет в наличии.</font>';
								}
								echo '</div>';
								
								echo '</div>
								<div class="Price d-flex justify-content-between">
									<p name="PriceData" class="Cur-Price">
										'.$ResArr['Price'].'$
									</p>
								</div>
						</div>
					</div>
				</div>
				</a>';

						}

					}
						
				?>


				<!-- <div class="Item d-flex">
					<div class="Image-Box relative">
						<img src="" alt="">
					</div>
					<div class="Info-Box d-flex flex-column justify-content-between">
						<div class="Upper d-flex justify-content-between">
							<div class="Title-GT">
								<div class="Title">
							
								</div>
								<div class="Game-Type">
								
								</div>
							</div>
							<div class="Dev-Pub d-flex flex-column justify-content-between">
								<div class="Dev d-flex justify-content-between">
									<p>Developer:</p>
									<div class="Dev-Info">
									
									</div>
								</div>
								<div class="Pub d-flex justify-content-between">
									<p>Publisher:</p>
									<div class="Dev-Info">
									
									</div>
								</div>
							</div>
						</div>
						<div class="Middle d-flex justify-content-between">
											
						</div>
						<div class="Down d-flex justify-content-between">
							<div class="Date">
							
							</div>
							<div class="Right-Side d-flex justify-content-end">
								<div class="Price d-flex justify-content-between">
									<p class="Cur-Price">
										
									</p>
									
								</div>
								<form action="" method="post" class="Button-Container d-flex ml-3 justify-content-end align-items-end">
										
										
										<input type="hidden" value="#############" name="Category">
										<input type="hidden" value="#########" name="itemId">
										<div class="Button-List">
											<input type="submit" class="Button-Base-a Button-List no-scaling d-flex p-0 m-0 d-flex justify-content-center" value="To page">
										</div>
								</form>	
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>	
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/sort.js"></script>
</body>
</html>