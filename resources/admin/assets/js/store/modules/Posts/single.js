function initialState() {
    return {
        item: {
            id: null,
            title: null,
            summary: null,
            content: null,
            title_jp: null,
            summary_jp: null,
            content_jp: null,
            slug:null,
            picture: null,
            rating: null,
            viewer: null,
            stage: null,
            category: null,
            user: null,
            is_homepage: false,
        },
        categoriesAll: [],
        usersAll: [],
        stageEnum: [ { value: 'Locked', label: 'Locked' }, { value: 'Released', label: 'Released' }, { value: 'Blocked', label: 'Blocked' }, ],
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    categoriesAll: state => state.categoriesAll,
    usersAll: state => state.usersAll,
    stageEnum: state => state.stageEnum,
}

const actions = {
    storeData({ commit, state, dispatch }) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = new FormData();

            for (let fieldName in state.item) {
                let fieldValue = state.item[fieldName];
                if (typeof fieldValue !== 'object') {
                    params.set(fieldName, fieldValue);
                } else {
                    if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {
                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }

            if (state.item.picture === null) {
                params.delete('picture');
            }

            if (! _.isEmpty(state.item.stage) && typeof state.item.stage === 'object') {
                params.set('stage', state.item.stage.value)
            }
            if (_.isEmpty(state.item.category)) {
                params.set('category_id', '')
            } else {
                params.set('category_id', state.item.category.id)
            }
            if (_.isEmpty(state.item.user)) {
                params.set('user_id', '')
            } else {
                params.set('user_id', state.item.user.id)
            }
            params.set('is_homepage', state.item.is_homepage ? 1 : 0)

            axios.post('/api/v1/posts', params)
                .then(response => {
                    commit('resetState')
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors  = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        { message: message, errors: errors, color: 'danger' },
                        { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    updateData({ commit, state, dispatch }) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = new FormData();
            params.set('_method', 'PUT')

            for (let fieldName in state.item) {
                let fieldValue = state.item[fieldName];
                if (typeof fieldValue !== 'object') {
                    params.set(fieldName, fieldValue);
                } else {
                    if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {
                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }

            if (state.item.picture === null) {
                params.delete('picture');
            }

            if (! _.isEmpty(state.item.stage) && typeof state.item.stage === 'object') {
                params.set('stage', state.item.stage.value)
            }
            if (_.isEmpty(state.item.category)) {
                params.set('category_id', '')
            } else {
                params.set('category_id', state.item.category.id)
            }
            if (_.isEmpty(state.item.user)) {
                params.set('user_id', '')
            } else {
                params.set('user_id', state.item.user.id)
            }
            params.set('is_homepage', state.item.is_homepage ? 1 : 0)
            axios.post('/api/v1/posts/' + state.item.id, params)
                .then(response => {
                    commit('setItem', response.data.data)
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors  = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        { message: message, errors: errors, color: 'danger' },
                        { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    fetchData({ commit, dispatch }, id) {
        axios.get('/api/v1/posts/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        dispatch('fetchCategoriesAll')
    dispatch('fetchUsersAll')
    },
    fetchCategoriesAll({ commit }) {
        axios.get('/api/v1/categories')
            .then(response => {
                commit('setCategoriesAll', response.data.data)
            })
    },
    fetchUsersAll({ commit }) {
        axios.get('/api/v1/users')
            .then(response => {
                commit('setUsersAll', response.data.data)
            })
    },
    setTitle({ commit }, value) {
        commit('setTitle', value)
    },
    setSummary({ commit }, value) {
        commit('setSummary', value)
    },
    setContent({ commit }, value) {
        commit('setContent', value)
    },
    setTitleJP({ commit }, value) {
        commit('setTitleJP', value)
    },
    setSummaryJP({ commit }, value) {
        commit('setSummaryJP', value)
    },
    setContentJP({ commit }, value) {
        commit('setContentJP', value)
    },
    setPicture({ commit }, value) {
        commit('setPicture', value)
    },
    setSlug({ commit }, value) {
        commit('setSlug', value)
    },
    setRating({ commit }, value) {
        commit('setRating', value)
    },
    setViewer({ commit }, value) {
        commit('setViewer', value)
    },
    setStage({ commit }, value) {
        commit('setStage', value)
    },
    setCategory({ commit }, value) {
        commit('setCategory', value)
    },
    setUser({ commit }, value) {
        commit('setUser', value)
    },
    setIs_Homepage({ commit }, value) {
        commit('setIs_Homepage', value)
    },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setTitle(state, value) {
        state.item.title = value
    },
    setSummary(state, value) {
        state.item.summary = value
    },
    setContent(state, value) {
        state.item.content = value
    },
    setTitleJP(state, value) {
        state.item.title_jp = value
    },
    setSummaryJP(state, value) {
        state.item.summary_jp = value
    },
    setContentJP(state, value) {
        state.item.content_jp = value
    },
    setPicture(state, value) {
        state.item.picture = value
    },
    setSlug(state, value) {
        state.item.slug = value
    },

    setRating(state, value) {
        state.item.rating = value
    },
    setViewer(state, value) {
        state.item.viewer = value
    },
    setStage(state, value) {
        state.item.stage = value
    },
    setCategory(state, value) {
        state.item.category = value
    },
    setUser(state, value) {
        state.item.user = value
    },
    setCategoriesAll(state, value) {
        state.categoriesAll = value
    },
    setUsersAll(state, value) {
        state.usersAll = value
    },
    setStageEnum(state, value) {
        state.stageEnum = value
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    setIs_Homepage(state, value) {
        state.item.is_homepage = value
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
