<template>
    <form name="form" method="get" @submit.prevent="submit()">
        <div class="filter-group">
            <button class="btn waves-effect" type="submit">
                <i class="material-icons">search</i>
            </button>
            <div class="filter-wrapper">
                <input type="text" v-model="model" placeholder="O que procura?"/>
            </div>
        </div>
    </form>
</template>

<script>
    export default{
        props:{
            model: {
                required: true,
                type: String,
            }
        },
        methods:{
            submit(){
                this.$emit('on-submit'); // passa a configuração para o componente e que despulte a acção do componente pai
            }
        }
    }
</script>
