<template>
	<div class="page-content">
	    <div class="container-fluid">
	    	<h1>Dashboard Component</h1>
	    </div>
	</div>
</template>
<script>
	import {mapActions} from 'vuex'
	import { mapGetters } from 'vuex'

	export default{
		data(){
			return{
				
			}
		},
		computed: {
		  ...mapGetters({
		    user: 'auth/user',
		    authenticated : "auth/authenticated",
		    loading : "loader/loading",
		    loadingOptions : "loader/loadingOptions",
		    account_id : "account/account_id",
		    account : "account/account"
		  })
		},
		mounted(){			
			
		},
		methods:{
		  ...mapActions({
		      	startLoader:'loader/startLoader',
            	stopLoader:'loader/stopLoader'
		  })
		}
	}
</script>