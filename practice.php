<!doctype html>
<html lang="en">
  <head>
    <?php include "parts/header.php" ?>

    <script>
      var isPractice = true;
      var speed = 500;
    </script>
  </head>
  <body>
    <?php 
      $page = "Practice";
      include "parts/navigation.php" ?>

    <?php
      include "parts/practice_images_sql.php" ?>

    <header>
      <h2>Practice</h2>
    </header>

    <div class="image-container">
      <div>
        <button style="margin: 130px; font-size: 100px;" id="startButton">Start</button>
        <?php
            foreach ($images as $image) {
                ?>
                  <div id="flashingImage<?php echo $image['id'] ?>" style="background-image: url('<?php echo $image['image_url'] ?>')" class="img gone"></div>
                <?php
            }
        ?>
      </div>
    </div>

    <div id="sliderContainer" class="main gone">
      <div>
        <span>How much do you trust this webpage?</span>
        <input class="slider" type="range" min="1" max="100" value="1" id="ratingSlider">
      </div>
      <div>
          <p style="float: left;">Not very trustworthy</p>
          <p style="float: right;">Very trustworthy</p>
        </div>
      <div id="nameInputContainer" style="display: none;">
        <label>Name</label><br>
        <input id="nameInput" type="text" class="textarea"/><br><br>
      </div>
      <div>
        <button id="nextButton" style="font-size: 30px; margin-bottom: 16px;">Next</button>
        <button id="submitButton" class="gone" style="font-size: 30px; margin-bottom: 16px;">Submit</button>
      </div>
    </div>
  </body>
</html>