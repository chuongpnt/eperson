<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Page</h1>
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
                                <label for="slug">Name Page</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        placeholder="Enter Name"
                                        :value="item.name"
                                        @input="updateName"
                                >
                            </div>

                            <div class="form-group">
                                <label for="slug">Name Page JP</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="name_jp"
                                        placeholder="Enter Name"
                                        :value="item.name_jp"
                                        @input="updateName_jp"
                                >
                            </div>

                            <!--<div class="form-group">
                                <label for="slug">Code Page</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="code"
                                        placeholder="Enter Slug"
                                        :value="item.code"
                                        @input="updateCode"
                                >
                            </div>-->


                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="title"
                                            placeholder="Enter Title"
                                            :value="item.title"
                                            @input="updateTitle"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="title_jp">Title jp</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="title_jp"
                                            placeholder="Enter Title jp"
                                            :value="item.title_jp"
                                            @input="updateTitle_jp"
                                            >
                                </div>

                                <div class="form-group">
                                    <label for="keyword">Keyword</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="keyword"
                                            placeholder="Enter Keyword"
                                            :value="item.keyword"
                                            @input="updateKeyword"
                                    >
                                </div>


                            <div class="form-group">
                                <label for="keyword">Keyword JP</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="keyword_jp"
                                        placeholder="Enter Keyword"
                                        :value="item.keyword_jp"
                                        @input="updateKeyword_jp"
                                >
                            </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="description"
                                            placeholder="Enter Description"
                                            :value="item.description"
                                            @input="updateDescription"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="description_jp">Description jp</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="description_jp"
                                            placeholder="Enter Description jp"
                                            :value="item.description_jp"
                                            @input="updateDescription_jp"
                                            >
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
                                            @input="updateContent_jp"
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
        ...mapGetters('PagesSingle', ['item', 'loading','stageEnum']),
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
        ...mapActions('PagesSingle', ['fetchData', 'updateData', 'resetState', 'setTitle', 'setTitle_jp', 'setDescription', 'setDescription_jp', 'setContent', 'setContent_jp', 'setCode', 'setName','setName_jp', 'setKeyword','setKeyword_jp','setPicture']),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        updateTitle_jp(e) {
            this.setTitle_jp(e.target.value)
        },
        updateDescription(e) {
            this.setDescription(e.target.value)
        },
        updateDescription_jp(e) {
            this.setDescription_jp(e.target.value)
        },
        updateContent(value) {
            this.setContent(value)
        },
        updateContent_jp(value) {
            this.setContent_jp(value)
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

        updateCode(e) {
            this.setCode(e.target.value)
        },
        updateName(e) {
            this.setName(e.target.value)
        },
        updateName_jp(e) {
            this.setName_jp(e.target.value)
        },
        updateKeyword(e) {
            this.setKeyword(e.target.value)
        },
        updateKeyword_jp(e) {
            this.setKeyword_jp(e.target.value)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'pages.index' })
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
