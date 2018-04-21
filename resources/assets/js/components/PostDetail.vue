<template>
    <div class="col-md-8" style="float:left;" v-if = "isLoaded">    
        <h1 class="mt-4">{{ post.title }}</h1>    
        <p class="lead">by <strong>{{ (post.posted_by) ? post.posted_by.name : '' }}</strong></p>
        <hr>    
        <p>Posted on {{ post.created_at }}</p>
        <br />
        <hr />
        <!-- Preview Image -->
        <img class="img-fluid rounded" :src="'/post_image/' + post.image" alt="post.title">    
             <div class="categories" style="margin: 10px 0 0 0;">
            <small style="margin-top: 20px;border-radius: 5px;border: 1px solid gray;padding: 5px;" v-for="category in post.categories">                
                <router-link :to="{ path: '/post/category/' + category.slug }" append>{{ category.name }}</router-link>
            </small>            
        </div>
        <hr>
        <div class="post-body" v-html="post.body"></div>
        <hr>
        <h3>Tag Clouds</h3>
        <small v-for="tag in post.tags" class="pull-left" style="margin-right: 20px;border-radius: 5px;border: 1px solid gray;padding: 5px;">        
            <router-link  :to="{ path: '/post/tag/' + tag.slug }" append>                   
                {{ tag.name }}        
        </router-link>
    </small>    
    <!--comment-form v-if="post.id !== undefined" :login = "login" v-bind:postid = "post.id"></comment-form-->
    <comments v-if="post.comments !== undefined && post.id !== undefined" v-bind:postid = "post.id" :comments = "post.comments"></comments>
</div>
</template>

<script>
    import CommentForm from './CommentForm';
    import Comments from './Comments';
    export default {
        data() {
            return {
                slug: null,
                post: [],
                post_id: 0,
                login: 0,
                isLoaded: false
            };
        },
        components: {
            'comment-form': CommentForm,
            'comments': Comments
        },
        props: ['isLogin'],
        methods: {
            read() {
                this.$commonHelper.getAxios(`get-post-details/${this.$route.params.slug}`, this.registerFormData).then(data => {
                    this.post = data[0];
                    this.isLoaded = true;
                }).catch(error => {
                    console.log(error);
                });     
            }
        },
        created() {
            this.read();
        }
    }
</script>
<style>
    .laravelComment {
        margin:0 0 15px 0px;
    }
</style>
