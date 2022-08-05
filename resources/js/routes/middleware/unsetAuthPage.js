import store from '@store/store'

export default (to, from, next) => {
	store.commit('layout/SET_AUTH_PAGE',false);
	return
}