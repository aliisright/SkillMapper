<form class="col-md-6 m-auto" method="post">
  <div class="form-group">
    <label for="nickname">Pseudo</label>
    <input type="text" class="form-control" name="nickname" id="nickname" required>
  </div>
  <div class="form-group">
    <label for="email">email</label>
    <input type="email" class="form-control" name="email" id="email" required>
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" name="password" id="password" required>
  </div>
  <div class="form-group">
    <label for="password2">Confirmation de mot de passe</label>
    <input type="password" class="form-control" name="password2" id="password2" required>
  </div>
  <div class="form-group text-center">
    <button type="submit" class="btn btn-dark" name="submit">Inscription</button>
  </div>
  <input type="hidden" name="form_type" value="register">
</form>
