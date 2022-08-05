const getters = {
    authenticated(state){
        return state.authenticated
    },
    user(state){
        return state.user
    },
    token(state){
        return state.token
    }
}

export default getters