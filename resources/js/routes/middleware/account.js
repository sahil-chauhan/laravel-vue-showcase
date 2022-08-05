import store from '@store/store'

export default (to, from, next) => {
	if( !store.state.account.account_id )
	{
		next({ name: 'accounts' })
		return
	}
}