<template>
    <div class="col-md-8 float-left">
        <div class="login">
            <h1>Register</h1>
        </div>        
        <social-login></social-login>
        <form class="form-horizontal" role="form" method="POST" action="">
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" v-model="registerFormData.name" autofocus>                    
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" v-model="registerFormData.email" >                    
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" v-model="registerFormData.password" name="password">                    
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="registerFormData.password_confirmation">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" @click.prevent="register" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import SocialLogin from './SocialLogin.vue';
    export default {
        data: () => {
            return {
                registerFormData: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    _token: _token
                }
            };
        },
        components: {
            'social-login': SocialLogin
        },
        methods: {
            isValid: function () {
                var errors = {};
                var self = this;
                $.each(this.registerFormData, function (key, value) {
                    if (value === null || value === "") {
                        errors[key] = self.uppercase(key) + ' is required.';
                    }
                });

                if (typeof errors['name'] === 'undefined') {
                    if (!this.isValidName()) {
                        errors['name'] = 'Please enter valid name.';
                    }
                }

                if (typeof errors['email'] === 'undefined') {
                    if (!this.isValidEmail()) {
                        errors['email'] = 'Please enter valid email.';
                    }
                }

                if (typeof errors['password'] === 'undefined') {
                    if (!this.isValidPassword()) {
                        errors['password'] = 'Password must be at least 6.';
                    }
                }
                if (typeof errors['password'] === 'undefined') {
                    if (!this.isValidConfirmPassword()) {
                        errors['password_confirmation'] = 'Confirm password not match.';
                    }
                }
                var errorLength = Object.keys(errors).length;
                if (errorLength) {
                    this.displayErrors(errors);
                }
                return errorLength;
            }
            ,
            trim: function () {
                var self = this;
                $.each(this.registerFormData, function (key, value) {
                    self.registerFormData[key] = $.trim(value);
                });
            }
            ,
            isValidName: function () {
                var str = this.registerFormData['name'];
                var pattern = this.patternRex('stringForName');
                return pattern.test(str);
            },
            isValidEmail: function () {
                var str = this.registerFormData['email'];
                var pattern = this.patternRex('email');
                return pattern.test(str);
            },
            isValidPassword: function () {
                var str = this.registerFormData['password'];
                var pattern = this.patternRex('password');
                return pattern.test(str);
            },
            isValidConfirmPassword: function () {
                return this.registerFormData['password'] === this.registerFormData['password_confirmation'];
            },
            patternRex: function (value) {
                var pattern = {
                    number: new RegExp('^[0-9]+$'),
                    stringForName: new RegExp("^[a-zA-Z ]{2,30}$"),
                    email: new RegExp("^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$"),
                    password: new RegExp("(?=.{6,})")
                };
                return pattern[value] || undefined;
            },
            displayErrors: function (errors) {
                $.each(errors, function (key, value) {
                    $('#' + key).after('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            },
            uppercase: function (str) {
                var array1 = str.split(' ');
                var newarray1 = [];

                for (var x = 0; x < array1.length; x++) {
                    newarray1.push(array1[x].charAt(0).toUpperCase() + array1[x].slice(1));
                }
                return newarray1.join(' ');
            },
            register: function () {
                //console.log('Form Data : ', JSON.stringify(this.registerFormData, undefined, 2));
                $('.help-block').remove();
                this.trim();
                var self = this;
                if (this.isValid() === 0) {
                    
                    this.$commonHelper.postAxios(`register`, this.registerFormData).then(data => {
                        if (data.response_code === 201) {
                            self.displayErrors(data.errors);
                        } else if (data.response_code === 200) {
                            this.$userHelper.setToken(data.data);
                            self.$router.push('/');
                        } else {
                            alert('Please refresh page');
                    }
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else {

                }
            },
        },
        computed: {
            isLoggedIn() {
                return this.$userHelper.isLoggedIn();
            }
        },
        created() {
            if (this.isLoggedIn) {
                this.$router.push('/');
            }
        }

    }
</script>
