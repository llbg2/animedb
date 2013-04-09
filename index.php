    <?php $page = 'index_page'; ?>
    <?php require 'header.php'; ?>

    <div class="container">

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
            <div style="display:none; text-align:center;" id="dvloader"><img src="img/loading.gif" /></div>
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

    <script>
      $("form").submit(function() {
        $("#dvloader").show();
        $.post($(this).attr("action"), $(this).serialize(), function(html) {
            $("#ajaxcontainer").html(html, function() {
                $("#dvloader").hide();
            });
        });
        return false; // prevent normal submit
      });
    </script>

</body></html>