<template>
<div class="account-pages my-5 pt-sm-5">
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary"> Reset Password</h5>
                                <p>Reset Password with Infused.</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0"> 
                    <div>
                        <a href="/">
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                    <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                </span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="p-2">
                       	<form class="form-horizontal" v-on:submit.prevent="forgotPassword">
                           <div class="mb-3">                                
                                <label for="username" class="form-label">Email</label>                                
                                <input name="email" type="email" v-model="email"
                                class="form-control" v-bind:class="{ 'is-invalid': errEmail }"
                                autofocus>
                               
                                <span v-if="errEmail" class="invalid-feedback" role="alert">
                                    <strong>{{ errEmail }}</strong>
                                </span>

                            </div>

                            <div class="mt-3 d-grid">
                                <button class="btn btn-primary w-md waves-effect waves-light"
                                    type="submit">Reset</button>
                            </div>

                            <div class="mb-3">
                            	<div v-if="message" class="alert alert-success" role="alert">
	                                {{ message }}
	                            </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
            <div class="mt-5 text-center">
                <p>Remember It ? <router-link class="fw-medium text-primary" :to="{ name : 'login'}">Login here </router-link> </p>
                
            </div>

        </div>
    </div>
</div>
</div>
</template>
<script>
    import { mapActions } from 'vuex'
    export default {
        data(){
            return{
                email:'',
                errEmail : '',
                message : ''
            }
        },
        mounted(){
            this.setAuthPage();
        },
        methods : {
            ...mapActions({
                startLoader:'loader/startLoader',
                stopLoader:'loader/stopLoader',
                setAuthPage : 'layout/setAuthPage'
            }),
            forgotPassword(){

            	var self = this;

                this.startLoader();
                this.reset_errors();

                axios.post('/api/auth/forgot-password', {
                    email: this.email,
                    password: this.password
                }).then(response => {                    
                    this.message = response.data.message;
                    self.stopLoader();
                }).catch(error => {
                    self.stopLoader();
                    if( error.response.status == 422 )
                    {
                        let errors = error.response.data.errors;

                        if (errors.hasOwnProperty('email')) 
                        {
                            this.errEmail = error.response.data.errors.email[0];
                        }

                    }
                });
            },
            reset_errors()
            {
                this.errEmail = '';
            }
        }
    }
</script>