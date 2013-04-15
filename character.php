<?php 
	
	$page = 'index_page';
	require 'header.php';
	require 'config.php';
	$id = $_REQUEST['id'];

	try {
		// Init
		$DBH = new PDO("mysql:host=$host;dbname=$database", $username, $password);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		//Query Craft
		$query = "SELECT * FROM characters WHERE character_id='$id'";

		//Prepare and Exec
		$STH = $DBH->query($query);
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$row = $STH->fetch();

    $desc = stripslashes($row['description']);

	} catch(PDOException $e) {
		echo $e->getMessage();
	}

?>

	<div class="container">
    <div id="ajax-container">

      <div class="row">
        <div class="span3" id="thumbnail">
        	<img class="img-rounded" src=<?php echo "getimage.php?id=" . $row['character_id'] ?> height="220px" width="220px" alt="" />
        </div>
        <div class="span9" id="summary">
        	<h1><?php echo $row['character_name']; ?></h1>
        	<h4><?php echo $row['alias']; ?></h4>
        	<em><?php echo $row['anime']; ?></em>
        </div>
      </div>

      <div class="row" style="margin-top:15px;">
      	<div class="span3" id="statistics" style="background-color:#f2f2f2;">
      		<dl class="dl-horizontal">
    			  <dt>Gender</dt>
    			  <dd><?php echo $row['gender']; ?></dd>
    			  <dt>Approximate Age</dt>
    			  <dd><?php echo $row['approx_age']; ?></dd>
    			  <dt>Hair Colour</dt>
    			  <dd><?php echo $row['hair_colour']; ?></dd>
    			  <dt>Hair Length</dt>
    			  <dd><?php echo $row['hair_length']; ?></dd>
    			  <dt>Eye Colour</dt>
    			  <dd><?php echo $row['eye_colour']; ?></dd>
    			  <dt>Ear Type</dt>
    			  <dd><?php echo $row['ear_type']; ?></dd>
    			  <dt>Weapon(s)</dt>
    			  <dd><?php echo $row['weapons']; ?></dd>
    			</dl>
      	</div>
      	<div class="span9" id="descriptiondiv">
      		<?php echo $desc; ?>
      	</div>
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./resources/jquery.js"></script>
    <script src="./resources/bootstrap-transition.js"></script>
    <script src="./resources/bootstrap-alert.js"></script>
    <script src="./resources/bootstrap-modal.js"></script>
    <script src="./resources/bootstrap-dropdown.js"></script>
    <script src="./resources/bootstrap-scrollspy.js"></script>
    <script src="./resources/bootstrap-tab.js"></script>
    <script src="./resources/bootstrap-tooltip.js"></script>
    <script src="./resources/bootstrap-popover.js"></script>
    <script src="./resources/bootstrap-button.js"></script>
    <script src="./resources/bootstrap-collapse.js"></script>
    <script src="./resources/bootstrap-carousel.js"></script>
    <script src="./resources/bootstrap-typeahead.js"></script>

  </div>

</body></html>
