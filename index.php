    <?php require 'header.php'; ?>

    <div class="container">

      <div class="row">
        <div class="span12" id="form">
          <form action="searchcharacter.php" onsubmit="return false" method="post" class="form" id="searchForm">
            <input type="text" name="gender" class="input-small" placeholder="Gender">
            <input type="text" name="approx_age" class="input-small" placeholder="Apparent Age">
            <input type="text" name="hair_colour" class="input-small" placeholder="Hair Colour">
            <input type="text" name="hair_length" class="input-small" placeholder="Hair Length">
            <input type="text" name="eye_colour" class="input-small" placeholder="Eye Colour">
            <input type="text" name="ear_type" class="input-small" placeholder="Ear Type">
            <input type="text" name="body_type" class="input-small" placeholder="Body Type">
            <input type="text" name="weapons" class="input-small" placeholder="Weapons">
            <div class="form-actions">
                <button class="btn" id="submit_button" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>

      <div class="row">
        <div class="span12" id="ajaxcontainer">

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
        $.post($(this).attr("action"), $(this).serialize(), function(html) {
            $("#ajaxcontainer").html(html);
        });
        return false; // prevent normal submit
      });
    </script>

</body></html>