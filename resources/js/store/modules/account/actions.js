import axios from 'axios'
import router from '@routes/routes';

const actions = {
   setAccount({commit},data){
      commit('SET_ACCOUNT_ID',data.id);
      commit('SET_ACCOUNT',data);
      router.push({name:'dashboard'});
   },
   unSetAccount({commit}){
      commit('SET_ACCOUNT_ID',0);
      commit('SET_ACCOUNT',{});
   }
}

export default actions