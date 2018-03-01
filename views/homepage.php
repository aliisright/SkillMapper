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
      ?>
          <a href="index.php?skillId=<?= $skill['id'] ?>"><section class="skill-box <?= $skill['status']==1?'':($skill['status']==2?'skill-box-unlocked':'skill-box-locked') ?>">
            <?php if($skill['status']==1) { ?>
              <span class="skill-delete-button"><img src="https://vignette.wikia.nocookie.net/theloudhouse/images/a/a5/X.png/revision/latest?cb=20170917150003" width="10px"></span>
            <?php } ?>

            <img src="<?= $skill['path'] ?>" width="100px">
          </section></a>
      <?php } ?>
        </div>
      <?php }?>
</div>
