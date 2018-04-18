<div class="content-section col-md-11">
  <?= "Hello ".$_SESSION['nickname']; ?>

    <?php
      foreach($levels as $level) {
    ?>
      <div class="level-box">
      <?php
        $skills = $level->skills();
        foreach($skills as $skill) {
          $userSkill = $skill->userSkill();
      ?>
          <a href=<?= $userSkill->state_id == 2 ? "index.php?validatedSkillId=".$skill->id : "#" ?>><section data-toggle="<?= $userSkill->state_id == 3 ? 'modal' : '' ?>" data-target="#skill-description-<?= $skill->id ?>" class="skill-box <?= $userSkill->state_id == 1 ? 'skill-box-locked':($userSkill->state_id == 2 ? 'skill-box-unlocked':'') ?>">

            <!--Lock image-->
            <?php if($userSkill->state_id == 1) { ?>
              <img class="lock-image" src="https://cdn2.iconfinder.com/data/icons/app-types-in-grey/512/lock_512pxGREY.png" width="100px">
            <?php } ?>

            <!--Delete button-->
            <?php if($userSkill->state_id == 3) { ?>
              <div class="skill-delete-button">
                <a href="index.php?deletedSkillId=<?= $skill->id ?>"><span><img src="https://vignette.wikia.nocookie.net/theloudhouse/images/a/a5/X.png/revision/latest?cb=20170917150003" width="10px"></span></a>
              </div>
            <?php } ?>

            <!--score stars-->
            <?php
              if($userSkill->state_id == 3) {
            ?>
                <div class="score-stars badge badge-dark">
                  <?php
                    $score = $userSkill->score();
                    for($i=1; $i<=$score->id; $i++) {
                  ?>
                      <img src="http://www.pngpix.com/wp-content/uploads/2016/11/PNGPIX-COM-Star-Vector-PNG-Transparent-Image-500x481.png" width="20px" height="20px">
                  <?php } ?>
                </div>
            <?php } ?>

            <!--Image-->
            <img src="<?= $skill->path ?>" width="100px">
          </section></a>
      <?php } ?>
        </div>
      <?php }
        include('Views/skill_modal.php');
      ?>
</div>
