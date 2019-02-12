<template>
    <div>
        <v-card>
            <v-card-title>
                <v-icon>person</v-icon> Edit Post
            </v-card-title>
            <v-divider class="mb-2"></v-divider>
            <v-form v-model="valid" ref="postFormAdd" lazy-validation>
                <v-container grid-list-md>
                    <v-layout row wrap>
                    <v-flex xs12 sm12>
                        <v-text-field box label="Title" v-model="title" :rules="titleRules"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm12>
                        <v-textarea box label="Summary" v-model="summary" :rules="summaryRules"></v-textarea>
                    </v-flex>
                    <v-flex xs12 sm12>
                        <v-mce id="body" v-model="body"></v-mce>
                    </v-flex>
                    <v-flex xs12 sm12>
                        <v-flex xs12 sm4>
                            <v-select
                                    label="Category"
                                    v-bind:items="options.categories"
                                    v-model="selectedCategory.id"
                                    item-text="name"
                                    item-value="id"
                            ></v-select>
                        </v-flex>
                    </v-flex>
                    <v-flex xs12 sm12>
                        <v-flex xs12 sm4>
                            <v-select
                                    label="Status"
                                    v-bind:items="options.status"
                                    v-model="selectedStatus"
                                    item-text="label"
                                    item-value="value"
                            ></v-select>
                        </v-flex>
                    </v-flex>
                    <!--
                    <v-flex xs12 sm4>
                        <v-btn @click="addSpecialCategory()" class="blue lighten-1" dark>
                            Add Category
                            <v-icon right>add</v-icon>
                        </v-btn>
                    </v-flex>
                    -->
                    <v-flex xs12>
                        <v-btn @click="save()" :disabled="!valid" color="primary" dark>Save</v-btn>
                    </v-flex>
                </v-layout>
                </v-container>
            </v-form>
        </v-card>
    </div>
</template>

<script>
    export default {
        props: {
            propPostId: {
                required: true
            }
        },
        data() {

            const self = this;

            return {
                valid: false,
                title: '',
                titleRules: [
                    (v) => !!v || 'Title is required',
                ],
                summary: '',
                summaryRules: [
                    //(v) => v && v.length <= 255 || 'Maximum is 255 characters.',
                ],
                body: '',
                selectedStatus: 0,
                selectedCategory: [],
                options: {
                    status:[
                        {label:'Active', value:1},
                        {label:'Inative', value:0},                        
                    ],
                    categories:[]
                },

                alert: {
                    show: false,
                    icon: '',
                    color: '',
                    message: ''
                }
            }
        },
        mounted() {
            console.log('components.PostEdit.vue');

            const self = this;

            self.loadCategories(()=>{});

            self.$eventBus.$on(['CATEGORY_ADDED'],()=>{
                self.loadCategories(()=>{});
            });

            this.loadPosts(()=>{});
        },
        methods: {
            save() {

                const self = this;

                let payload = {
                    title: self.title,
                    summary: self.summary,
                    body: self.body ? self.body : '',
                    is_enable: self.selectedStatus,
                    category: self.selectedCategory,
                };

                self.$store.commit('showLoader');

                axios.put('/admin/posts/'+self.propPostId,payload).then(function(response) {

                    self.$store.commit('showSnackbar',{
                       message: response.data.message,
                       color: 'success',
                       duration: 3000
                    });

                    self.$eventBus.$emit('POST_UPDATED');
                    self.$store.commit('hideLoader');

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
            addSpecialCategory() {
                const self = this;
            },
            loadPosts(cb) {

                const self = this;

                axios.get('/admin/posts/' + self.propPostId).then(function(response) {
                    let Post = response.data.data;

                    self.title = Post.title;
                    self.summary = Post.summary;
                    self.body = Post.body;
                    self.selectedStatus = Post.is_enable;
                    self.selectedCategory = Post.category;

                    self.$store.commit('setBreadcrumbs',[
                        {label:'Posts',name:'posts.list'},
                        {label:'Edit',name:''},
                        {label:Post.name,name:''},
                    ]);

                   (cb || Function)();
                });
            },
            loadCategories(cb) {

                const self = this;

                let params = {
                    paginate: 'no'
                };

                axios.get('/admin/post-categories',{params: params}).then(function(response) {
                    self.options.categories = response.data.data;
                     
                    _.each(self.options.categories,c=>{
                        c.categories = false;
                    });
                    
                    (cb || Function)();
                });
            }
        }
    }
</script>