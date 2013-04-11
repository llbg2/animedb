    <?php
        $page = 'index_page';
        require 'header.php';
        require 'config.php';

        //Create Connection
        $con = mysqli_connect($host, $username, $password, $database);
        if (mysqli_connect_errno($con)) {
            echo "Failed to open MYSQL Connection" . mysqli_connect_error();
        }

        $result = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM characters"));
        $numrows = $result['0'];

        mysqli_close($con);
    ?>

    <div class="container">

        <div class="row" id="bigbar">
            <div class="span6 roundbox" id="current_entries">
                <h1 class="act-success"><?php echo $numrows; ?></h1>
                <h4>Current Characters</h4>
            </div>
            <div class="span6 roundbox" id="createchar">
                <a href="create.php"><h1 class="act-info">Create a Character</h1></a>
            </div>
        </div>

      <div class="row">
        <div class="span12" id="form">
          <form action="searchcharacter.php" onsubmit="return false" method="post" class="form" id="searchForm">
            <select name="gender"><option>Male</option><option>Female</option></select>
            <select name="approx_age"><option>Baby</option><option>Todler</option><option>Child</option><option>Teen</option><option>Adult</option><option>Senior</option></select>
            <input type="text" name="hair_colour" class="input-small" placeholder="Hair Colour">
            <select name="hair_length"><option>Hair Above Ears</option><option>Hair Below Ears</option><option>Hair Below Shoulders</option><option>Hair Below Waist</option></select>
            <input type="text" name="eye_colour" class="ut-small" placeholder="Eye Colour">
            <select name="ear_type"><option>Human Ears</option><option>Cat Ears</option><option>Dog Ears</option><option>Horns</option><option>Other</option></select>
            <input type="text" name="weapons" class="input-small" placeholder="Weapons">
            <div class="form-actions">
                <button class="btn btn-primary" id="submit_button" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>

      <div class="row">
        <div class="span12" id="ajaxcontainer">
        </div>
        <div style="display:none; text-align:center;" id="dvloader"><img src="img/loading.gif" height="48px" width="48px" /></div>
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
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

    <script>
      $("form").submit(function() {
        $("#ajaxcontainer").hide("fast");
        $("#ajaxcontainer").show("fast");
        $("#dvloader").show();
        $.post($(this).attr("action"), $(this).serialize(), function(html) {
            $("#ajaxcontainer").html(html, function() {
        });
        $("#dvloader").hide();
        });
        return false; // prevent normal submit
      });

        $("#ajaxcontainer").on("click", "tr" , function(event) {
            $("#dvloader").show();
            var xid = $(this).children(".rowid").text();
            $("#ajaxcontainer").hide("fast", function() {
                $.post("character.php #ajax-container", { id: xid }, function(data) {
                    $("#ajaxcontainer").html(data);
                    $("#dvloader").hide();
                    $("#ajaxcontainer").show("fast");
                })
            })
        });

    </script>

</body></html>