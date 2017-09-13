<template>
    <ul :id="o.id" class="dropdown-content" v-for="o in menusDropdown">
        <li v-for="item in o.items">
            <a v-link="{name: item.routeName}">{{ item.name }}</a>
        </li>
    </ul>
    <ul id="dropdown-logout" class="dropdown-content">
        <li>
            <a v-link="{name: 'auth.logout'}">Sair</a>
        </li>
    </ul>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="#" class="left brand-logo">Aplicação VUE.JS</a>
                    <a href="#" data-activates="nav-mobile" class="button-collapse">
                        <i class="material-icons">menu</i>
                    </a>
                    <ul class="right hide-on-med-and-down">
                        <li v-for="o in menus">
                            <a v-if="o.dropdownId" class="dropdown-button" href="!#" :data-activates="o.dropdownId">
                                {{ o.name }} <i class="material-icons right">arrow_drop_down</i>
                            </a>
                            <a v-else v-link="{name: o.url}">{{ o.name }}</a>
                        </li>
                        <li>
                            <a class="dropdown-button" href="!#" data-activates="dropdown-logout">
                                {{ name }} <i class="material-icons right">arrow_drop_down</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul id="nav-mobile" class="side-nav">
                    <li v-for="o in menus">
                        <a v-link="{name: o.url}"> {{ o.name }} </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script type="text/javascript">
   import store from '../store/store';

    export default {
        data(){
            return {
                menus:[
                    {
                        name: 'Dashboard',
                        routeName: 'dashboard'
                    },
                    {
                        name: 'Conta bancária', 
                        routeName: 'bank-account.list',
                        url: 'bank-account.list'
                    },
                    {
                        name: 'Plano de Contas', 
                        routeName: 'plan-account.list',
                        url: 'plan-account.list'
                    },
                    {
                        name: 'Contas', 
                        dropdownId: 'bills-dropdown'
                    },
                ],
                menusDropdown:[
                    {
                        id: 'bills-dropdown',
                        items: [
                            {name: "Contas a pagar", routeName: 'bill-pay.list'},
                            {name: "Contas a receber", routeName: 'bill-receive.list'},
                        ]
                    },
                ]              
            }
        },
        computed:{
            name(){                
               let user = store.state.auth.user;
               return user ? user.name : '';
            }
        },
        ready() {
            $('.button-collapse').sideNav();
            $('.dropdown-button').dropdown();
        }
    };
</script>