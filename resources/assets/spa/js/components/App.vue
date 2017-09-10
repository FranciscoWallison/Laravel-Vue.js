<template>
    <div id="app">
        <div class="preloader-background" v-if="loading" >
            <div class="preloader-wrapper small active">
              <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>

              <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>

              <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>

              <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
         </div>

        <header v-if="showMenu">
            <menu></menu>
        </header>
        
        <main>
           <router-view></router-view>  
        </main>

        <footer class="page-footer">
            <div class="footer-copyright">
                <div class="container">
                    {{ year }} - <a class="grey-text text-lighten-4" href="wallison">Francisco Wallison</a>
                </div>
            </div>
        </footer>
       
    </div>

</template>

<script type="text/javascript">
import MenuComponent from './Menu.vue';
//import Auth from '../services/auth';
import store from '../store'; 

    export default {
        components: {
            'menu': MenuComponent
        },
        created(){
            window.Vue.http.interceptors.unshift((request, next) => {
                this.loading = true;// se houver um requesição torna o loading true
                next(() => {                    
                    this.loading = false
                }); // depois de haver uam requesição seta o loadin a false
            });
        },
        data(){
            return {
                year: new Date().getFullYear(),               
                loading: true
            }
       },
        computed: {
            isAuth(){
              return store.state.check;
            },
            showMenu(){
                return this.isAuth && this.$router.name != 'auth.login';
            }
        }
    };
</script>

<style type="text/css">
    #app{
    display: flex;
    min-height: 100vh;
    flex-direction: column;
    }

    main {
        flex: 10 auto
    }
</style>