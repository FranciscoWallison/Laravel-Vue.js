<template>
    <ul :id="o.id" class="dropdown-content" v-for="o in config.menusDropdown">
        <li v-for="item in o.items" :class="menuItemClass(item)">
            <a :href="item.url">{{ item.name }}</a>
        </li>
    </ul>
    <ul id="dropdown-logout" class="dropdown-content">
        <li>
            <a :href="config.urlLogout" @click.prevent="goToLogout()">Sair</a>
            <form id="logout-form" :action="config.urlLogout" method="POST" style="display: none;">
                <input type="hidden" name="_token" :value="config.csrfToken" />
            </form>
        </li>
    </ul>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="/home" class="left brand-logo">SisFin. Admin</a>
                    <a href="#" data-activates="nav-mobile" class="button-collapse">
                        <i class="material-icons">menu</i>
                    </a>
                    <ul class="right hide-on-med-and-down">
                        <li v-for="o in config.menus" :class="menuItemClass(o)">
                            <a v-if="o.dropdownId" class="dropdown-button" href="!#" :data-activates="o.dropdownId">
                                {{ o.name }} <i class="material-icons right">arrow_drop_down</i>
                            </a>
                            <a v-else :href="o.url">{{ o.name }}</a>
                        </li>
                        <li>
                            <a class="dropdown-button" href="!#" data-activates="dropdown-logout">
                                {{ config.name }} <i class="material-icons right">arrow_drop_down</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul id="nav-mobile" class="side-nav">
                    <li v-for="o in config.menus">
                        <a :href="o.url"> {{ o.name }} </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script type="text/javascript">
    export default {
        props: {
            config: {
                type: Object,
                default() {
                    return {
                        nome: '',
                        menus: [],
                        menusDropdown: [],
                        urlLogout: '/admin/logout'
                    }
                }
            }
        },
        ready() {
            $('.button-collapse').sideNav();
            $('.dropdown-button').dropdown();
        },
        methods: {
            goToLogout() {
                $('#logout-form').submit();
            },
            // função para definir a class do menu se esta ativa ou não
            menuItemClass(menu){
                let menuClass = ['active'];
//console.log(menu.active, menu.name, menu.url , menu.dropdownId !== undefined ? 'sim' : 'não');
                if(menu.active){
                    return menuClass;
                }

                // condição para selecionar o dropdown correto
                if(menu.dropdownId !== undefined){

                    let dropdown = this.config.menusDropdown.find((element) => {
                        return element.id == menu.dropdownId;
                    });
                
                    if(dropdown){
                        for(let o of dropdown.items){
                            if(o.active){
                                return menuClass;
                            }
                        }
                    }

                }
            }
        }
    };
</script>