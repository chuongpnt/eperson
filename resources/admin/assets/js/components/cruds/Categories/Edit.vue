<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Categories</h1>
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
                                            placeholder="Enter Summary JP"
                                            :value="item.summary_jp"
                                            @input="updateSummaryJP"
                                            >
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input
                                            type="file"
                                            class="form-control"
                                            @change="updateLogo"
                                    >
                                    <ul v-if="item.logo" class="list-unstyled">
                                        <li>
                                            {{ item.logo.name || item.logo.file_name }}
                                            <button class="btn btn-xs btn-danger"
                                                    type="button"
                                                    @click="removeLogo"
                                            >
                                                Remove file
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input
                                                    type="checkbox"
                                                    name="is_enable"
                                                    :value="item.is_enable"
                                                    :checked="item.is_enable == true"
                                                    @change="updateIs_enable"
                                                    >
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="parent">Root category</label>
                                    <v-select
                                            name="parent"
                                            label="title"
                                            @input="updateParent"
                                            :value="item.parent"
                                            :options="categoriesAll"
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
        ...mapGetters('CategoriesSingle', ['item', 'loading', 'categoriesAll']),
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
        ...mapActions('CategoriesSingle', ['fetchData', 'updateData', 'resetState', 'setTitle', 'setSummary', 'setLogo', 'setIs_enable', 'setParent' ,'setTitleJP' , 'setSummaryJP']),
        updateTitle(e) {
            this.setTitle(e.target.value)
        },
        updateSummary(e) {
            this.setSummary(e.target.value)
        },
        updateTitleJP(e) {
            this.setTitleJP(e.target.value)
        },
        updateSummaryJP(e) {
            this.setSummaryJP(e.target.value)
        },
        removeLogo(e, id) {
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
                    this.setLogo('');
                }
            })
        },
        updateLogo(e) {
            this.setLogo(e.target.files[0]);
            this.$forceUpdate();
        },
        updateIs_enable(e) {
            this.setIs_enable(e.target.checked)
        },
        updateParent(value) {
            this.setParent(value)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'categories.index' })
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
