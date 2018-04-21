<template>
    <div class="laravelComment" :id="'laravelComment-' + postid " style="clear: both;padding-top: 20px;">         
         <div class="ui threaded comments" :id="postid+'-comment-0'">
            <button class="ui basic small submit button" id="write-comment" :data-form="'#' + postid+'-comment-form'">Write comment</button>
            <form v-on:submit.prevent="onSubmit" style="clear: both;padding-top: 10px;" class="ui laravelComment-form form" :id="postid + '-comment-form'" data-parent="0" :data-item="postid">
                <div class="field">
                    <textarea id="0-textarea" rows="2" :disabled="!isLoggedIn" v-model="comment"></textarea>
                    <small v-if='!isLoggedIn' style="clear: both;padding-top: 10px;">Please Log in to comment</small>
                </div>
                <input type="submit" class="ui basic small submit button" value="Add Comment" :disabled="!isLoggedIn">
            </form>
            <div v-for="comment in comments" :class="'comment show-' + postid + '-0'" :id="'comment-' + comment.id ">
                 <a class="avatar">
                    <img src="http://www.gravatar.com/avatar/7990df747d8b6768a3b3cbc4f4b5a270?d=identicon">
                </a>
                <div class="content">
                    <a class="author" url=""> {{ comment.user.name }} </a>
                    <div class="metadata">
                        <span class="date">{{ comment.created_at | moment("from") }}</span>
                    </div>
                    <div class="text">
                        {{ comment.comment }}
                    </div>
                    <div class="actions">
                        <a class="reply reply-button" @click="replyBox" :data-comment-id="comment.id" :data-parent-comment-id="comment.id" :data-item-id="postid">Reply</a>                        
                    </div>
                    <div class="laravel-like">
                        <i :id="'comment-' + comment.id + '-like'" @click="likedislike" class="icon disabled outline laravelLike-icon thumbs up" :data-item-id="comment.id" :data-vote="1">
                    </i>
                    <span :id="'comment-'+comment.id+'-total-like'" v-if = "comment.total_likes === null">0</span>
                    <span :id="'comment-'+comment.id+'-total-like'" v-else>{{ comment.total_likes.total_like }}</span>
                    <i :id="'comment-' + comment.id + '-dislike'" @click="likedislike" class="icon disabled outline laravelLike-icon thumbs down" :data-item-id="comment.id" :data-vote="-1">
                </i>
                <span :id="'comment-'+comment.id+'-total-dislike'" v-if = "comment.total_dislikes === null">0</span>
                <span :id="'comment-'+comment.id+'-total-dislike'" v-else>{{ comment.total_dislikes.total_dislike }}</span>
                <div v-html class="replybox" :id="comment.id + 'reply-box'"></div>
            </div>            
        </div>
        <div v-for="children in comment.children" class="comments" :id="postid + '-comment-' + children.id">
             <div :class="'comment show-' + postid + '-0'" :id="'comment-' + children.id">
                <a class="avatar">
                    <img src="http://www.gravatar.com/avatar/7990df747d8b6768a3b3cbc4f4b5a270?d=identicon">
                </a>
                <div class="content">
                    <a class="author" url=""> {{ children.user.name }} </a>
                    <div class="metadata">
                        <span class="date">{{ children.created_at | moment("from") }}</span>
                    </div>
                    <div class="text">
                        {{ children.comment }}
                    </div>
                    <div class="actions">
                        <a class="disabled reply reply-button" @click="replyBox" :data-comment-id="children.id" :data-parent-comment-id="comment.id" :data-item-id="postid">Reply</a>                        
                    </div>
                    <div class="laravel-like">
                        <i :id="'comment-' + children.id + '-like'" @click="likedislike" class="icon disabled outline laravelLike-icon thumbs up" :data-item-id="children.id" :data-vote="1"></i>
                        <span :id="'comment-'+children.id+'-total-like'" v-if = "children.total_likes === null">0</span>
                        <span :id="'comment-'+children.id+'-total-like'" v-else>{{ children.total_likes.total_like }}</span>
                        <i :id="'comment-' + children.id + '-dislike'" @click="likedislike" class="icon disabled outline laravelLike-icon thumbs down" :data-item-id="children.id" :data-vote="-1"></i>
                        <span :id="'comment-'+children.id+'-total-dislike'" v-if = "children.total_dislikes === null">0</span>
                        <span :id="'comment-'+children.id+'-total-dislike'" v-else>{{ children.total_dislikes.total_dislike }}</span>
                    </div>
                    <div class="replybox" :id="children.id + 'reply-box'"></div>
                </div>                
            </div>
        </div>               
    </div>
</div>
</div>
</template>
<style>
    .laravelLike-icon {
        cursor:pointer;
    }
    .replybox input {
        margin-top: 10px !important;
    }
    .replybox {
        margin: 10px 0px;
    }
</style>
<script>
    export default {
        data() {
            return {
                comment: null,
                parent: 0,
                item_id: 0
            };
        },
        props: ['comments', 'postid'],
        created() {
            //console.log(this.comments);
        },
        methods: {
            onSubmit() {
                if (this.comment !== null) {
                    this.item_id = this.postid;
                    var data = {
                        comment: this.comment,
                        parent: this.parent,
                        item_id: this.item_id
                    };

                    this.$commonHelper.postAxios(`add-comments?token=${this.getAccessToken}`, data).then(response => {
                        this.comment = null;
                    });
                }
            },
            likedislike(event) {
                if (!this.isLoggedIn) {
                    this.$router.push('/login');
                }
                var item_id = event.currentTarget.getAttribute('data-item-id');
                var vote = event.currentTarget.getAttribute('data-vote');
                var data = {
                    item_id: item_id,
                    vote: vote
                };

                var headers = {
                    'X-CSRF-Token': _token,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/x-www-form-urlencoded'
                };
                this.$commonHelper.postAxios(`vote`, data, true).then(data => {
                    if (data.flag == 1) {
                        if (data.vote == 1) {
                            $('#comment-' + item_id + '-like').removeClass('outline');
                            $('#comment-' + item_id + '-dislike').addClass('outline');
                        } else if (data.vote == -1) {
                            $('#comment-' + item_id + '-dislike').removeClass('outline');
                            $('#comment-' + item_id + '-like').addClass('outline');
                        } else if (data.vote == 0) {
                            $('#comment-' + item_id + '-like').addClass('outline');
                            $('#comment-' + item_id + '-dislike').addClass('outline');
                        }
                        $('#comment-' + item_id + '-total-like').text(data.totalLike == null ? 0 : data.totalLike);
                        $('#comment-' + item_id + '-total-dislike').text(data.totalDislike == null ? 0 : data.totalDislike);
                }
                });
            },
            reply() {
                var item_id = event.currentTarget.getAttribute('data-item-id');
                var vote = event.currentTarget.getAttribute('data-vote');
                var data = {
                    item_id: item_id,
                    vote: vote
                };

                var headers = {
                    'X-CSRF-Token': _token,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/x-www-form-urlencoded'
                };

                this.$commonHelper.postAxios(`vote?token=${this.getAccessToken}`, data).then(({ data }) => {

                });
            },
            replyBox() {
                if (!this.isLoggedIn) {
                    this.$router.push('/login');
                }
                var parent_comment_id = event.currentTarget.getAttribute('data-parent-comment-id');
                var item_id = event.currentTarget.getAttribute('data-item-id');
                var comment_id = event.currentTarget.getAttribute('data-comment-id');
                this.createReplyForm({comment_id, parent_comment_id, item_id});
            },
            createReplyForm(data) {
                var commentId = data.comment_id;
                var f = document.createElement("form");
                f.setAttribute('method', "post");
                f.setAttribute('class', "ui laravelComment-form form");
                f.setAttribute('v-on:submit.prevent', "onSubmit");

                //create input element
                var i = document.createElement("textarea");
                i.name = "user_name";
                i.id = "user_name1";
                i.setAttribute('rows', 2);
                //create a button
                var s = document.createElement("input");
                s.type = "submit";
                s.value = "Add Reply";
                s.setAttribute('class', "ui basic small submit button replyInput");

                // add all elements to the form
                f.appendChild(i);
                f.appendChild(s);
                //console.log(commentId + 'reply-box', document.getElementById(commentId + 'reply-box'));
                document.getElementById(commentId + 'reply-box').appendChild(f);
            }
        },
        computed: {
            isLoggedIn() {
                return this.$userHelper.isLoggedIn();
            },
            getAccessToken() {
                return this.$store.getters.getAccessToken;
            }
        }

    }
</script>
