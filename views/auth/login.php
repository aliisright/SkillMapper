<form class="form-zone col-md-6 m-auto" method="POST">
  <h3>Connectez-vous!</h3>
  <?php
    if(isset($_GET['formMessage'])) {
      echo "<p class='alert alert-danger'>".$_GET['formMessage']."</p>";
    }
  ?>
  <div class="form-group">
    <label for="email">email</label>
    <input class="form-control" type="email" name="email" id="email">
  </div>

  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input class="form-control" type="password" name="password" id="password">
  </div>

  <div class="form-group">
    <button class="btn btn-primary" type="submit" name="submit">Connexion</button>
    <a href="register.php" role="button" class="btn btn-outline-secondary">Pas un membre? Inscrivez-vous ici!</a>
  </div>
</form>
