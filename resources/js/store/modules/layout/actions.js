const actions = {
    setAuthPage({commit}){
        commit('SET_AUTH_PAGE',true)
    },
    unsetAuthPage({commit}){
        commit('UNSET_AUTH_PAGE',false)
    }
}

export default actions