function initialState() {
    return {
        item: {
            id: null,
            title: null,
            title_jp: null,
            description: null,
            description_jp: null,
            content: null,
            content_jp: null,
            code: null,
            name: null,
            name_jp : null,
            keyword_:null,
            keywork_jp :null,
            keyword: null,
        },

        //stageEnum: [ { value: 'Locked', label: 'Locked' }, { value: 'Released', label: 'Released' }, { value: 'Blocked', label: 'Blocked' }, ],
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    //stageEnum: state => state.stageEnum,
    
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


            axios.post('/api/v1/pages', params)
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


            axios.post('/api/v1/pages/' + state.item.id, params)
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
        axios.get('/api/v1/pages/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        
    },
    
    setTitle({ commit }, value) {
        commit('setTitle', value)
    },
    setTitle_jp({ commit }, value) {
        commit('setTitle_jp', value)
    },
    setDescription({ commit }, value) {
        commit('setDescription', value)
    },
    setDescription_jp({ commit }, value) {
        commit('setDescription_jp', value)
    },
    setContent({ commit }, value) {
        commit('setContent', value)
    },
    setContent_jp({ commit }, value) {
        commit('setContent_jp', value)
    },
    setPicture({ commit }, value) {
        commit('setPicture', value)
    },

    setCode({ commit }, value) {
        commit('setCode', value)
    },
    setName({ commit }, value) {
        commit('setName', value)
    },
    setName_jp({ commit }, value) {
        commit('setName_jp', value)
    },
    setKeyword({ commit }, value) {
        commit('setKeyword', value)
    },
    setKeyword_jp({ commit }, value) {
        commit('setKeyword_jp', value)
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
    setTitle_jp(state, value) {
        state.item.title_jp = value
    },
    setDescription(state, value) {
        state.item.description = value
    },
    setDescription_jp(state, value) {
        state.item.description_jp = value
    },
    setContent(state, value) {
        state.item.content = value
    },
    setContent_jp(state, value) {
        state.item.content_jp = value
    },
    setPicture(state, value) {
        state.item.picture = value
    },
    setName(state, value) {
        state.item.name = value
    },
    setName_jp(state, value) {
        state.item.name_jp = value
    },
    setCode(state, value) {
        state.item.code = value
    },

    setKeyword(state, value) {
        state.item.keyword = value
    },
    setKeyword_jp(state, value) {
        state.item.keyword_jp = value
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
