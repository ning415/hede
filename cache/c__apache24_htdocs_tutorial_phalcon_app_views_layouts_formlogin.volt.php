<?= $this->flashSession->output() ?>


  <p> session email : <?= $this->session->get('email') ?> </p>
  <p> session password : <?= $this->session->get('password') ?> </p>

  <p> cookies email : <?= $this->cookies->get('email') ?> </p>
  <p> cookies password : <?= $this->cookies->get('password') ?> </p>




<?= $this->tag->form(['', 'method' => 'post', 'class' => 'form-horizontal']) ?>
  <div class="form-group">
    <label class="col-md-2 control-label">Email</label>
    <div class="col-md-9">
      <?= $this->tag->textField(['email', 'class' => 'form-control', 'placeholder' => 'example@sample.com']) ?>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-2 control-label">Password</label>
    <div class="col-md-9">
      <?= $this->tag->passwordField(['password', 'class' => 'form-control']) ?>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-2 control-label">Remember Me</label>
    <div class="col-md-9">
      <?= $this->tag->checkField(['remember']) ?>
    </div>
  </div>

  <div class="form-group text-center">
    <?= $this->tag->submitButton(['Submit', 'class' => 'btn btn-primary btn-lg']) ?>
    <button type="reset" class="btn btn-warning btn-sm"> Reset </button>
    <a href="authen/logout" class="btn btn-danger"> Logout </a>
  </div>

  <a href="#" id="loginFacebook" style="color: blue;">Login to Facebook</a>
  <a href="<?= $this->url->getBaseUri() ?>authen/googlecallback" style="color: green;">Login to Google Plus</a>
  
<?= $this->tag->endForm() ?>








<script>
// var access = "";
//
// function getUserData() {
//   $.post("authen/getdatafb", {
//       token: access
//     })
//     .done(function(response) {
//       if (response == "failed") alert("Login Failed.");
//       else if (response == "success") window.location.href = "profile";
//     })
//     .fail(function(response) {
//       console.log("failed");
//       console.log(response);
//     });
// }
//
// function clearSession() {
//   $.post("authen/logout")
//     .done(function(response) {
//       if (response == "failed") alert("Logout Failed.");
//       else if (response == "success") window.location.href = "authen";
//     })
//     .fail(function(response) {
//       console.log("failed");
//       console.log(response);
//     });
// }
//
// window.fbAsyncInit = function() {
//   FB.init({
//     appId: '138619826774612',
//     cookie: true,
//     xfbml: true,
//     autoLogAppEvents: true,
//     status: true,
//     version: 'v2.10'
//   });
//
//   FB.getLoginStatus(function(response) {
//     if (response.status === 'connected') {
//       statusChangeCallback(response);
//     } else {
//
//     }
//   });
// };
//
// function statusChangeCallback(response) {
//   access = response.authResponse.accessToken;
//   if (response.status === 'connected') {
//     getUserData();
//   } else {
//
//   }
// }
//
// (function(d, s, id) {
//   var js, fjs = d.getElementsByTagName(s)[0];
//   if (d.getElementById(id)) {
//     return;
//   }
//   js = d.createElement(s);
//   js.id = id;
//   js.src = "//connect.facebook.com/en_US/sdk.js";
//   fjs.parentNode.insertBefore(js, fjs);
// }(document, 'script', 'facebook-jssdk'));
//
// $(document).on('click', '#loginFacebook', function() {
//   FB.login(function(response) {
//     if (response.authResponse) {
//       access = response.authResponse.accessToken;
//       statusChangeCallback(response);
//     }
//   }, {
//     scope: 'email,public_profile',
//     return_scopes: true
//   });
// });
//
// $(document).on('click', '#logoutFacebook', function() {
//   FB.logout(function(response) {
//     clearSession();
//   });
// });

</script>
