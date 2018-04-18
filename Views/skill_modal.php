            <!--Modal-->
            <div class="modal fade skill-modal" id="skill-description-<?= $skill->id ?>" tabindex="-1" role="dialog" aria-labelledby="skill-description-label" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="skill-description-label"><?= $skill->name ?></h5>
                      <!--Modal Stars-->
                        <div class="d-flex">
                          <?php
                            for($i=1; $i<=$score->id; $i++) {
                          ?>
                              <a href="index.php?deleteStarSkillId=<?= $userSkill->id ?>&i=<?= $i ?>"><img src="http://www.pngpix.com/wp-content/uploads/2016/11/PNGPIX-COM-Star-Vector-PNG-Transparent-Image-500x481.png" width="20px" height="20px"></a>
                          <?php }
                            for($i=$score->id+1; $i<=5; $i++) {
                          ?>
                              <a href="index.php?addStarSkillId=<?= $userSkill->id ?>&i=<?= $i ?>"><img src="https://www.muvizz.com/images/icon/empty-star.png" width="20px" height="20px"></a>
                          <?php } ?>

                        </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <ul class="list-group">
                    <?php
                      $goals = $userSkill->userCompletedGoals();

                      foreach($goals as $goal) {
                        $sql = "SELECT * FROM user_skillgoal WHERE skillgoal_id = ?";
                        $completedGoals = dbConnection($sql);
                        $completedGoals->execute(array($goal['id']));
                        $completedGoals = $completedGoals->fetch();
                      ?>
                          <li class="list-group-item list-group-item-success"><a href="index.php?userSkillGoaltoDelete=".<?= $completedGoals->id ?>><img class="mr-2"   src="http://pluspng.com/img-png/success-png-success-icon-image-23194-400.png" width="20px"></a><?= $goal->goal ?></li>
                      <?php }
                      $goals = userUncompletedGoals($skill->id);
                      foreach($goals as $goal) {
                      ?>
                      <a class="link" href="index.php?userSkillGoaltoAdd=".<?= $goal->id ?>><li class="list-group-item"><?= $goal->goal ?></li></a>
                    <?php } ?>
                    </ul>
                  </div>

                </div>
              </div>
            </div>
