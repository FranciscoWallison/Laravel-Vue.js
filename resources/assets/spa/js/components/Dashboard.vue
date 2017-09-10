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
            {{user}}
        </div>
    </div>
</template>

<script>
    import store from '../store';   

    export default {
        components:{
            user(){
               return this.convetUset();
            }
       },
       methods: {
            convetUset(){
                console.log( JSON.parse( store.state.user ) , 'aqui');
            }
       }
    }
</script>
