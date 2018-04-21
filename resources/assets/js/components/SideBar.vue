// App.vue
<template>
    <div class="col-md-4 float-right">
        <!-- Search Widget -->
        <!--div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div-->

        <!-- Categories Widget -->
        <div class="card my-4" v-if="categories.length > 0">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <ul class="list-unstyled mb-0">
                        <li v-for="category in categories">
                            <router-link :to="{ path: '/post/category/' + category.slug }">{{ category.name }} ({{ category.post_count }})</router-link>                            
                        </li>            
                    </ul>
                </div>
            </div>
        </div>
        <!-- Tags Widget -->
        <div class="card my-4" v-if="tags.length > 0">
            <h5 class="card-header">Tags</h5>
            <div class="card-body">
                <div class="row">
                    <ul class="list-unstyled mb-0">
                        <li v-for="tag in tags">                            
                            <router-link :to="{ path: '/post/tag/' + tag.slug }">{{ tag.name }} ({{ tag.post_count }})</router-link>    
                        </li>            
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="card my-4" v-if="archives.length > 0">
            <h5 class="card-header">Archive</h5>
            <div class="card-body">
                <div class="row">
                    <ul class="list-unstyled mb-0" v-for="(archive, key) in archives[0]">                        
                        <li>
                            <router-link :to="{ path: '/archive/' + key }">{{ key }} ({{ archive['total_post'] }})</router-link>                                
                        </li>
                        <ul>                            
                            <li v-for="(month, mkey) in archive.months">
                                <router-link :to="{ path: '/archive/' + key + '/' + month['month'] }">{{ mkey }} ({{ month['count'] }})</router-link>    
                            </li>
                        </ul>                        
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Side Widget -->
        <!--div class="card my-4">
            <h5 class="card-header">Side Widget</h5>
            <div class="card-body">
                You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
            </div>
        </div-->
    </div>
</template>

<script>

    export default {
        data() {
            return {
                categories:[],
                tags:[],
                archives:[],
            };
        },
        methods : {
            read() {
                this.$commonHelper.getAxios(`get-sidebar`).then(data => {
                    this.categories = data.categories;
                    this.tags = data.tags;
                    this.archives = data.archive_data;
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