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
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p>Sign in to continue to Infused Addons.</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0"> 
                        <div class="auth-logo">
                            <a href="#" class="auth-logo-light">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="assets/images/logo-light.svg" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>

                            <a href="#" class="auth-logo-dark">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form class="form-horizontal" v-on:submit.prevent="submitLogin">

                                <div class="mb-3">
                                        
                                    <label for="username" class="form-label">Email</label>
                                    
                                    <input name="email" type="email" v-model="email"
                                    class="form-control" v-bind:class="{ 'is-invalid': errEmail }"
                                    autofocus>
                                   
                                    <span v-if="errEmail" class="invalid-feedback" role="alert">
                                        <strong>{{ errEmail }}</strong>
                                    </span>

                                </div>

                                <div class="mb-3">
                                        
                                    <label for="password" class="form-label">Password</label>
                                    
                                    <input id="password" name="password" type="password" v-model="password"
                                    class="form-control" v-bind:class="{ 'is-invalid': errPass }" >
                                    
                                    <span class="invalid-feedback" role="alert" v-if="errPass">
                                        <strong>{{ errPass }}</strong>
                                    </span>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                    <label class="form-check-label" for="remember-check">
                                        Remember me
                                    </label>
                                </div>
                                
                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                </div>

                                <div class="mt-3 d-grid">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="failed">
                                        {{ failed }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-center">
                                    <h5 class="font-size-14 mb-3">Sign in with</h5>

                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a @click="AuthProvider('github')" href="#" class="social-list-item bg-primary text-white border-primary">
                                                <i class="mdi mdi-github"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a @click="AuthProvider('linkedin')" href="#" class="social-list-item bg-info text-white border-info">
                                                <i class="mdi mdi-linkedin"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="" class="social-list-item bg-danger text-white border-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-4 text-center">
                                    <router-link :to="{name:'ForgotPassword'}" class="text-muted">
                                        <i class="mdi mdi-lock me-1"></i> Forgot your password?
                                    </router-link>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    
                    <div>
                        <p>Don't have an account ? <router-link class="fw-medium text-primary" :to="{ name : 'register'}">Signup now </router-link></p> </p>
                        
                    </div>
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
                password:'',
                errEmail:'',
                errPass:'',
                failed : ''                
            }
        },
        mounted(){
            this.setAuthPage();
        },
        methods: {
            ...mapActions({
                signIn:'auth/login',
                startLoader:'loader/startLoader',
                stopLoader:'loader/stopLoader',
                setAuthPage : 'layout/setAuthPage',
                setToken : 'auth/setToken'
            }),
            async submitLogin() {
                // init loader...
                this.startLoader()

                this.errEmail = this.errPass = '';            
                await axios.get('/sanctum/csrf-cookie')
                
                await  axios.post('/api/auth/login', {
                    email: this.email,
                    password: this.password
                }).then(response => {                    
                    this.setToken(response.data.token);
                    this.signIn(response.data.user);  
                    this.stopLoader()                 
                }).catch(error => {
                    this.stopLoader()
                    this.process_errors(error.response.data.errors,error.response.status);
                });
            },
            AuthProvider(provider) {

              this.startLoader()

              var self = this

              this.$auth.authenticate(provider).then(response =>{

                self.SocialLogin(provider,response)

                }).catch(err => {
                    this.stopLoader()    
                    console.log({err:err})
                })

            },
            async SocialLogin(provider,response){

                this.startLoader()

                await axios.get('/sanctum/csrf-cookie')
                await axios.post('/api/auth/social/login/callback',{
                    code : response.code,
                    provider : provider
                }).then(response => {  
                    this.setToken(response.data.token);                  
                    this.signIn(response.data.user);
                    this.stopLoader()       
                }).catch(error => {                    
                    this.stopLoader(); 
                    this.process_errors(error.response.data.errors,error.response.status);
                });
            },
            process_errors(errors,code)
            {
                if( code == 422 )
                {
                  
                    if (errors.hasOwnProperty('email')) 
                    {
                        this.errEmail = errors.email[0];
                    }

                    if (errors.hasOwnProperty('password')) 
                    {
                        this.errPass = errors.password[0];
                    }

                    if (errors.hasOwnProperty('failed')) 
                    {
                        this.failed = errors.failed[0];
                    }
                }
            }
        }
    }
</script>