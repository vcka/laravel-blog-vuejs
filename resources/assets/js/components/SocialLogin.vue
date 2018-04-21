<template>
    <span class="social_login">            
        <fb-signin-button :params="fbSignInParams" @success="onFBSignInSuccess" @error="onFBSignInError">Sign in with Facebook</fb-signin-button>
        <g-signin-button :params="googleSignInParams" @success="onGMSignInSuccess" @error="onGMSignInError"> Sign in with Google</g-signin-button>
        <div class="or">Or</div>
    </span>    
</template>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '1620070808222467',
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true, // parse social plugins on this page
            version: 'v2.8' // use graph api version 2.8
        });
        FB.AppEvents.logPageView();
    };
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    export default {
        data: () => {
            return {
                fbSignInParams: {
                    scope: 'email,user_likes',
                    return_scopes: true
                },
                googleSignInParams: {
                    client_id: '709494068584-k6l4u4tbjd3l47ifa1gmqtv9hp9e7df8.apps.googleusercontent.com'
                }
            };
        },
        methods: {
            onFBSignInSuccess(response) {
                var url = '/me?fields=id, email, name, gender, birthday';
                FB.api(url, dude => {
                    var params = dude;
                    var self = this;
                    this.$commonHelper.postAxios(`fb-login`, params).then(data => {
                        self.setLoginData(data);
                    }).catch(function (error) {
                        console.log(error);
                    });
                });
            },
            onFBSignInError(error) {
                console.log('OH NOES', error);
            },
            onGMSignInSuccess(googleUser) {
                const profile = googleUser.getBasicProfile();
                var params = {'name': profile.ig, 'email': profile.U3};
                var self = this;
                this.$commonHelper.postAxios(`gm-login`, params).then(data => {
                    self.setLoginData(data);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            onGMSignInError(errors) {
                console.log('OH NOES', errors);
            },
            setLoginData(data) {
                if (data.response_code === 201) {
                    if (typeof data.errors.user_invalid !== 'undefined') {
                        $('.global_errors').html(data.errors.user_invalid);
                        $('.global_errors').css({"border": "1px solid red", "padding": "10px", "margin-left": "14px", "width": "320px", "color": "red"});
                    } else {
                        this.displayErrors(data.errors);
                    }
                } else if (data.response_code === 200) {
                    this.$userHelper.setToken(data.data);
                    this.$router.push('/');
                } else {
                    alert('Please refresh page');
                }
            }
        }
    }
</script>
<style>
    .fb-signin-button {
        /* This is where you control how the button looks. Be creative! */
        display: inline-block;
        padding: 4px 8px;
        border-radius: 3px;
        background-color: #4267b2;
        color: #fff;
        margin: 10px 0px 0px 0px;
        box-shadow: 0 3px 0 #4267b2;
        cursor: pointer;
    }
    .social_login {
        margin:20px 0px 15px 15px;
    }
    .social_login .or {
        padding: 10px 0px 0px 14px;
        font-size: 20px;
    }
    .g-signin-button {
        /* This is where you control how the button looks. Be creative! */
        display: inline-block;
        padding: 4px 8px;
        border-radius: 3px;
        background-color: #3c82f7;
        color: #fff;
        box-shadow: 0 3px 0 #0f69ff;
        cursor: pointer;
    }
</style>