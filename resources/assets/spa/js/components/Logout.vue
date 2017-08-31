<template> 
<div class="container">
    <div class="row">
        <div class="col s8 offset-s2 z-depth-2">
            <h5 class="center">Redirecionando ....</h5>
            <div class="progress">
                <div class="indeterminate"></div>
            </div>

        </div>
    </div>
</div>

	
</template>

<script type="text/javascript">
    import Auth from '../services/auth';
	export default{
        ready(){
            setTimeout(() => {
                this.logout();
            }, 1000);
        },
		methods: {
			logout(){
                let goToLogin = () => this.$router.go({name: 'authe.login'});
                Auth.logout()
                    .then( goToLogin() )
				    .catch( goToLogin() );
			}
		}
	}
</script>