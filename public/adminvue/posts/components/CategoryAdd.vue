<template>
    <div class="component-wrap">

        <!-- form -->
        <v-card>
            <v-card-title>
                <v-icon>groups</v-icon> Create New Cateogry
            </v-card-title>
            <v-divider></v-divider>
            <v-form v-model="valid" ref="categoryFormAdd" lazy-validation>
                <v-container grid-list-md>
                <v-layout row wrap>
                    <v-flex xs12>
                        <div class="body-2 white--text">Cateogry Infomations</div>
                    </v-flex>
                    <v-flex xs12>
                        <v-text-field box label="Name" v-model="name" :rules="nameRules"></v-text-field>
                    </v-flex>
						<v-flex xs12>
							<v-textarea box label="Summary" v-model="summary" :rules="summaryRules"></v-textarea>
						</v-flex>
                    <v-flex xs12>
                        <v-btn @click="save()" :disabled="!valid" color="primary" dark>Save</v-btn>
                    </v-flex>
                </v-layout>
            </v-container>
            </v-form>
        </v-card>
        <!-- /form -->

    </div>
</template>

<script>
    export default {
        data() {
            return {
                valid: false,
                name: '',
                nameRules: [
                    (v) => !!v || 'Name is required',
                ],
                summary: '',
                summaryRules: [
                    //(v) => v && v.length <= 255 || 'Maximum is 255 characters.',
                ]
            }
        },
        mounted() {
            const self = this;

            self.$store.commit('setBreadcrumbs',[
                {label:'Posts', name:'posts.list'},
                {label:'Categories', name:'posts.categories.list'},
                {label:'Create', name:''},
            ]);
        },
        methods: {
            save() {

                const self = this;

                let payload = {
                    name: self.name,
                    summary: self.summary
                };

                self.$store.commit('showLoader');

                axios.post('/admin/post-categories', payload).then(function(response) {

                    self.$store.commit('showSnackbar',{
                        message: response.data.message,
                        color: 'success',
                        duration: 3000
                    });
                    self.$store.commit('hideLoader');
                    self.$eventBus.$emit('CATEGORY_ADDED');

                    // reset
                    self.$refs.categoryFormAdd.reset();

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
        }
    }
</script>