  <!-- signup Modal -->
  <div class="modal fade" id="signupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="signupModal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="signupModal">Sign Up to Programming Wiz</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="components/_signup.php" method="post">
                      <div class="mb-3">
                          <label for="signupUsername" class="form-label">Username</label>
                          <input name="signupUsername" type="text" class="form-control" id="signupUsername" aria-describedby="emailHelp" required>
                          <div id="emailHelp" class="form-text">8-20 characters long</div>
                      </div>
                      <div class="mb-3">
                          <label for="signupPassword" class="form-label">Password</label>
                          <input name="signupPassword" type="password" class="form-control" id="signupPassword" required>
                      </div>
                      <div class="mb-3">
                          <label for="signupConfirmPassword" class="form-label">Confirm Password</label>
                          <input type="password" name="signupConfirmPassword" class="form-control" id="signupConfirmPassword">
                      </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Register</button>
              </div>
              </form>
          </div>
      </div>
  </div>
  </div>
  