<template>
<div class="dropdown dropdown-mega d-none d-lg-block ms-2">
    <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
        <span key="t-megamenu">{{ account.name }}</span>
        <i class="mdi mdi-chevron-down"></i> 
    </button>
    <div class="dropdown-menu dropdown-megamenu">
        <div class="row">
            <div class="col-sm-8">

                <div class="row">
                    <div class="col-md-4">
                        <h5 class="font-size-14" key="t-ui-components">Accounts</h5>
                        <ul class="list-unstyled megamenu-list">
                            <li>
                                <a href="javascript:void(0);" key="t-lightbox">Lightbox</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" key="t-range-slider">Range Slider</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" key="t-sweet-alert">Sweet Alert</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" key="t-rating">Rating</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" key="t-forms">Forms</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" key="t-tables">Tables</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" key="t-charts">Charts</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>                            
        </div>

    </div>
</div>
</template>
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