<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Deshboard </div>

                    <div class="panel-body">
                        Conteudo
                    </div>
                </div>
            </div>
            <button type="button" @click="updateUser">Atulizar usuário</button>
            {{user.name}}
        </div>
    </div>
</template>

<script>
    import store from '../store';   

    export default {
        computed:{
            user(){
                return store.state.user;
            }
        },
        methods: {
            updateUser(){
                store.commit('setUser',{name: 'Wallison'});
            }
       }
    }
</script>
