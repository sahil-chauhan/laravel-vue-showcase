<template>
	<div class="vertical-menu">
	    <div data-simplebar class="h-100">

	        <!--- Sidemenu -->
	        <div id="sidebar-menu">
	            <!-- Left Menu Start -->
	            <ul class="metismenu list-unstyled" id="side-menu">               
	            	<li>
                        <router-link class="waves-effect" aria-expanded="false" :to="{ name: 'licenses', params: { account: account_id }}">
                            <i class="bx bx-key"></i>
                            <span key="t-chat">My Licenses</span>
                        </router-link>                        
                    </li>
                    <li>
                        <router-link class="waves-effect" aria-expanded="false" :to="{ name: 'downloads', params: { account: account_id }}">
                            <i class="bx bx-cloud-download"></i>
                            <span key="t-chat">Downloads</span>
                        </router-link> 
                    </li>
                    <li>
                        <router-link class="waves-effect" aria-expanded="false" :to="{ name: 'marketplace', params: { account: account_id }}">
                            <i class="bx bx-store-alt"></i>
                            <span key="t-chat">Marketplace</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link class="waves-effect" aria-expanded="false" :to="{ name: 'settings', params: { account: account_id }}">
                            <i class="bx bx-building"></i>
                            <span key="t-chat">Account Settings</span>
                        </router-link>                        
                    </li>
                    <li>
                        <router-link class="waves-effect" aria-expanded="false" :to="{ name: 'billing', params: { account: account_id }}">
                            <i class="bx bx-credit-card"></i>
                            <span key="t-chat">Billings</span>
                        </router-link>
                    </li>                    
                    <li class="menu-title" key="t-apps">APPS AND TOOLS</li>
                    <li>
                        <a href="#" class="waves-effect" aria-expanded="false">
                            <img src="/images/woo.png" alt="" height="20">
                            <span key="t-chat">InfusedWoo</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect" aria-expanded="false">
                            <img src="/images/rocket.png" alt="" height="20">
                            <span key="t-chat">Rocket One-Click</span>
                        </a>
                    </li>
	            </ul>
	        </div>
	        <!-- Sidebar -->
	    </div>
	</div>
</template>
<style scoped>
    a.router-link-exact-active {
        color: #ffff !important;
    }
</style>
<script>
    import {mapActions} from 'vuex'
    import { mapGetters } from 'vuex'
	export default{
        data(){
            return {
             
            }
        },
        computed: {
          ...mapGetters({
            user: 'auth/user',
            account_id : "account/account_id",
            account : "account/account"
          })
        },
        methods:{
          
        }
    }
</script>