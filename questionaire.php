<!doctype html>
<html lang="en">
  <head>
    <?php include "parts/header.php" ?>
  </head>
  <body>
    <?php 
      $page = "Questionaire";
      include "parts/navigation.php" ?>

    <header>
      <h2>Practice</h2>
    </header>

    <?php
      include "parts/questionaire_sql.php" 
    ?>

    <div class="main">
      <div>
       
        <form method="POST" style="text-align: left; margin-top: 16px; margin-bottom: 16px;">
          <label>ID</label><br>
          <input name="name" type="text" class="textarea"/><br>

          <p>Please select your gender</p>

          <input id="male" name="gender" type="radio" value="male"/>
          <label for="male">Male</label><br>

          <input id="female" name="gender" type="radio" value="female"/>
          <label for="female">Female</label><br>

          <input id="Other" name="gender" type="radio" value="other"/>
          <label for="Other">Other</label><br><br>

          <label>Age</label><br>
          <input name="age" type="number" class="textarea"/><br><br>
          
          <?php
            foreach ($results as $question):
          ?>
            <label><?= $question['question'] ?></label><br>
            <textarea name="question_<?= $question['id'] ?>" class="textarea"></textarea><br><br>
          <?php
            endforeach;
          ?>
          <input type="submit" value="Submit"/>
        </form>
      </div>
    </div>
  </body>
</html>