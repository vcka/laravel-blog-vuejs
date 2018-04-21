<template>
    <div id="comment-section" v-on:click="bindEvents">
        <div style="padding-bottom: 20px;" v-html="this.comments"></div>        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                comment: null,
                parent: 0,
                item_id: 0,
                comments: null
            };
        },
        props: ['postid', 'login'],
        methods: {
            read() {
                this.$commonHelper.getAxios(`get-post-comments/${this.parentData.postId}`).then(data => {
                    this.comments = data;
                }).catch(error => {
                    console.log(error);
                });
            },
            onSubmit() {
                if (this.comment !== null) {
                    this.item_id = this.post_id;
                    /*this.axios.get(`/laravellikecomment/comment/add?comment=${this.comment}&parent=${this.parent}&item_id=${this.item_id}`).then(({ data }) => {
                        this.comment = null;
                    });*/
                }
            },
            bindEvents(e) {
                var target = e.target;
                if (target.id === 'show-comment') {
                    this.showComment(target);
                }
            },
            showComment(target) {
                $('.comment').show();
                var show = $(target).data("show-comment");
                $('.show-' + $(target).data("item-id") + '-' + show).fadeIn('normal');
                $(target).data("show-comment", show + 1);
                $(target).text("Show more");
            }
        },
        created() {
            this.read();
        },
        computed: {
            parentData: function () {
                return {
                    'postId': this.postid
                };
            }
        }
    }
</script>
