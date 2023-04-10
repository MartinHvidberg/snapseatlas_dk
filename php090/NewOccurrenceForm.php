
<!doctype html>
<html lang="da">

<!-- ver. 2023-04-09  De-conflicting ene and Almindelig ene -->

<head>
	<meta charset="utf-8" />
	<title>Snapse Atlas</title>
	<link rel="stylesheet" type="text/css" href="../html/Snapseatlas_html_screen.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../html/Snapseatlas_html_print.css" media="print" />
</head>
<body>

// <?php
//     $variable = "This is a test: 1, 2, 3";
//     echo "<script>console.log('$variable');</script>";
// ?>

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

			    <!--  <h2 style="background-color:Tomato;">  Sorry - This doesn't work at the moment. </h2> -->

				<datalist id="plantdk">
					<option value="agermåneslægten">
					<option value="almindelig agermåne">
					<option value="almindelig brombær">
					<option value="almindelig eg">
					<option value="Almindelig ene">
					<option value="almindelig hyld">
					<option value="almindelig røllike">
					<option value="almindelig røn">
					<option value="bjerg-fyr">
					<option value="blåbær">
					<option value="blåhat">
					<option value="bredbladet timian">
  					<!-- <option value="ene">  // This will conflict with "Almindelig ene" in the drop down check. -->
					<option value="gul snerre">
					<option value="havtorn">
					<option value="hedelyng">
					<option value="hindbær">
					<option value="klit-rose">
					<option value="kvan">
					<option value="marts-viol">
					<option value="mose-pors">
					<option value="prikbladet perikon">
					<option value="rejnfan">
					<option value="revling">
					<option value="selje-pil">
					<option value="skov-æble">
					<option value="skov-fyr">
					<option value="skovmærke">
					<option value="slåen">
					<option value="smalbladet timian">
					<option value="sød-æble">
					<option value="strand-kvan">
					<option value="strandmalurt">
					<option value="timianslægten">
					<option value="tormentil">
					<option value="tranebær">
					<option value="tyttebær">
					<option value="valnød">
					<option value="vellugtende agermåne">
					<option value="vellugtende kamille">
				</datalist>

				<datalist id="plantla">
					<option value="Achillea millefolium L.">
					<option value="Agrimonia eupatoria L.">
					<option value="Agrimonia L.">
					<option value="Agrimonia procera Wallr.">
					<option value="Angelica archangelica L.">
					<option value="Angelica archangelica subsp. litoralis Thell.">
					<option value="Calluna vulgaris (L.) Hull">
					<option value="Empetrum nigrum L.">
					<option value="Galium odoratum (L.) Scop.">
					<option value="Galium verum L.">
					<option value="Hippophaë rhamnoides Linnaeus">
					<option value="Hypericum perforatum L.">
					<option value="Juglans regia L.">
					<option value="Juniperus communis L.">
					<option value="Juniperus communis var. communis">
					<option value="Knautia arvensis (L.) Coult.">
					<option value="Malus domestica Borkh.">
					<option value="Malus sylvestris (L.) Mill.">
					<option value="Matricaria recutita L.">
					<option value="Myrica gale L.">
					<option value="Pinus mugo Turra">
					<option value="Pinus sylvestris L.">
					<option value="Potentilla erecta (L.) Raeusch.">
					<option value="Prunus spinosa L.">
					<option value="Quercus robur L.">
					<option value="Rosa pimpinellifolia L.">
					<option value="Rubus idaeus L.">
					<option value="Rubus plicatus Weihe & Nees">
					<option value="Salix caprea L.">
					<option value="Sambucus nigra L.">
					<option value="Seriphidium maritimum (L.) Poljakov">
					<option value="Sorbus aucuparia L.">
					<option value="Tanacetum vulgare L.">
					<option value="Thymus Linnaeus, 1753">
					<option value="Thymus pulegioides L.">
					<option value="Thymus serpyllum auct. non L.">
					<option value="Vaccinium myrtillus L.">
					<option value="Vaccinium oxycoccos L.">
					<option value="Vaccinium vitis-idaea L.">
					<option value="Viola odorata L.">
				</datalist>

				<article><a id="NyForekomst"></a>
					<h2>Indtast én forekomst af en plante.</h2>
						<form action="NewOccurrenceCheck.php" method="post">
						<fieldset><legend>Plante:</legend>
						Plantenavn: <input type="text" name="plan" list="plantdk"> på dansk<br>
						Species: <input type="text" name="spec" list="plantla"> navn på latin<br>
						Antal: <input type="n" min="1" max="1000000" name="freq" required> stk. Hvor mange planter var der?<br>
						Nord: <input type="number" step="any" min="54" max="58" name="nort" value=<?php echo $_GET["lat"]; ?> required> (dd.ddddd) fx 55.67600<br>
						Øst: <input type="number" step="any" min="8" max="16" name="east" value=<?php echo $_GET["lon"]; ?> required> (dd.ddddd) fx 12.56900<br>
						Radius: <input type="number" min="1" max="1000" name="radi" required> meter. Sikker inden for 10m, 100m, ...?<br>
						Dato: <input type="date" min="1900-01-01" max="2100-12-31" name="date" required> YYYY-MM-DD hvor planten senest er set<br>
						Naturtype: <input type="text" name="natt"> Naturtype for lokaliteten, fx skov, mose, ...<br>
						Lokalitets navn: <input type="text" name="locn"> Almindeligt stednavn<br>
						Din reference: <input type="text" name="yref"> Dit eget interne ID nummer, el.lign.<br>
						Note: <input type="text" name="note"> fx 'Privat grund', 'langs stien' eller tilsvarende<br>
						</fieldset>
						<br>
						<fieldset><legend>Bruger:</legend>
						Navn: <input type="text" name="user" required><br>
						Kodeord: <input type="password" name="pass" required>
						</fieldset>
						<br>
						<input type="submit" value="Okay">
						</form>
						<br>
						<p>Bemærk at hvis du kalder denne side ved at højreklikke i kortet på snapseatlas.dk, så er informationer om Nord og Øst allerede udfyldt med koordinaterne hvor du klikkede - Det er smart...</p>
						<p>Nogle webbrowsere husker brugernavn og kodeord felter i HTML-forms, så behøver du ikke taste dem hver gang. Informationerne bliver gemt lokalt på din maskine, af din browser. Dette virker bl.a. med Firefox +44)</p>

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
