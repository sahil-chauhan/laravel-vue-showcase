const actions = {
    startLoader({commit}){
        commit('SET_LOADING',true)
    },
    stopLoader({commit}){
        commit('SET_LOADING',false)
    },
    setLoadingOptions({commit},data)
    {
        commit('SET_LOADING_OPTIONS',data)
    } 
}

export default actions