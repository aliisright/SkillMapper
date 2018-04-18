<?php
//Parent Classes
    require 'Models/Model.php';

//Providors
    //Database
    require 'Providor/DB.php';
      //QueryBuilder
      require 'Providor/QueryBuilder.php';
      //RelationManager
      require 'Providor/RelationManager.php';
    //Request
    require 'Controllers/Requests/Request.php';
    require 'Controllers/Requests/Getter.php';
    //Helper functions
    require 'Providor/Helpers/Helper.php';
    require 'Providor/Helpers/HelperFunctions.php';

//Models
    require 'Models/Skill.php';
    require 'Models/Level.php';
    require 'Models/User.php';
    require 'Models/UserSkill.php';
    require 'Models/Score.php';
    require 'Models/SkillGoal.php';
//Controllers
    require 'Controllers/SkillController.php';

//Auth
    require 'Controllers/Auth/LoginController.php';
    require 'Controllers/Auth/RegisterController.php';

//Validators
    require 'Controllers/Validators/AuthValidator.php';
