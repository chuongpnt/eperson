<template>
    <div class="component-wrap">

        <!-- search -->
        <v-card class="pt-3">
            <v-layout row wrap>
                <v-flex xs12 sm4 class="px-2">
                    <v-btn @click="$router.push({name:'pages.create'})" class="blue lighten-1" dark>
                        Create New Page
                        <v-icon right dark>add</v-icon>
                    </v-btn>
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
                            <v-list-tile @click="$router.push({name:'pages.edit',params:{id: props.item.id}})">
                                <v-list-tile-title>Edit</v-list-tile-title>
                            </v-list-tile>
                            <v-list-tile @click="trash(props.item)">
                                <v-list-tile-title>Delete</v-list-tile-title>
                            </v-list-tile>
                        </v-list>
                    </v-menu>
                </td>
                <td>{{ props.item.title }}</td>
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
                    { text: 'Status', value: 'active', align: 'left', sortable: false },
                ],
                items: [],
                totalItems: 0,
                pagination: {
                    rowsPerPage: 10
                },

                filters: {
                    title: '',
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

            self.$eventBus.$on(['PAGE_ADDED','PAGE_UPDATED','PAGE_DELETED'],()=>{
                self.loadPosts(()=>{});
            });

            self.$store.commit('setBreadcrumbs',[
                {label:'Pages', title:''},
            ]);
        },
        watch: {
            'pagination.page':function(){
                this.loadPages(()=>{});
            },
            'pagination.rowsPerPage':function(){
                this.loadPages(()=>{});
            },
            'filters.name':_.debounce(function(){
                const self = this;
                self.loadPages(()=>{});
            },700),
            'filters.email':_.debounce(function(){
                const self = this;
                self.loadPages(()=>{});
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

                        axios.delete('/admin/pages/' + post.id).then(function(response) {

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
            loadPages(cb) {

                const self = this;

                let params = {
                    title: self.filters.title,
                    page: self.pagination.page,
                    per_page: self.pagination.rowsPerPage
                };

                axios.get('/admin/pages',{params: params}).then(function(response) {
                    self.items = response.data.data.data;
                    self.totalItems = response.data.data.total;
                    self.pagination.totalItems = response.data.data.total;
                    (cb || Function)();
                });
            }
        }
    }
</script>