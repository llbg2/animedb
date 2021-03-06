<?php $page = 'create_page'; ?>
<?php require 'header.php'; ?>
<?php require 'functions.php'; ?>

<div class="container">

<div class="row">
  <div class="span12">
    <form action="create.php" method="post" enctype="multipart/form-data" class="form" id="createForm">
      <input type="text" name="character_name" class="input-large" placeholder="Name" required>
      <input type="text" name="alias" class="input-large" placeholder="Alias">
      <select name="gender"><option>Male</option><option>Female</option></select>
      <select name="approx_age"><option>Baby</option><option>Todler</option><option>Child</option><option>Teen</option><option>Adult</option><option>Senior</option></select>
      <input type="text" name="hair_colour" class="input-large" placeholder="Hair Colour" required>
      <select name="hair_length"><option>Hair Above Ears</option><option>Hair Below Ears</option><option>Hair Below Shoulders</option><option>Hair Below Waist</option></select>
      <input type="text" name="eye_colour" class="input-large" placeholder="Eye Colour" required>
      <select name="ear_type"><option>Human Ears</option><option>Cat Ears</option><option>Dog Ears</option><option>Horns</option><option>Other</option></select>
      <input type="text" name="anime" class="input-large" placeholder="Anime">
      <input type="text" name="weapons" class="input-large" placeholder="Weapons">
      <textarea id="area1" class="tinymce" rows="17" name="description"></textarea>
      <div class="form-actions">
        <span class="btn btn-file btn-primary">Upload an Image<input type="file" name="image" /></span>
        <button class="btn btn-block" type="submit">Submit</button>
      </div>
    </form>
  </div>
</div>

</div> <!-- /container -->

<?php

  //Config

  require 'config.php';

  if (isset($_FILES['image']['tmp_name'])) {$file = $_FILES['image']['tmp_name'];}

  //Create Connection
  $con = new mysqli($host, $username, $password, $database);

  //Check Connetion
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

  if (isset($_POST['character_name']))
  {

    // Post Character Data
      // Create Prepared Statement
      if ($stmt = $con->prepare("INSERT INTO characters (character_name, alias, gender, approx_age, hair_colour, hair_length, eye_colour, ear_type, anime, weapons, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
        $stmt->bind_param('sssssssssss', $name, $alias, $gender, $age, $hairColour, $hairLength, $eyeColour, $earType, $anime, $weapons, $description);

        //Variables

        if (isset($_POST['character_name'])) {$name = $_POST['character_name'];}
        if (isset($_POST['alias'])) {$alias = $_POST['alias'];}
        if (isset($_POST['gender'])) {$gender = $_POST['gender'];}
        if (isset($_POST['approx_age'])) {$age = $_POST['approx_age'];}
        if (isset($_POST['hair_colour'])) {$hairColour = $_POST['hair_colour'];}
        if (isset($_POST['hair_length'])) {$hairLength = $_POST['hair_length'];}
        if (isset($_POST['eye_colour'])) {$eyeColour = $_POST['eye_colour'];}
        if (isset($_POST['ear_type'])) {$earType = $_POST['ear_type'];}
        if (isset($_POST['anime'])) {$anime = $_POST['anime'];}
        if (isset($_POST['weapons'])) {$weapons = $_POST['weapons'];}
        if (isset($_POST['description'])) {$description = addslashes($_POST['description']);}

        //Execute

        $stmt->execute();

        //Close the statement

        $stmt->close();

      } else {
        echo "Prepared Statement Error" . $mysqli->error();
      }

    /*
    $result = "INSERT INTO characters (character_name, alias, gender, approx_age, hair_colour, hair_length, eye_colour, ear_type, anime, weapons, description) VALUES ('$name', '$alias', '$gender', '$age', '$hairColour', '$hairLength', '$eyeColour', '$earType', '$anime', '$weapons', '$description')";

    if (!mysqli_query($con,$result))
    {
      die('Error: ' . mysqli_error($con));
    } 

    */

    // Post Image Data

    $allowedExtensions = array("jpg", "jpeg", "gif", "png");
    $extension = end(explode(".", $_FILES['image']['name']));

    if ($_FILES['image']['type'] == "image/jpg" ||
      $_FILES['image']['type'] == "image/jpeg" ||
      $_FILES['image']['type'] == "image/gif" ||
      $_FILES['image']['type'] == "image/png" ||
      $_FILES['image']['type'] == "image/pjpeg" &&
      in_array($extension, $allowedExtensions)) {

      if ($_FILES['image']['error'] > 0) {
        echo "Error uploading image: " . $_FILES['image']['error'];

      } else {

        $filename = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $imagename = addslashes($_FILES['image']['name']);
        $lastid = mysqli_insert_id($con);

        // SQL Query

        $query = "INSERT INTO character_image (image_name, image, character_id) VALUES ('$imagename', '$filename', '$lastid')";

        if (!mysqli_query($con, $query)) {
          
          die('Error' . mysqli_error($con));

        }

      }

    }

  }
  mysqli_close($con);
?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</body></html>