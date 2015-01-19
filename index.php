<!DOCTYPE html>
<html>
	<head>
		<!--Title-->
		<title>DFA RPI</title>
		<link rel="icon" type="image/png" href="resources/img/dfarpi.png">
		
		<!--CSS-->
		<link rel="stylesheet" href="resources/css/stylesheet.css" type="text/css">
		<link href='http://fonts.googleapis.com/css?family=Oxygen:700,400' rel='stylesheet' type='text/css'>
		
		<!--Owl Carousel-->
		<link rel="stylesheet" href="resources/css/owl.carousel.css">
		<link rel="stylesheet" href="resources/css/owl.theme.css">
		<link rel="stylesheet" href="resources/css/owl.transitions.css">

	</head>
	<body>
		<!--Navigation Bar-->
		<nav>
			<a href="index.php"><img src="resources/img/dfarpi.png"></a>
			<ul>
				<li><a href="index.php">HOME</a></li>
				<li><a href="#">ABOUT</a></li>
				<li><a href="https://loft.io/dfa-rensselaer/#projects">LOFT</a></li>
				<li><a href="#">JOIN US</a></li>
			</ul>
		</nav>
		
		<!--Page Top-->
		<header>
			<h1 id="scroller">DESIGN FOR AMERICA</h1>
			<h2>at Rensselaer Polytechnic Institute</h2>
		</header>
	
		<!--Slider-->
		<div id="slider" class="owl-carousel owl-theme card">
			<div class="item"><img src="resources/img/img4.jpg"></div>
			<div class="item"><img src="resources/img/img5.jpg"></div>
			<div class="item"><img src="resources/img/img6.jpg"></div>
			<div class="item"><img src="resources/img/img7.jpg"></div>
			<div class="item"><img src="resources/img/img8.jpg"></div>
		</div>	
		
		<!--Page Body-->
		<!--What is DFA-->
		<div id="about" class="card">
			<h1>About Us</h1>
			<ul>
				<li>
					<h3>What We Do</h3>
					<p>
						Design for America (DFA) is an award-winning 
						nationwide network of interdisciplinary student
						teams and community members using design to create
						local and social impact. DFA currently tackles 
						national challenges in Education, Health, Economy
						and Environment and more.
					</p>
				</li>
				<li>
					<h3>Human Centered Design</h3>
					<p>
						DFA is about solving real problems, not making a 
						quick buck. All of our work is oriented towards 
						making real meaningful change, and that means 
						keeping the user in mind at all times. We practice
						a design philosophy called Human Centered Design
						where the focus is on making the biggest positive
						impact on the most people possible.
					</p>
				</li>
				<li>
					<h3>Outreach and Givng Back</h3>
					<p>
						Design for America (DFA) is a national network 
						students from universities across the country 
						working together to solve real problems.  We 
						focus on interdisciplinary work and making a 
						difference
					</p>
				</li>
			</ul>
		
			<!--Join Us-->
			<button onclick="javascript:location.href='#'"><h1>Join Us</h1></button>
		</div>
		
		<!--Current Projects-->
		<div id="loft" class="card">
			<h1>Current Projects</h1>
			<?php
				//Curl Function
				function curl($url){
					$options = Array(
						CURLOPT_RETURNTRANSFER => TRUE,
						CURLOPT_FOLLOWLOCATION => TRUE,
						CURLOPT_AUTOREFERER => TRUE,
						CURLOPT_CONNECTTIMEOUT => 120,
						CURLOPT_TIMEOUT => 120,
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_VERBOSE => TRUE,
						CURLOPT_SSL_VERIFYPEER => FALSE,
						CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0',
						CURLOPT_URL => $url,
					);
					
					$ch = curl_init();
					curl_setopt_array($ch, $options);
					$data = curl_exec($ch);
					curl_close($ch);
					return $data;
				}
				
				//Trim Data
				function scrape_between($data, $start, $end){
					$data = stristr($data, $start);
					$data = substr($data, strlen($start));
					$stop = stripos($data, $end);
					$data = substr($data, 0, $stop);
					return $data;
				}
				
				//Execute Functions
				$scraped_page = curl("https://loft.io/dfa-rensselaer");
				$scraped_data = scrape_between($scraped_page, '<a name="projects"></a>', '</article>');
				
				//Scrub String
				$original = array('/static/img/new/placeholder-square.jpg', '/dfa-rensselaer/', '<em>', '</em>');
				$updated = array('resources/img/placeholder-square.jpg', 'https://loft.io/dfa-rensselaer/','' ,'');
				$scraped_data = str_replace($original, $updated, $scraped_data);
				$scraped_data = preg_replace('/<h5>(.*)h5>/','', $scraped_data);
				
				
				//Place in Arrat
				//Index 1 = Title
				$dataArray = explode('<div class="project">', $scraped_data);
				
				//Print
				if(sizeof($dataArray) <= 1){
					//If no projects
					echo "<h4>No projects to report yet...</h4>";
				}else{
					//Projects
					echo "<table><tr>";
					for($i = 1; $i < sizeof($dataArray); $i++){
						echo '<td><div class="project">' . $dataArray[$i]. "</td>";
						if ($i % 3 == 0){
							echo "</tr><tr>";
						}
					}
					
					//View More
					echo '<td colspan="';
					if((sizeof($dataArray) % 3) == 0){
						echo '3';
					}else{
						echo (sizeof($dataArray) % 3);
					}
					echo '"><h1><a href="https://loft.io/dfa-rensselaer/#projects">See more on loft.io</a></h1></td>';
					echo "</tr></table>";
				}
			?>
		</div>
		
		<!--Footer-->
		<footer>
			<h6>Created by Rob Russo</h6>
		</footer>
		
		<!--JavaScript-->
		<script src="resources/js/jquery-1.11.1.min.js"></script>
		<script src="resources/js/owl.carousel.min.js"></script>
		<script src="resources/js/owlInit.js"></script>
	</body>	
</html>