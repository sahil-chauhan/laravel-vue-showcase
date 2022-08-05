<template>
	<div class="account-pages my-5 pt-sm-5">
    	<div class="container">
        	<div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card border border-pink">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary text-center"><i class="mdi mdi-bullseye-arrow me-3"></i>Choose Your Account</h5>
                        </div>
                        <div class="card-body">

                            <div class="col-lg-12" v-for="account in accounts" :key="account.id">
                                <div class="card border border-success">                                    
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="formRadios" :id="account.id" v-model="account_id" :value="account.id">
                                            <label class="form-check-label" :for="account.id">
                                                {{ account.name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                
                                <button class="btn btn-pink" @click="ChooseAccount()">Next</button>

                                <div class="mt-3 d-grid col-md-6 offset-3">
                                    <div class="alert alert-danger  fade show" role="alert" v-if="failed">
                                        {{ failed }}                                        
                                    </div>
                                </div>
                            
                            </div>
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
            return{
                account_id :0,
                accounts : {},
                failed : ''
            }
        },
        computed: {
          ...mapGetters({
            user: 'auth/user'
          })
        },
        mounted(){
            this.setAuthPage();
            this.load_user_accounts();
        },
        methods: {
            ...mapActions({
                setAuthPage : 'layout/setAuthPage',
                startLoader:'loader/startLoader',
                stopLoader:'loader/stopLoader',
                setAccount: 'account/setAccount'
            }),
            async load_user_accounts()
            {
                this.startLoader()
                axios.post('/api/accounts/all',{user_id : this.user.id}).then(response => {                   
                    this.stopLoader() 
                    this.accounts = response.data.accounts      
                }).catch(error => {                    
                    this.stopLoader() 
                });

            },
            ChooseAccount()
            {
                this.failed = ''; 

                var self = this;

                if( this.account_id == 0 )
                {
                    this.failed = 'Please choose an account to login.';
                    return;
                }

                const account = this.accounts.filter(account => account.id == self.account_id );
                if( account.length )
                {
                    this.setAccount(account[0]);
                }
               
            }
        }
	}
</script>