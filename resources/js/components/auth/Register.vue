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
                                    <h5 class="text-primary">Free Register</h5>
                                    <p>Get your free Infused account.</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0"> 
                        <div>
                            <a href="index.html">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form class="needs-validation" v-on:submit.prevent="register">
    
                                <div class="mb-3">                                        
                                    <label for="name" class="form-label">Name</label>                                    
                                    <input id="name" v-model="user.name" class="form-control" v-bind:class="{ 'is-invalid': errors.name }" autofocus>                                   
                                    <span v-if="errors.name" class="invalid-feedback" role="alert">
                                        <strong>{{ errors.name }}</strong>
                                    </span>
                                </div>

                                <div class="mb-3">                                        
                                    <label for="email" class="form-label">Email Address</label>                                    
                                    <input id="email" v-model="user.email" class="form-control" v-bind:class="{ 'is-invalid': errors.email }">                                   
                                    <span v-if="errors.name" class="invalid-feedback" role="alert">
                                        <strong>{{ errors.email }}</strong>
                                    </span>
                                </div>

                                <div class="mb-3">                                        
                                    <label for="password" class="form-label">Password</label>                                    
                                    <input type="password" id="password" v-model="user.password" class="form-control" v-bind:class="{ 'is-invalid': errors.password }">                                   
                                    <span v-if="errors.password" class="invalid-feedback" role="alert">
                                        <strong>{{ errors.password }}</strong>
                                    </span>
                                </div>

                                <div class="mb-3">                                        
                                    <label for="password_confirmation" class="form-label">Password Confirmation</label>                                    
                                    <input type="password" id="password_confirmation" v-model="user.password_confirmation" class="form-control" v-bind:class="{ 'is-invalid': errors.password_confirmation }">                                   
                                    <span v-if="errors.password_confirmation" class="invalid-feedback" role="alert">
                                        <strong>{{ errors.password_confirmation }}</strong>
                                    </span>
                                </div>
        
                                
            
                                <div class="mt-4 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Register</button>
                                </div>

                                <div class="mt-4 text-center">
                                    <h5 class="font-size-14 mb-3">Sign up using</h5>
    
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="#" class="social-list-item bg-primary text-white border-primary" @click="AuthProvider('github')">
                                                <i class="mdi mdi-github"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="social-list-item bg-info text-white border-info" @click="AuthProvider('linkedin')">
                                                <i class="mdi mdi-linkedin"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="social-list-item bg-danger text-white border-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
        
                                <div class="mt-4 text-center">
                                    <p class="mb-0">By registering you agree to the Skote <a href="#" class="text-primary">Terms of Use</a></p>
                                </div>
                            </form>
                        </div>
    
                    </div>
                </div>
                <div class="mt-5 text-center">
                    
                    <div>
                        <p>Already have an account ? <router-link class="fw-medium text-primary" :to="{ name : 'login'}">Login here </router-link> </p>
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
        data()
        {
            return{
                user : {
                    name : '',
                    email : '',
                    password : '',
                    password_confirmation : ''
                },
                errors : {
                    name : '',
                    email : '',
                    password : '',
                    password_confirmation : ''
                }
            }
        },
        mounted() {
            this.setAuthPage();
        },
        methods:{
            ...mapActions({
                signIn:'auth/login',
                startLoader:'loader/startLoader',
                stopLoader:'loader/stopLoader',
                setAuthPage : 'layout/setAuthPage',
                setToken : 'auth/setToken'             
            }),
            async register(){
                this.startLoader();

                await axios.get('/sanctum/csrf-cookie')
                await axios.post('/api/auth/register',this.user).then(response=>{
                    this.setToken(response.data.token);
                    this.signIn(response.data.user);
                    this.stopLoader();
                }).catch(error => {
                    this.stopLoader();
                    this.process_errors(error.response.data.errors,error.response.status);
                }).finally(()=>{
                    this.stopLoader();
                })
            },
            AuthProvider(provider) {
                this.startLoader();
                var self = this
                this.$auth.authenticate(provider).then(response =>{
                    self.SocialRegister(provider,response)
                }).catch(err => {
                    this.stopLoader();
                    console.log({err:err})
                }) 
            },
            async SocialRegister(provider,response){
                await axios.get('/sanctum/csrf-cookie')
                await axios.post('/api/auth/social/register/callback',{
                    code : response.code,
                    provider : provider
                }).then(response=>{
                    this.setToken(response.data.token);
                    this.signIn(response.data.user);
                    this.stopLoader()
                }).catch(error => {
                    this.stopLoader()
                    this.process_errors(error.response.data.errors,error.response.status);
                }).finally(()=>{
                    this.stopLoader()
                })
            },
            process_errors(errors,code)
            {
                if (errors.hasOwnProperty('name')) 
                {
                    this.errors.name = errors.name[0];
                }

                if (errors.hasOwnProperty('email')) 
                {
                    this.errors.email = errors.email[0];
                }

                if (errors.hasOwnProperty('password')) 
                {
                    this.errors.password = errors.password[0];
                }

                if (errors.hasOwnProperty('password_confirmation')) 
                {
                    this.errors.password_confirmation = errors.password_confirmation[0];
                }
            }
        }
    }
</script>	