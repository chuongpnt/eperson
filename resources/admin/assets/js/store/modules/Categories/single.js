function initialState() {
    return {
        item: {
            id: null,
            title: null,
            title_jp: null,
            summary: null,
            summary_jp:null,
            logo: null,
            is_enable: true,
            parent: null,
        },
        categoriesAll: [],
        
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    categoriesAll: state => state.categoriesAll,
    
}

const actions = {
    storeData({ commit, state, dispatch }) { console.log(state);
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

            if (state.item.logo === null) {
                params.delete('logo');
            }
            params.set('is_enable', state.item.is_enable ? 1 : 0)
            if (_.isEmpty(state.item.parent)) {
                params.set('parent_id', '')
            } else {
                params.set('parent_id', state.item.parent.id)
            }

            axios.post('/api/v1/categories', params)
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

            if (state.item.logo === null) {
                params.delete('logo');
            }
            params.set('is_enable', state.item.is_enable ? 1 : 0)
            if (_.isEmpty(state.item.parent)) {
                params.set('parent_id', '')
            } else {
                params.set('parent_id', state.item.parent.id)
            }

            axios.post('/api/v1/categories/' + state.item.id, params)
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
        axios.get('/api/v1/categories/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        dispatch('fetchCategoriesAll')
    },
    fetchCategoriesAll({ commit }) {
        axios.get('/api/v1/categories')
            .then(response => {
                commit('setCategoriesAll', response.data.data)
            })
    },
    setTitle({ commit }, value) {
        commit('setTitle', value)
    },
    setTitleJP({ commit }, value) {
        commit('setTitleJP', value)
    },
    setSummary({ commit }, value) {
        commit('setSummary', value)
    },
    setSummaryJP({ commit }, value) {
        commit('setSummaryJP', value)
    },
    setLogo({ commit }, value) {
        commit('setLogo', value)
    },
    
    setIs_enable({ commit }, value) {
        commit('setIs_enable', value)
    },
    setParent({ commit }, value) {
        commit('setParent', value)
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
    setTitleJP(state, value) {
        state.item.title_jp = value
    },

    setSummary(state, value) {
        state.item.summary = value
    },

    setSummaryJP(state, value) {
        state.item.summary_jp = value
    },

    setLogo(state, value) {
        state.item.logo = value
    },
    setIs_enable(state, value) {
        state.item.is_enable = value
    },
    setParent(state, value) {
        state.item.parent = value
    },
    setCategoriesAll(state, value) {
        state.categoriesAll = value
    },
    
    setLoading(state, loading) {
        state.loading = loading
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
