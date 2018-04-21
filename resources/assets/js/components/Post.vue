<template>
    <div class="col-md-8" style="float:left;">        
        <div class="post-preview">        
            <div class="card mb-4" v-for="post in posts">
                <img class="card-img-top" :src="'/post_image/' + post.image" alt="Est nostrum sunt." title="Est nostrum sunt.">
                     <div class="card-body">
                    <h2 class="card-title">{{ post.title }}</h2>
                    <p class="card-text"></p><div v-html="str_limit(post.body, 300)"></div>
                    <router-link :to="{ path: '/post/' + post.slug }" append class="btn btn-primary">Read More →</router-link>                
                </div>
                <div class="card-footer text-muted">
                    Posted on {{ post.created_at }} by
                    <strong>{{ post.posted_by.name }}</strong>
                    <span @click="likeIt" class="likeIt" :data-postid="post.id">
                        <small :id="'likeit' + post.id">{{ post.like_count }}</small>
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    </span>
                </div>
            </div>
            <ul v-if="pagesNumber.length > 1 && posts.length > 0" class="pagination justify-content-center mb-4">
                <ul class="pagination">
                    <li v-if="pagination.current_page > 1">
                        <a href="javascript:void(0)" aria-label="Previous" v-on:click.prevent="changePage(pagination.current_page - 1)">
                            <span class="page-link" aria-hidden="true">«</span>
                        </a>
                    </li>
                    <li v-for="page in pagesNumber" :class="{'active page-item': page == pagination.current_page, 'page-item' : page !== pagination.current_page }" v-on:click.prevent="changePage(page)">
                        <span class="page-link">{{ page }}</span>
                    </li>
                    <li v-if="pagination.current_page < pagination.last_page">
                        <a href="javascript:void(0)" aria-label="Next" v-on:click.prevent="changePage(pagination.current_page + 1)">
                            <span class="page-link" aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </ul>
        </div>
    </div>
</template>
<style>
    .fa-thumbs-up {
        cursor: pointer;
    }
</style>
<script>
    export default {
        data() {
            return {
                posts: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                },
                offset: 5
            };
        },
        methods: {
            read() {
                var url = `get-posts`;
                if (typeof this.$route.params.category !== 'undefined') {
                    url = `get-category-posts/${this.$route.params.category}`;
                } else if (typeof this.$route.params.tag !== 'undefined') {
                    url = `get-tag-posts/${this.$route.params.tag}`;
                } else if (typeof this.$route.params.year !== 'undefined' && typeof this.$route.params.month !== 'undefined') {
                    url = `get-post-by-month/${this.$route.params.year}/${this.$route.params.month}`;
                } else if (typeof this.$route.params.year !== 'undefined') {
                    url = `get-post-by-year/${this.$route.params.year}`;
                }
                if (this.pagination.current_page > 1) {
                    url += `?page=${this.pagination.current_page}`;
                }
                this.$commonHelper.getAxios(url).then(data => {
                    this.posts = data.data;
                    this.pagination = data;
                }).catch(error => {
                    console.log(error);
                });

            },
            likeIt(e) {
                var isLogin = this.isLoggedIn;
                if (!isLogin) {
                    this.$router.push('/login');
                }
                var currentTarget = e.currentTarget;
                var postId = currentTarget.getAttribute('data-postid');
                var data = {
                    postId: postId
                };                

                this.$commonHelper.postAxios(`like`, data, true).then(data => {
                    if (typeof data.response_code !== 'undefined') {
                        if (parseInt(data.response_code) === 200) {
                            $('#likeit' + postId).html(data.likes);
                        }
                    } else {
                        console.log('Some Error');
                }
                });
            },
            changePage(page) {
                this.pagination.current_page = page;
                this.read();
            },
            str_limit(string, value) {
                return string.substring(0, value) + '...';
            },
            changeRoute() {
                this.pagination.current_page = 1;
                this.posts = [];
                this.read();
            }
        },
        created() {
            this.read();
        },
        watch: {
            '$route': 'changeRoute'
        },
        computed: {
            pagesNumber() {
                if (!this.pagination.to) {
                    return [];
                }
                let from = this.pagination.current_page - this.offset;                
                if (from < 1) {
                    from = 1;
                }
                let to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                let pagesArray = [];
                for (let page = from; page <= to; page++) {
                    pagesArray.push(page);
                }
                return pagesArray;
            },
            isLoggedIn() {
                return this.$userHelper.isLoggedIn();
            },
            getAccessToken() {
                return this.$store.getters.getAccessToken;
            }

        }
    }
</script>
