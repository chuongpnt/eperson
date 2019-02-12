<template>
    <div class="page_wrap_vue">
        <v-tabs color="primary" v-model="active">

            <v-tab class="white--text" href="#files" ripple>
                Files
            </v-tab>
            <v-tab class="white--text" href="#manage-groups" ripple>
                Manage File Groups
            </v-tab>
            <v-tab class="white--text" href="#upload" ripple>
                Upload
            </v-tab>

            <v-tab-item id="files">
                <v-card flat>
                    <v-card-text>
                        <file-list></file-list>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <v-tab-item id="manage-groups">
                <v-card flat>
                    <v-card-text>
                        <file-group-list></file-group-list>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <v-tab-item id="upload">
                <v-card flat>
                    <v-card-text>
                        <file-upload></file-upload>
                    </v-card-text>
                </v-card>
            </v-tab-item>
        </v-tabs>
    </div>
</template>

<script>
    import FileGroupLists from './components/GroupList.vue';
    import FileUpload from './components/FileUpload.vue';
    import FileLists from './components/FileList.vue';
    export default {
        components: {
            FileUpload,
            FileGroupLists,
            FileLists
        },
        mounted() {
            console.log('pages.FileManager.vue');

            const self = this;

            self.$store.commit('setBreadcrumbs',[
                {label:'Files',name:''}
            ]);
        },
        data() {
            return {
                active: ''
            }
        },
        watch: {
            active(v) {
                console.log('active tab: ' + v);
            }
        },
        methods: {
        }
    }
</script>

<style scoped="">
    .finder_wrap {
        padding: 0 20px;
    }
</style>