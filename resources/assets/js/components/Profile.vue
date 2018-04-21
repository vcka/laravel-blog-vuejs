<template>
    <div class="col-md-8" style="float:left;">
        Hello, {{ userObj.name }}.
    </div>
</template>
<script>
    export default {
        data() {
            return {
                userObj: []
            };
        },
        methods: {
            getUserProfile() {
                this.$commonHelper.getAxios('profile', true).then(data => {
                    if (data.status === 'success' && data.response_code === 200) {
                        this.userObj = data.data;
                    } else {

                    }
                }).catch(error => {
                    console.log(error.response);
                });
            }
        },
        computed: {
            isLoggedIn() {
                return this.$userHelper.isLoggedIn();
            }
        },
        created() {
            if (!this.isLoggedIn) {
                this.$router.push('/login');
            } else {
                this.getUserProfile();
            }
        }
    }
</script>