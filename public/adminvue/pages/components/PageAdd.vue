<template>
    <div>
        <v-card>
            <v-card-title>
                <v-icon>person</v-icon> Create New Page
            </v-card-title>
            <v-divider></v-divider>
            <v-form v-model="valid" ref="pageFormAdd" lazy-validation>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex xs12 sm12>
                            <v-text-field box label="Title" v-model="title" :rules="titleRules"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12>
                            <v-text-field box label="Url" v-model="url" :rules="urlRules"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12>
                            <v-textarea box label="Summary" v-model="summary" :rules="summaryRules"></v-textarea>
                        </v-flex>

                        <v-flex xs12 sm12>
                            <v-text-field box label="Tags" v-model="tags" :rules="tagsRules"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12>
                            <v-mce id="body" v-model="body"></v-mce>
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

                tags: '',
                tagsRules: [
                    //(v) => v && v.length <= 255 || 'Maximum is 255 characters.',
                ],

                url: '',
                urlRules: [
                    //(v) => v && v.length <= 255 || 'Maximum is 255 characters.',
                ],
                body: '',
                selectedStatus: 0,
                options: {
                    status:[
                        {label:'Active', value:1},
                        {label:'Inative', value:0},
                    ],

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

            const self = this;


            self.$store.commit('setBreadcrumbs',[
                {label:'Pages', name:'pages.list'},
                {label:'Create', name:''},
            ]);
        },
        methods: {
            save() {

                const self = this;

                let payload = {
                    title: self.title,
                    summary: self.summary,
                    url: self.url,
                    tags: self.tags,
                    body: self.body,
                    is_enable: self.selectedStatus
                };

                self.$store.commit('showLoader');

                axios.post('/admin/pages',payload).then(function(response) {

                    self.$store.commit('showSnackbar',{
                        message: response.data.message,
                        color: 'success',
                        duration: 3000
                    });

                    self.$eventBus.$emit('PAGE_ADDED');
                    self.$store.commit('hideLoader');

                    // reset
                    self.$refs.pageFormAdd.reset();

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
            }
        }
    }
</script>