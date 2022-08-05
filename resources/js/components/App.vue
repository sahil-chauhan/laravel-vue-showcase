<template>
	<div>
		<!-- Dashboard Views -->
		<div id="layout-wrapper" v-if="authPage == false">
			<Header ></Header>
	        <VerticalMenu></VerticalMenu>
	        <div class="main-content">
	        	<router-view></router-view>
	        </div>
		</div>
		<!-- Auth Views -->
		<div v-if="authPage">
			<router-view></router-view>
		</div>
		<!-- Global Loader -->
		<loading  :active="loading"
                :is-full-page="loadingOptions.fullPage"
                :can-cancel="loadingOptions.canCancel"
                :color="loadingOptions.color"
                :width="loadingOptions.width"
                :height="loadingOptions.height"
                :loader="loadingOptions.loader"
                :on-cancel="onCancel"/>
	</div>
</template>

<script>
	import Header from './includes/Header'
	import VerticalMenu from './includes/VerticalMenu'
	
	import {mapActions} from 'vuex'
	import { mapGetters } from 'vuex'
	import Loading from 'vue-loading-overlay'
	import 'vue-loading-overlay/dist/vue-loading.css'


	export default {
		data(){
		    return {
		     
		    }
		},
		computed: {
		  ...mapGetters({
		    user: 'auth/user',
		    authenticated : "auth/authenticated",
		    loading : "loader/loading",
		    loadingOptions : "loader/loadingOptions",
		    authPage : "layout/authPage"
		  })
		},
		mounted()
		{
		},
		components: {
		    Loading,
		    Header,
		    VerticalMenu
		},
		methods:{
		  ...mapActions({
		      signOut:"auth/logout"
		  }),
		  async logout(){
		      await axios.post('/api/auth/logout').then(({data})=>{
		          this.signOut()
		          this.$router.push({name:"login"})
		      })
		  },
		    onCancel() {
		        console.log('User cancelled the loader.')
		    }
		} 
	}
</script>