import store from '@store/store'

export default (to, from, next) => {
	if( store.state.auth.authenticated )
	{
		next({ name: 'dashboard' })
		return
	}
}