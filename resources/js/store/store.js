import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

import auth from './modules/auth'
import loader from './modules/loader'
import layout from './modules/layout'
import account from './modules/account'


Vue.use(Vuex)
Vue.use(createPersistedState)



export default new Vuex.Store({
    modules: {
        auth: auth,
        loader : loader,
        layout : layout,
        account : account
    },
    plugins: [
        createPersistedState({
            key: 'persistedstate'
        })
    ]
})