<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Articles</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">View</h3>
                        </div>

                        <div class="box-body">
                            <back-buttton></back-buttton>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                        <tr>
                                            <th>#</th>
                                            <td>{{ item.id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ item.title }}</td>
                                            </tr>
                                        <tr>
                                            <th>Title JP</th>
                                            <td>{{ item.title_jp }}</td>
                                        </tr>
                                        <tr>
                                            <th>Summary</th>
                                            <td>{{ item.summary }}</td>
                                            </tr>
                                        <tr>
                                            <th>Summary JP</th>
                                            <td>{{ item.summary_jp }}</td>
                                        </tr>
                                        <tr>
                                            <th>Content</th>
                                            <td v-html="item.content"></td>
                                            </tr>
                                        <tr>
                                            <th>Content JP</th>
                                            <td v-html="item.content_jp"></td>
                                        </tr>
                                        <tr>
                                            <th>Picture</th>
                                            <td v-html="item.picture_link"></td>
                                            </tr>
                                        <tr>
                                            <th>Stage</th>
                                            <td>{{ item.stage }}</td>
                                            </tr>
                                        <tr>
                                            <th>Category</th>
                                            <td>
                                                <span class="label label-info" v-if="item.category !== null">
                                                    {{ item.category.title }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Author</th>
                                            <td>
                                                <span class="label label-info" v-if="item.user !== null">
                                                    {{ item.user.name }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tags</th>
                                            <td>
                                                <span class="label label-info" v-for="tags in item.tags">
                                                    {{ tags.name }}
                                                </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            // Code...
        }
    },
    created() {
        this.fetchData(this.$route.params.id)
    },
    destroyed() {
        this.resetState()
    },
    computed: {
        ...mapGetters('ArticlesSingle', ['item'])
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions('ArticlesSingle', ['fetchData', 'resetState'])
    }
}
</script>


<style scoped>

</style>
