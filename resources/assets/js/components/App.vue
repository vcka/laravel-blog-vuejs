<template>
    <div>        
        <app-header></app-header>        
        <div class="container">
            <div class="row">                        
                <div class="col-md-12">                       
                    <!--transition name="fade"-->
                    <router-view></router-view>
                    <!--/transition-->
                    <app-sidebar v-if="['profile'].indexOf($route.name) == -1"></app-sidebar>
                </div>
            </div>
        </div>
    </div>
</template>
<style type="text/css">
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
        opacity: 0
    }
</style>

<script>
    //import { mapState } from 'Vuex';
    import SideBar from './SideBar.vue';
    import Header from './Header.vue';
    export default {
        props: ['title'],
        components: {
            'app-sidebar': SideBar,
            'app-header': Header
        },
        computed: {
            /*...mapState({
                    userStore: state => state.userStore
            });*/
        },
        created() {
            this.$userHelper.dispatchUserObj();
        }
    }
</script>