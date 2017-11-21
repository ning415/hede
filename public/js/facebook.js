window.fbAsyncInit = function() {
  FB.init({
    appId: facebook.appId,
    cookie: true,
    xfbml: true,
    version: facebook.appVersion
  });

  FB.AppEvents.logPageView();

};

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {
    return;
  }
  js = d.createElement(s);
  js.id = id;
  js.src = "https://connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function statusChangeCallback(response) {
  if(response.status === "connected"){
    var access = response.authResponse.accessToken;
    $.post("authen/getdatafb", {token: access})
    .done(function(response){
      console.log(response);
    })
    .fail(function(response){
      console.log(response);
    });
  }
};

$(document).on('click', '#loginFacebook', function(){
  FB.login(function(response){
    console.log(response);
    if(response.authResponse){
      var access = response.authResponse.accessToken;
      statusChangeCallback(response);
    }
  }, {
    scope: 'email,public_profile',
    reture_scopes: true
  });
});

$(document).on('click', '#logoutFacebook', function(){
  FB.logout();
});
