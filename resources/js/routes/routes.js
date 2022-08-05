import Vue from 'vue'
import VueRouter from 'vue-router'

import store from '@store/store'

Vue.use(VueRouter)

import VueRouteMiddleware from 'vue-route-middleware'
import Auth from './middleware/auth'
import Guest from './middleware/guest'
import Account from './middleware/account'
import unsetAuthPage from './middleware/unsetAuthPage'

import App from '@components/App'

import Login from '@components/auth/Login'
import Register from '@components/auth/Register'
import ForgotPassword from '@components/auth/ForgotPassword'
import ResetPassword from '@components/auth/ResetPassword'

import Dashboard from '@components/Dashboard'
import Accounts from '@components/accounts/Accounts'
import Licenses from '@components/accounts/Licenses'
import Downloads from '@components/accounts/Downloads'
import Marketplace from '@components/accounts/Marketplace'
import Settings from '@components/accounts/Settings'
import Billing from '@components/accounts/Billing'

import UserSettings from '@components/user/UserSettings'




const Routes = [
    { path: '/', component: Dashboard, name:'dashboard',meta: { middleware: [ 'Auth' ,'Account','unsetAuthPage' ] } },

    { path: '/login', component: Login, name:'login',meta: { middleware: [ 'Guest' ] }},
    { path: '/register', component: Register, name:'register',meta: { middleware: [ 'Guest' ] }},
    { path: '/forgot-password', component: ForgotPassword, name:'ForgotPassword',meta: { middleware: [ 'Guest' ] }},
    { path: '/reset-password/:token', component: ResetPassword, name:'ResetPassword',meta: { middleware: [ 'Guest' ] }},

    { path: '/accounts', component: Accounts, name:'accounts',meta: { middleware: [ 'Auth'] } },
    { path: '/account/:account/licenses', component: Licenses, name:'licenses',meta: { middleware: [ 'Auth' ,'Account','unsetAuthPage' ] } },
    { path: '/account/:account/downloads', component: Downloads, name:'downloads',meta: { middleware: [ 'Auth' ,'Account','unsetAuthPage' ] } },
    { path: '/account/:account/marketplace', component: Marketplace, name:'marketplace',meta: { middleware: [ 'Auth' ,'Account','unsetAuthPage' ] } },
    { path: '/account/:account/settings', component: Settings, name:'settings',meta: { middleware: [ 'Auth' ,'Account','unsetAuthPage' ] } },
    { path: '/account/:account/billing', component: Billing, name:'billing',meta: { middleware: [ 'Auth' ,'Account','unsetAuthPage' ] } },

    { path: '/user/settings', component: UserSettings, name:'usersettings',meta: { middleware: [ 'Auth' ,'Account','unsetAuthPage' ] } }

];



var router  = new VueRouter({
    mode: 'history',
    routes: Routes
})

router.beforeEach(VueRouteMiddleware({ Auth,Guest,Account,unsetAuthPage }));


export default router