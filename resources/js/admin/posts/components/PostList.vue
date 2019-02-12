<template>
    <div class="component-wrap">

        <!-- search -->
        <v-card class="pt-3">
            <v-layout row wrap>
                <v-flex xs12 sm4 class="px-2">
                    <v-btn @click="$router.push({name:'posts.create'})" class="blue lighten-1" dark>
                        Create New Services
                        <v-icon right dark>add</v-icon>
                    </v-btn>
                </v-flex>
                <v-flex xs12 sm8 class="px-2 text-xs-center text-sm-right">
                    <v-btn @click="$router.push({name:'posts.categories.list'})" class="blue lighten-1" dark>
                        Manage Category <v-icon right dark>category</v-icon>
                    </v-btn>
                </v-flex>
                <v-flex xs12 class="my-2"><v-divider></v-divider></v-flex>
                <v-flex xs12 class="px-2">
                    <v-autocomplete box
                              multiple
                              chips
                              deletable-chips
                              clearable
                              prepend-icon="filter_list"
                              label="Filter By Category"
                              :items="filters.categoryOptions"
                              item-text="name"
                              item-value="id"
                              v-model="filters.categoryId"
                    ></v-autocomplete>
                </v-flex>
            </v-layout>
        </v-card>
        <!-- /search -->

        <!-- data table -->
        <v-data-table
                v-bind:headers="headers"
                v-bind:pagination.sync="pagination"
                :items="items"
                :total-items="totalItems"
                class="elevation-1">
            <template slot="headerCell" slot-scope="props">
                <span v-if="props.header.value=='title'">
                    <v-icon>person</v-icon> {{ props.header.text }}
                </span>
                <span v-else-if="props.header.value=='categories'">
                    <v-icon>category</v-icon> {{ props.header.text }}
                </span>
                <span v-else>{{ props.header.text }}</span>
            </template>
            <template slot="items" slot-scope="props">
                <td>
                    <v-menu>
                        <v-btn icon slot="activator">
                            <v-icon>more_vert</v-icon>
                        </v-btn>
                        <v-list>
                            <v-list-tile @click="$router.push({name:'posts.edit',params:{id: props.item.id}})">
                                <v-list-tile-title>Edit</v-list-tile-title>
                            </v-list-tile>
                            <v-list-tile @click="trash(props.item)">
                                <v-list-tile-title>Delete</v-list-tile-title>
                            </v-list-tile>
                        </v-list>
                    </v-menu>
                </td>
                <td>{{ props.item.title }}</td>
                <td>{{ props.item.category.name }}</td>
                <td>
                    <v-avatar outline>
                        <v-icon v-if="props.item.is_enable==1" class="green--text">visibility</v-icon>
                        <v-icon class="grey--text" v-else>visibility_off</v-icon>
                    </v-avatar>
                </td>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                headers: [
                    { text: 'Action', value: false, align: 'left', sortable: false },
                    { text: 'Title', value: 'title', align: 'left', sortable: false },
                    { text: 'Category', value: 'categories', align: 'left', sortable: false },
                    { text: 'Status', value: 'active', align: 'left', sortable: false },
                ],
                items: [],
                totalItems: 0,
                pagination: {
                    rowsPerPage: 10
                },

                filters: {
                    title: '',
                    categoryId: [],
                    categoryOptions: []
                },

                dialogs: {
                    showPermissions: {
                        items: [],
                        show: false
                    }
                }
            }
        },
        mounted() {
            const self = this;

            self.loadCategories(()=>{});

            self.$eventBus.$on(['POST_ADDED','POST_UPDATED','POST_DELETED','CATEGORY_ADDED'],()=>{
                self.loadPosts(()=>{});
            });

            self.$store.commit('setBreadcrumbs',[
                {label:'Services', title:''},
            ]);
        },
        watch: {
            'pagination.page':function(){
                this.loadPosts(()=>{});
            },
            'pagination.rowsPerPage':function(){
                this.loadPosts(()=>{});
            },
            'filters.name':_.debounce(function(){
                const self = this;
                self.loadPosts(()=>{});
            },700),
            'filters.email':_.debounce(function(){
                const self = this;
                self.loadPosts(()=>{});
            },700),
            'filters.categoryId':_.debounce(function(){
                const self = this;
                self.loadPosts(()=>{});
            },700)
        },
        methods: {
            trash(post) {
                const self = this;

                self.$store.commit('showDialog',{
                    type: "confirm",
                    icon: 'warning',
                    title: "Confirm Deletion",
                    message: "Are you sure you want to delete this post?",
                    okCb: ()=>{

                        axios.delete('/admin/posts/' + post.id).then(function(response) {

                            self.$store.commit('showSnackbar',{
                                message: response.data.message,
                                color: 'success',
                                duration: 3000
                            });

                            self.$eventBus.$emit('POST_DELETED');

                        }).catch(function (error) {

                            self.$store.commit('hideLoader');

                            if (error.response) {
                                self.$store.commit('showSnackbar',{
                                    message: error.response.data.message,
                                    color: 'error',
                                    duration: 3000
                                });
                            } else if (error.request) {
                                console.log(error.request);
                            } else {
                                console.log('Error', error.message);
                            }
                        });
                    },
                    cancelCb: ()=>{
                        console.log("CANCEL");
                    }
                });
            },
            showDialog(dialog, data) {

                const self = this;

                switch (dialog){
                    case 'post_permissions':
                        self.dialogs.showPermissions.items = data;
                        setTimeout(()=>{
                            self.dialogs.showPermissions.show = true;
                        },500);
                    break;
                }
            },
            loadPosts(cb) {

                const self = this;

                let params = {
                    title: self.filters.title,
                    categoryIds: self.filters.categoryId.join(","),
                    page: self.pagination.page,
                    per_page: self.pagination.rowsPerPage
                };

                axios.get('/admin/posts',{params: params}).then(function(response) {
                    self.items = response.data.data.data;
                    self.totalItems = response.data.data.total;
                    self.pagination.totalItems = response.data.data.total;
                    (cb || Function)();
                });
            },
            loadCategories(cb) {

                const self = this;

                let params = {
                    paginate: 'no'
                };

                axios.get('/admin/post-categories',{params: params}).then(function(response) {
                    self.filters.categoryOptions = response.data.data;
                    (cb || Function)();
                });
            }
        }
    }
</script>