const mutations = {
    SET_AUTHENTICATED (state, value) {
        state.authenticated = value
    },
    SET_USER (state, value) {
        state.user = value
    },
    SET_TOKEN(state, value){
        state.token = value
    }
}

export default mutations
