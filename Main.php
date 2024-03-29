<?php
	$server = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'mydb';

	$dblink = mysqli_connect($server, $user, $password, $database);
	if(!$dblink)
	{
		die('Ошибка подключения к серверу баз данных.');
	}

	include 'php/checklogged.php';

	// $logged = false;

	// if ($_SERVER['REQUEST_METHOD'] == "POST")
	// {
	// 	if (isset($_POST['signout']))
	// 	{
	// 		setcookie("id", "", time() - 3600*24*30*12, "/");
	// 	    setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
	// 	    header("Location: Main.php"); 
	// 	        exit;
	// 	}
	// }
	// if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
	// {
	// 	$query = mysqli_query($dblink, "SELECT * FROM users WHERE idUser = '".intval($_COOKIE['id'])."' LIMIT 1");
	// 	$userdata = mysqli_fetch_assoc($query);
	// 	$logged = true;
	// 	if(($userdata['password'] !== $_COOKIE['hash']) or ($userdata['idUser'] !== $_COOKIE['id']))
	// 	{
	// 		setcookie("id", "", time() - 3600*24*30*12, "/");
	// 	    setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
	// 	}
	// }	 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Main</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">	
	<link rel="stylesheet" type="text/css" href="css/styles-btn.css">	
	<link rel="stylesheet" type="text/css" href="css/styles-bases.css">	
	<link rel="stylesheet" href="css/owl/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl/owl.theme.default.min.css">
</head>
<body>
	<?php include "html/header.html"; ?>
	<div class="Block-1 container-fluid p-0 m-0 row">
		<div class="Account-Panel col-md-2 p-0">
				<!-- <div class="Account-Image col-12 p-0">
					<div class="Name">
							
					</div>

				</div>
				<div class="Money col-md-12">
					
				</div>
				<div class="Search-Panel col-md-12">
						
				</div> -->
		</div>
		<div class="container-md col-md-8 p-0">
			<div class="Main">
				<div class="owl-carousel owl-theme owl-loaded m-0 p-0 relative">
					<div class="owl-stage-outer">
						<div class="owl-stage">
							<?php
								$NewsQ = mysqli_query($dblink, "SELECT * FROM `first-page`");	
								while ($ResArr = mysqli_fetch_array($NewsQ))
								{
									echo '<div class="owl-item">
				            	<div class="item">
				            		<div class="Upper-Box relative">
				            			<img src="'.$ResArr["Img1"].'">
				            		</div>
				            		<div class="Down-Box relative">
				            			<div class="Gif-Box relative">
				            				<img src="'.$ResArr["Img2"].'">
				            			</div>
				            			
				            			<div class="Info-Block absolute">
				            				<div class="Content d-flex flex-column justify-content-around align-items-center">
				            					<div class="Title d-flex justify-content-center p-1">
				            						<p class="m-0">'.$ResArr["Title"].'</p>	
				            					</div>
				            					<div class="Text d-flex justify-content-center p-2">
				            						<p class="m-0">'.$ResArr["Desc"].'</p>
				            					</div>
				            					<div class="Button-Container d-flex justify-content-center align-items-center">
				            						<div class="Button-Base-B1">
														<a href="Item.php?Category='.$ResArr['ItemCat'].'&idItem='.$ResArr['idItem'].'" class="Button-Base-a relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
															<p class="Button-Base-p m-0">READ MORE</p>
														</a>
													</div>
				            					</div>
				            				</div>
				            			</div>
				            		</div>
				            	</div>
				            </div>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="Block-2 row container-fluid d-flex justify-content-center p-0 m-0">
		<div class="Content col-md-8 p-0 m-0 d-flex">
				<div class="Left-Block col-md-3 p-0 m-0">
					<div class="Categories d-flex flex-wrap relative">
						<?php
							$NewsQ = mysqli_query($dblink, "SELECT * FROM `categoriesofgames`");	
							while ($ResArr = mysqli_fetch_array($NewsQ))
							{
								echo '<div class="Category-Item d-flex justify-content-center align-items-center col-md-6 p-0 m-0">
							<div class="Category-Content d-flex flex-column align-items-center
							justify-content-center">
								<div class="Icon-Box d-flex justify-content-center align-items-center">
									<img src="icons/multiplayer-gray.svg" class="Icon-Image-Gray">
								</div>
								<div class="Icon-Box d-flex justify-content-center align-items-center">
									<img src="';
								echo $ResArr["Icon"];
								echo '" class="Icon-Image-White">
								</div>
								<div class="Filling">
									
								</div>

								<p class="Icon-Title">';
								echo $ResArr["Name"];
								echo '</p>	
							</div>	
						</div>';
							}
						?>
						
						
					</div>
					<div class="GoToList">
						<div class="Button-Base-B2">
							<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
								<p class="Button-Base-p m-0">READ MORE</p>
							</a>
						</div>
					</div>
						
				</div>
				<div class="Right-Block col-md-9 p-0 m-0">
					<div id="Games" class="Content d-flex flex-wrap">
						<div class="Game-Box">
							<div class="More-Info">
								<div class="Gif-Box">
									<img src="img/games/hl-alyx-gif.gif">
								</div>
								<div class="Buttons-Box d-flex justify-content-around align-items-center">
									<div class="Button-Base-B6 Buy ">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">5$</p>
											<img class="Buy-Button" src="icons/cart.svg">
										</a>
									</div>
									<div class="Button-Base-B7">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">READ MORE</p>
										</a>
									</div>
								</div>
							</div>
							<div class="overlay">
								<div class="pic">
									<img src="img/games/hl-alyx-static.jpg" alt="Avatar" class="image">
								</div>
							</div>
						</div>
						<div class="Game-Box">
							<div class="More-Info">
								<div class="Gif-Box">
									<img src="img/games/hl-alyx-gif.gif">
								</div>
								<div class="Buttons-Box d-flex justify-content-around align-items-center">
									<div class="Button-Base-B6 Buy ">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">5$</p>
											<img class="Buy-Button" src="icons/cart.svg">
										</a>
									</div>
									<div class="Button-Base-B7">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">READ MORE</p>
										</a>
									</div>
								</div>
							</div>
							<div class="overlay">
								<div class="pic">
									<img src="img/games/hl-alyx-static.jpg" alt="Avatar" class="image">
								</div>
							</div>
						</div>
						<div class="Game-Box">
							<div class="More-Info">
								<div class="Gif-Box">
									<img src="img/games/hl-alyx-gif.gif">
								</div>
								<div class="Buttons-Box d-flex justify-content-around align-items-center">
									<div class="Button-Base-B6 Buy ">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">5$</p>
											<img class="Buy-Button" src="icons/cart.svg">
										</a>
									</div>
									<div class="Button-Base-B7">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">READ MORE</p>
										</a>
									</div>
								</div>
							</div>
							<div class="overlay">
								<div class="pic">
									<img src="img/games/hl-alyx-static.jpg" alt="Avatar" class="image">
								</div>
							</div>
						</div>
						<div class="Game-Box">
							<div class="More-Info">
								<div class="Gif-Box">
									<img src="img/games/hl-alyx-gif.gif">
								</div>
								<div class="Buttons-Box d-flex justify-content-around align-items-center">
									<div class="Button-Base-B6 Buy ">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">5$</p>
											<img class="Buy-Button" src="icons/cart.svg">
										</a>
									</div>
									<div class="Button-Base-B7">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">READ MORE</p>
										</a>
									</div>
								</div>
							</div>
							<div class="overlay">
								<div class="pic">
									<img src="img/games/hl-alyx-static.jpg" alt="Avatar" class="image">
								</div>
							</div>
						</div>
						<div class="Game-Box">
							<div class="More-Info">
								<div class="Gif-Box">
									<img src="img/games/hl-alyx-gif.gif">
								</div>
								<div class="Buttons-Box d-flex justify-content-around align-items-center">
									<div class="Button-Base-B6 Buy ">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">5$</p>
											<img class="Buy-Button" src="icons/cart.svg">
										</a>
									</div>
									<div class="Button-Base-B7">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">READ MORE</p>
										</a>
									</div>
								</div>
							</div>
							<div class="overlay">
								<div class="pic">
									<img src="img/games/hl-alyx-static.jpg" alt="Avatar" class="image">
								</div>
							</div>
						</div>
						<div class="Game-Box">
							<div class="More-Info">
								<div class="Gif-Box">
									<img src="img/games/hl-alyx-gif.gif">
								</div>
								<div class="Buttons-Box d-flex justify-content-around align-items-center">
									<div class="Button-Base-B6 Buy ">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">5$</p>
											<img class="Buy-Button" src="icons/cart.svg">
										</a>
									</div>
									<div class="Button-Base-B7">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">READ MORE</p>
										</a>
									</div>
								</div>
							</div>
							<div class="overlay">
								<div class="pic">
									<img src="img/games/hl-alyx-static.jpg" alt="Avatar" class="image">
								</div>
							</div>
						</div>
						<div class="Game-Box">
							<div class="More-Info">
								<div class="Gif-Box">
									<img src="img/games/hl-alyx-gif.gif">
								</div>
								<div class="Buttons-Box d-flex justify-content-around align-items-center">
									<div class="Button-Base-B6 Buy ">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">5$</p>
											<img class="Buy-Button" src="icons/cart.svg">
										</a>
									</div>
									<div class="Button-Base-B7">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">READ MORE</p>
										</a>
									</div>
								</div>
							</div>
							<div class="overlay">
								<div class="pic">
									<img src="img/games/hl-alyx-static.jpg" alt="Avatar" class="image">
								</div>
							</div>
						</div>
						<div class="Game-Box">
							<div class="More-Info">
								<div class="Gif-Box">
									<img src="img/games/hl-alyx-gif.gif">
								</div>
								<div class="Buttons-Box d-flex justify-content-around align-items-center">
									<div class="Button-Base-B6 Buy ">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">5$</p>
											<img class="Buy-Button" src="icons/cart.svg">
										</a>
									</div>
									<div class="Button-Base-B7">
										<a href="#" class="Button-Base-a no-scaling no-border relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
											<p class="Button-Base-p m-0">READ MORE</p>
										</a>
									</div>
								</div>
							</div>
							<div class="overlay">
								<div class="pic">
									<img src="img/games/hl-alyx-static.jpg" alt="Avatar" class="image">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
	</div>

	<div class="Block-3 row container-fluid d-flex justify-content-center p-0 m-0">
		<div class="Content col-md-8 p-1 m-0 d-flex flex-column justify-content-between align-items-center">
			<div class="Text-Box-2 mt-2">
				<p class="m-0">VR FULL KITS</p>
			</div>
			<div class="Kits d-flex justify-content-between">
				
				<?php
					$NewsQ = mysqli_query($dblink, "SELECT * FROM `vrkits`");	
					while ($ResArr = mysqli_fetch_array($NewsQ))
					{
						echo '<div class="Kit-Box col-md-4 d-flex flex-column justify-content-between">
								<div class="Image-Box">
									<img src="';
						echo $ResArr['Cover'];
						echo '">
								</div>
								<div class="Info-Box d-flex flex-column justify-content-between align-items-center">
									<div class="Short-Info p-1">
										<p class="pr-3">';
						echo substr($ResArr['Description'],0,290)."...";
						echo '</p>
						</div>
						<div class="Price-And-Button d-flex justify-content-between align-items-center">
							<div class="Price d-flex justify-content-center align-items-center">
								<p class="m-1">';
						echo $ResArr['Price'];
						echo '$</p>
							</div>
							<div class="Button">
								<div class="Button-Base-B4">
									<a href="Item.php?Category=1&idItem='.$ResArr['idItem'].'" class="Button-Base-a no-border no-border-right no-scaling relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
										<p class="Button-Base-p m-0">READ MORE</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>';
						}
				?>



				<!-- <div class="Kit-Box col-md-4 d-flex flex-column justify-content-between">
					<div class="Image-Box">
						<img src="img/main.jpg">
					</div>
					<div class="Info-Box d-flex flex-column justify-content-between align-items-center">
						<div class="Short-Info p-2">
							<p class="m-1">Valve Index is a virtual reality headset created and manufactured by Valve. The headset is intended to be used with the Valve Index Controllers, known during development as the Knuckles Controllers, but is also backwards compatible with the HTC Vive and HTC Vive Pro controllers.</p>
						</div>
						<div class="Price-And-Button d-flex justify-content-between align-items-center">
							<div class="Price d-flex justify-content-center align-items-center">
								<p class="m-1">151$</p>
							</div>
							<div class="Button">
								<div class="Button-Base-B4">
									<a href="#" class="Button-Base-a no-border no-border-right no-scaling relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
										<p class="Button-Base-p m-0">READ MORE</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div> -->
			</div>
			<div class="Button-Container d-flex justify-content-center align-items-center">
				<form action="List.php" method="post" class="Button-Base-B3">
					<input type="hidden" value="1" name="Category">
					<input type="submit" class="Button-Base-a relative d-flex justify-content-center align-items-center p-0 m-0 input-text" value="TO KITS LIST">
				</form>
			</div>
		</div>
	</div>

	<div class="Block-4 container-fluid d-flex justify-content-center p-0 m-0">
		<div class="Content col-md-8 p-5 m-0 d-flex flex-column justify-content-around align-items-center">
			<div class="Text-Box-2">
				<p>ADDITIONAL COMPONENTS</p>
			</div>
			<div class="Buttons-Container d-flex justify-content-center p-0 m-0">
				<div class="Button-Container-2 col-md-4 d-flex justify-content-center align-items-center">
					<div class="Button-Base-B5">
						<a href="#" class="Button-Base-a relative d-flex justify-content-center align-items-center p-0 m-0">
							<img src="icons/vr.svg">
							<div class="Info-Box-Components d-flex justify-content-center align-items-center">
								<p>VR HEADSETS</p>
							</div>
						</a>
					</div>
				</div>
				<div class="Button-Container-2 col-md-4 d-flex justify-content-center align-items-center">
					<div class="Button-Base-B5">
						<a href="#" class="Button-Base-a relative d-flex justify-content-center align-items-center p-0 m-0">
							<img src="icons/joystick.svg">
							<div class="Info-Box-Components d-flex justify-content-center align-items-center">
								<p>CONTROLLERS</p>
							</div>
						</a>
					</div>
				</div>
				<div class="Button-Container-2 col-md-4 d-flex justify-content-center align-items-center">
					<div class="Button-Base-B5">
						<a href="#" class="Button-Base-a relative d-flex justify-content-center align-items-center p-0 m-0">
							<img src="icons/sensor.svg">
							<div class="Info-Box-Components d-flex justify-content-center align-items-center">
								<p>BASE STATIONS</p>
							</div>
						</a>
					</div>
				</div>
			
		</div>
		
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/owl.js"></script>
	<!-- <script src="js/mouse.js"></script> -->
</body>
</html>