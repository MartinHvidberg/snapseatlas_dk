
<!doctype html>
<html lang="da">
<head>
	<meta charset="utf-8" />
	<title>Snapse Atlas</title>
	<link rel="stylesheet" type="text/css" href="../html/Snapseatlas_html_screen.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../html/Snapseatlas_html_print.css" media="print" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<div id="wrapper"><!-- #wrapper -->
	<a id="Top"></a>
	<header><!-- header -->
		<h1><a href="https://snapseatlas.dk/">Snapse Atlas</a></h1>
		<a href="https://snapseatlas.dk/"><img src="../images/head_940x200.png" width="940" height="200" alt=""></a><!-- header image -->
	</header><!-- end of header -->

	<nav><!-- top nav -->
		<div class="menu">
			<ul>
				<li><a href="https://snapseatlas.dk/html/index.html">Home</a></li>
			</ul>
		</div>
	</nav><!-- end of top nav -->

	<section id="main"><!-- #main content and sidebar area -->
		<section id="container"><!-- #container -->
			<section id="content"><!-- #content -->

				<article><a id="NyForekomst"></a>
					<h2>Antal inberetninger, per bruger</h2>
					<?php

					// Author: Martin Hvidberg
					// Last edit: 2016-03-25 / mh

					// history
					// 150723 : Init
					// 200711 : upgade all from http:// to https://

					///header('Content-Type: application/json');

					/* Set internal character encoding to UTF-8 */
					mb_internal_encoding("UTF-8");
					/* Display current internal character encoding */
					//echo mb_internal_encoding();

					/* Open mysqli connection */
					require 'db.php';  // defines $db, the data base connection
					if ($db->connect_errno) {
						echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
					}
					$db->set_charset("utf8");

					/* Select queries return a resultset */
					//$sql = "select distinct `species`,`plantenavn`, count(`species`) as CountOf from occurrence group by `species`";
					$sql = "select distinct `source`,count(`source`) as CountOf from occurrence group by `source`ORDER BY CountOf DESC, source ASC";

					if(!$result = $db->query($sql)){
						echo 'something wrong with that sql statement ...';
						die('There was an error running the query [' . $db->error . ']');
					} else {
						echo '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
						echo '<table  border="1" style="width:100%">';
						echo '<tr><th>Bruger</th><th>Antal i Snapseatlas.dk</th></tr>';
						while($row = $result->fetch_assoc()){
							echo '<tr><td>',$row['source'],'</td><td>',$row['CountOf'],'</td></tr>';
						}
						echo '</table></body></html>';

						/* free result set */
						$result->close();
					}
					$db->close();
					?>

				</article>

			</section><!-- end of #content -->
		</section><!-- end of #container -->

		<aside id="sidebar"><!-- sidebar -->
				<h3></h3>
					<ul>
					</ul>
		</aside><!-- end of sidebar -->

	</section><!-- end of #main content and sidebar-->

	<footer>
		<section id="footer-area">
			<a id="Bot"></a>
			<section id="footer-outer-block">
					<aside id="first" class="footer-segment">
							<h3></h3><a id="links_kryddersnaps"></a>
								<ul>
								</ul>
					</aside><!-- end of #first footer segment -->

					<aside id="second" class="footer-segment">
							<h3></h3><a id="credits"></a>
								<ul>
								</ul>
					</aside><!-- end of #second footer segment -->

					<aside id="third" class="footer-segment">
							<h3>Kontakt</h3><a id="kontakt"></a>
								 Kontakt os venligst på e-mail.<br>
								 Alt om bruger-id og login: admin_users@snapseatlas.dk<br>
								 Alt andet til: martin@snapseatlas.dk
					</aside><!-- end of #third footer segment -->

					<aside id="fourth" class="footer-segment">
							<h3>Copyright, and -left</h3>
								<p>Alt hvad der står på denne webside kan frit og gratis citeres, også til komersielle formål, så længe der blot refereres til snapseatlas.dk.</p>
					</aside><!-- end of #fourth footer segment -->

			</section><!-- end of footer-outer-block -->

		</section><!-- end of footer-area -->
	</footer>

</div><!-- #wrapper -->

</body>
</html>
