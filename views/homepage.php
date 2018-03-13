<div class="col-md-11">
  <?= "Hello ".$_SESSION['nickname']; ?>

    <?php
      while($level = $levels->fetch()) {
    ?>
      <div class="level-box">
      <?php
        //Fetch skills where level = $level['level']
        $skills->execute(array($level['level']));
        while($skill = $skills->fetch()) {

        $skillClassSql = "SELECT * FROM user_skill WHERE user_id = ? AND skill_id = ?";
        $skillState = dbConnection($skillClassSql);
        $skillState->execute(array($_SESSION['id'], $skill['id']));
        $skillState = $skillState->fetch();
      ?>
          <a href=<?= $skillState['state_id'] == 2 ? "index.php?validatedSkillId=".$skill['id'] : '#' ?>><section class="skill-box <?= $skillState['state_id'] == 1 ? 'skill-box-locked':($skillState['state_id'] == 2 ? 'skill-box-unlocked':'') ?>">

            <?php if($skillState['state_id'] == 1) { ?>
              <img class="lock-image" src="https://cdn2.iconfinder.com/data/icons/app-types-in-grey/512/lock_512pxGREY.png" width="100px">
            <?php } ?>

            <?php if($skillState['state_id'] == 3) { ?>
              <div class="skill-delete-button">
                <a href="index.php?deletedSkillId=<?= $skill['id'] ?>"><span><img src="https://vignette.wikia.nocookie.net/theloudhouse/images/a/a5/X.png/revision/latest?cb=20170917150003" width="10px"></span></a>
              </div>
            <?php } ?>

            <img src="<?= $skill['path'] ?>" width="100px">
          </section></a>
      <?php } ?>
        </div>
      <?php }?>
</div>
