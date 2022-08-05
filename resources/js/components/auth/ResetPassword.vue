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
                                        <h5 class="text-primary"> Update Password</h5>
                                        <p>Update Password with Infused.</p>
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
                               
                                <form class="form-horizontal" v-on:submit.prevent="resetPassword">
                                   
                                   <div class="mb-3">
                                
                                        <label for="email" class="form-label">Email</label>
                                        
                                        <input  type="email" v-model="user.email"
                                        class="form-control" v-bind:class="{ 'is-invalid': errors.email }"
                                        autofocus>
                                       
                                        <span v-if="errors.email" class="invalid-feedback" role="alert">
                                            <strong>{{ errors.email }}</strong>
                                        </span>

                                    </div>

                                    <div class="mb-3">
                                        
                                        <label for="password" class="form-label">Password</label>
                                        
                                        <input  type="password" v-model="user.password"
                                        class="form-control" v-bind:class="{ 'is-invalid': errors.password }"
                                        >
                                       
                                        <span v-if="errors.password" class="invalid-feedback" role="alert">
                                            <strong>{{ errors.password }}</strong>
                                        </span>

                                    </div>

                                    <div class="mb-3">
                                        
                                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                        
                                        <input  type="password" v-model="user.password_confirmation"
                                        class="form-control" v-bind:class="{ 'is-invalid': errors.password_confirmation }"
                                        >
                                       
                                        <span v-if="errors.password_confirmation" class="invalid-feedback" role="alert">
                                            <strong>{{ errors.password_confirmation }}</strong>
                                        </span>

                                    </div>

                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Reset</button>
                                    </div>
                                      
                                    <div class="mt-3 d-grid">
                                        <div v-if="message" class="alert alert-success" role="alert">
                                            {{ message }}
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Remember It ? <router-link class="fw-medium text-primary" :to="{ name : 'login'}">Login </router-link> </p>
                        
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
                    email : this.$route.query.email,
                    password : '',
                    password_confirmation : '',
                    token : this.$route.params.token
                },
                errors : {
                    email : '',
                    password: '',
                    password_confirmation : ''
                },
                message : ''
            }
        },
        mounted() {
            this.setAuthPage();
        },
        methods : {
            ...mapActions({
                startLoader:'loader/startLoader',
                stopLoader:'loader/stopLoader',
                setAuthPage : 'layout/setAuthPage'
            }),
            resetPassword(){
                this.startLoader();
                this.reset_errors();

                axios.post('/api/auth/reset-password',this.user).then(response => {                    
                    this.message = response.data.message;
                    this.reset_form(); 
                    this.stopLoader();                   
                }).catch(error => {
                    this.stopLoader();
                    if( error.response.status == 422 )
                    {
                        let errors = error.response.data.errors;

                        if (errors.hasOwnProperty('email')) 
                        {
                            this.errors.email = error.response.data.errors.email[0];
                        }

                        if (errors.hasOwnProperty('password')) 
                        {
                            this.errors.password = error.response.data.errors.password[0];
                        }

                        if (errors.hasOwnProperty('password_confirmation')) 
                        {
                            this.errors.password_confirmation = error.response.data.errors.password_confirmation[0];
                        }

                    }
                });
            },
            reset_errors()
            {
                this.errors  = {
                    email : '',
                    password: '',
                    password_confirmation : ''
                }
            },
            reset_form()
            {
                this.user =  {
                    email : '',
                    password : '',
                    password_confirmation : '',
                    token : this.$route.params.token
                }
            }
        }
    }
</script>