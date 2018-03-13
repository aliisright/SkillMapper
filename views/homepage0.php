<div class="col-md-11">
  <?= "Hello ".$_SESSION['nickname']; ?>

    <?php
      while($level = $levels->fetch()) {
        $sql = "SELECT * FROM skills WHERE level = ?";
        $skills = dbConnection($sql);
        $skills->execute(array($level['id']));
        while($skill = $skills->fetch()) {
          ?>
          <a href="index.php?validatedSkillId=<?= $skill['id'] ?>"><section class="skill-box">

              <a href="index.php?deletedSkillId=<?= $skill['id'] ?>"><span class="skill-delete-button"><img src="https://vignette.wikia.nocookie.net/theloudhouse/images/a/a5/X.png/revision/latest?cb=20170917150003" width="10px"></span></a>

            <img src="<?= $skill['path'] ?>" width="100px">
          </section></a>
          <?php
          $sql = "SELECT * FROM parentskill_childskill
          JOIN skills
          ON parentskill_childskill.childskill_id = skills.id
          WHERE parentskill_id = ?";
          $childSkills = dbConnection($sql);
          $childSkills->execute(array($skill['id']));
          while($childSkill = $childSkills->fetch()) {
            ?>
              <a href="index.php?validatedSkillId=<?= $childSkill['id'] ?>"><section class="skill-box">

                  <a href="index.php?deletedSkillId=<?= $childSkill['id'] ?>"><span class="skill-delete-button"><img src="https://vignette.wikia.nocookie.net/theloudhouse/images/a/a5/X.png/revision/latest?cb=20170917150003" width="10px"></span></a>

                <img src="<?= $childSkill['path'] ?>" width="100px">
            <?php } } } ?>
</div>
