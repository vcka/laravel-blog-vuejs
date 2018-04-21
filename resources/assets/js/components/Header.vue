<template>
    <!-- Navigation -->
    <!-- userObj comes from App.vue -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">        
        <div class="container">
            <router-link :to="{ path: '/' }" class="navbar-brand">Gaana Blog</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                    <router-link v-if="!isLoggedIn" :to="{ path: '/register' }" class="nav-link">Register
                                 <span class="sr-only"></span>                        
                    </router-link>
                    </li>
                    <li class="nav-item">
                    <router-link v-if="!isLoggedIn" :to="{ path: '/login' }" class="nav-link">Login
                                 <span class="sr-only"></span>                        
                    </router-link>
                    </li>

                    <li class="nav-item">
                    <router-link v-if="isLoggedIn" :to="{ path: '/profile' }" class="nav-link">Profile
                                 <span class="sr-only"></span>                        
                    </router-link>
                    </li>

                    <li class="nav-item">
                        <a style="cursor: pointer;" v-if="isLoggedIn" :to="{ path: '/' }" @click.prevent="logout" class="nav-link">Logout
                           <span class="sr-only"></span>                        
                        </a>                   
                    </li>
                </ul>
            </div>            
        </div>
    </nav>
</template>

<script>
    export default {        
        methods: {
            logout() {
                this.$userHelper.logout();
                this.$router.push('/login');
            }
        },
        computed: {
            isLoggedIn() {
                return this.$userHelper.isLoggedIn();
            }
        }
    }
</script>