import axios from 'axios'
import router from '@routes/routes'

const actions = {
     login({commit},user){
        commit('SET_USER',user)
        commit('SET_AUTHENTICATED',true)
        router.push({name:'accounts'});
    },
    logout({commit}){
        commit('SET_USER',{})
        commit('SET_AUTHENTICATED',false)
    },
    setToken({commit},token)
    {
        commit('SET_TOKEN',token)
    }
}

export default actions