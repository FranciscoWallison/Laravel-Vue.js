<template> 
<div class="container">
    <div class="row">     
        <div class="card-panel col s8 offset-s2 z-depth-2">
            <h3 class="center">SisFin</h3>

            <div class="row" v-if="error.error">
                <div class="col s12">
                    <div class="card-panel red">
                        <span class="whit-text">
                            {{ error.message }}
                        </span>
                    </div>
                </div>
            </div>

            <form method="POST" @submit.prevent="login()">
                <div class="row">
                    <div class="input-field col s12">
                        
                        <input id="email" type="email" class="validate" name="email" v-model="user.email" required autofocus>
                        <label for="email" class="active">E-Mail</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">                        
                        <input id="password" type="password" class="validate" name="password"  v-model="user.password" required>
                        <label for="password"> Senha </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn">Login</button>                       
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

	
</template>

<script type="text/javascript">
    import store from '../store/store'; 

	export default{
		data(){
			return {
				user: {
					email: '',
					password: ''
				},
                error: {
                    error: false,
                    message: ''
                }                
			}
		},
        created(){
           let statusUser = store.state.auth.check;
           if(statusUser){
                this.$router.go({name: 'dashboard'});
           }
        },
		methods: {
			login(){               
                store.dispatch('auth/login', this.user)
                    .then(() => this.$router.go({name: 'dashboard'}))
                    .catch((resposeError) => {

                        switch ( resposeError.status ){
                            case 401:
                                this.error.message = resposeError.data.message;
                                break;
                            default:
                               this.error.message = "Login ou senha está incorreto"; 
                        }

                        this.error.error = true;
                        
                    });
                //Auth.login(this.user.email, this.user.password)
                    
			}
		}
	}
</script>