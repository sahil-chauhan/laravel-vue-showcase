<template>
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <router-link :to="{ name: 'dashboard'}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="/images/infused-logo.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="/images/infused-logo.png" alt="" height="17">
                        </span>
                    </router-link> 
                    <router-link :to="{ name: 'dashboard'}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="/images/infused-logo.png" alt="" height="10">
                        </span>
                        <span class="logo-lg">
                            <img src="/images/infused-logo.png" alt="" height="31">
                        </span>
                    </router-link> 
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <AccountsDropdown></AccountsDropdown>
                
            </div>

            <div class="d-flex">

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="d-inline-block">

                    <button type="button" class="btn header-item waves-effect" @click.prevent="redirectToSupport()">
                        <i class="bx bx-help-circle helpStyling"></i>
                    </button>                    
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="/assets/images/users/avatar-1.jpg"
                            alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ user.name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">

                        <router-link :to="{name:'usersettings'}" class="dropdown-item d-block">
                            <i class="bx bx-wrench font-size-16 align-middle me-1"></i> 
                            <span key="t-settings">Settings</span>
                        </router-link>
                        
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#" @click.prevent="logout">
                            <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> 
                            <span key="t-logout">Logout</span>
                        </a>
                    </div>
                </div>

              

            </div>
        </div>
    </header>
</template>
<style scoped>
    .helpStyling{
        font-size: 32px;
        color: black;
    }
</style>
<script>
    import {mapActions} from 'vuex'
    import { mapGetters } from 'vuex'
    import AccountsDropdown from '@components/accounts/AccountsDropdown';

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
        components: {
            AccountsDropdown
        },
        methods:{
            ...mapActions({
                signOut:"auth/logout",
                unSetAccount:"account/unSetAccount"
            }),
            async logout(){
              await axios.post('/api/auth/logout').then(({data})=>{
                  this.unSetAccount()
                  this.signOut()
                  this.$router.push({name:"login"})
              })
            },
            redirectToSupport()
            {
                window.open("https://support.infusedaddons.com");
            }
        }
    }
</script>