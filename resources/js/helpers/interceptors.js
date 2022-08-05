import axios from 'axios';
import store from '@store/store';
import router from '@routes/routes';

export default function setup() {
    axios.interceptors.response.use(function (response) {
        // Any status code that lie within the range of 2xx cause this function to trigger
        // Do something with response data
        // console.log(response);
        return response;
      }, function (error) {
        // Any status codes that falls outside the range of 2xx cause this function to trigger
        // Do something with response error
        if( error.response.status == 401)
        {
          document.cookie = 'XSRF-TOKEN=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
          store.commit('auth/SET_AUTHENTICATED',false);
          store.commit('auth/SET_USER',{});
          router.push({name:"login"});
        }
   
        if( error.response.status == 419)
        {
          document.cookie = 'XSRF-TOKEN=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
          store.commit('auth/SET_AUTHENTICATED',false);
          store.commit('auth/SET_USER',{});
          router.push({name:"login"});
        }
        return Promise.reject(error);
      });
}

