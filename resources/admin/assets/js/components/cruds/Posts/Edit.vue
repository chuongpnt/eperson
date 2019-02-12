<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Services</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <form @submit.prevent="submitForm" novalidate>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit</h3>
                            </div>

                            <div class="box-body">
                                <back-buttton></back-buttton>
                            </div>

                            <bootstrap-alert />

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title">Title *</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="title"
                                            placeholder="Enter Title *"
                                            :value="item.title"
                                            @input="updateTitle"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="title">Title JP*</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="title_jp"
                                            placeholder="Enter Title JP*"
                                            :value="item.title_jp"
                                            @input="updateTitleJP"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="title">Slug</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="slug"
                                            placeholder="Enter Slug"
                                            :value="item.slug"
                                            @input="updateSlug"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="summary">Summary</label>
                                    <textarea
                                            rows="3"
                                            class="form-control"
                                            name="summary"
                                            placeholder="Enter Summary"
                                            :value="item.summary"
                                            @input="updateSummary"
                                            >
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="summary">Summary JP</label>
                                    <textarea
                                            rows="3"
                                            class="form-control"
                                            name="summary_jp"
                                            placeholder="Enter Summary"
                                            :value="item.summary_jp"
                                            @input="updateSummaryJP"
                                    >
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <vue-ckeditor
                                            name="content"
                                            :id="'content'"
                                            :value="item.content"
                                            @input="updateContent"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="content">Content JP</label>
                                    <vue-ckeditor
                                            name="content_jp"
                                            :id="'contentjp'"
                                            :value="item.content_jp"
                                            @input="updateContentJP"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="picture">Picture</label>
                                    <input
                                            type="file"
                                            class="form-control"
                                            @change="updatePicture"
                                    >
                                    <ul v-if="item.picture" class="list-unstyled">
                                        <li>
                                            {{ item.picture.name || item.picture.file_name }}
                                            <button class="btn btn-xs btn-danger"
                                                    type="button"
                                                    @click="removePicture"
                                            >
                                                Remove file
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <!--<div class="form-group">
                                    <label for="rating">Rate</label>
                                    <input
                                            type="number"
                                            class="form-control"
                                            name="rating"
                                            placeholder="Enter Rate"
                                            :value="item.rating"
                                            @input="updateRating"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="viewer">Viewer</label>
                                    <input
                                            type="number"
                                            class="form-control"
                                            name="viewer"
                                            placeholder="Enter Viewer"
                                            :value="item.viewer"
                                            @input="updateViewer"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="stage">Stage</label>
                                    <v-select
                                            name="stage"
                                            @input="updateStage"
                                            :value="item.stage"
                                            :options="stageEnum"
                                            />
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <v-select
                                            name="category"
                                            label="title"
                                            @input="updateCategory"
                                            :value="item.category"
                                            :options="categoriesAll"
                                            />
                                </div>-->
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input
                                                    type="checkbox"
                                                    name="is_homepage"
                                                    :value="item.is_homepage"
                                                    :checked="item.is_homepage == true"
                                                    @change="updateIs_Homepage"
                                            >
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user">Author</label>
                                    <v-select
                                            name="user"
                                            label="name"
                                            @input="updateUser"
                                            :value="item.user"
                                            :options="usersAll"
                                            />
                                </div>
                            </div>

                            <div class="box-footer">
                                <vue-button-spinner
                                        class="btn btn-primary btn-sm"
                                        :isLoading="loading"
                                        :disabled="loading"
                                        >
                                    Save
                                </vue-button-spinner>
                            </div>
                        </div>
                    </form>
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
    computed: {
        ...mapGetters('PostsSingle', ['item', 'loading', 'categoriesAll', 'usersAll', 'stageEnum']),
    },
    created() {
        this.fetchData(this.$route.params.id)
    },
    destroyed() {
        this.resetState()
    },
    watch: {
        "$route.params.id": function() {
            this.resetState()
            this.fetchData(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions('PostsSingle', ['fetchData', 'updateData', 'resetState', 'setTitle', 'setSummary', 'setContent', 'setPicture','setRating', 'setViewer', 'setStage', 'setCategory', 'setUser', 'setTitleJP', 'setSummaryJP', 'setContentJP','setSlug','setIs_Homepage']),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        updateSummary(e) {
            this.setSummary(e.target.value)
        },
        updateContent(value) {
            this.setContent(value)
        },
        updateTitleJP(e) {
            this.setTitleJP(e.target.value)
        },
        updateSlug(e) {
            this.setSlug(e.target.value)
        },
        updateSummaryJP(e) {
            this.setSummaryJP(e.target.value)
        },
        updateContentJP(value) {
            this.setContentJP(value)
        },
        removePicture(e, id) {
            this.$swal({
                title: 'Are you sure?',
                text: "To fully delete the file submit the form.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#dd4b39',
                focusCancel: true,
                reverseButtons: true
            }).then(result => {
                if (typeof result.dismiss === "undefined") {
                    this.setPicture('');
                }
            })
        },
        updatePicture(e) {
            this.setPicture(e.target.files[0]);
            this.$forceUpdate();
        },

        updateRating(e) {
            this.setRating(e.target.value)
        },
        updateViewer(e) {
            this.setViewer(e.target.value)
        },
        updateStage(value) {
            this.setStage(value)
        },
        updateCategory(value) {
            this.setCategory(value)
        },
        updateUser(value) {
            this.setUser(value)
        },
        updateIs_Homepage(e) {
            this.setIs_Homepage(e.target.checked)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'posts.index' })
                    this.$eventHub.$emit('update-success')
                })
                .catch((error) => {
                    console.error(error)
                })
        }
    }
}
</script>


<style scoped>

</style>
