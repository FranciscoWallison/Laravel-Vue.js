## Oques é SaaS?
1 Significa Software como serviço
2 Ambiente ComPatilhado.
3 Customizações por Cliente
4 Atentimento a vários clientes
5 Precisa de arquitetura multe-tenancy.
6 Ideal em cloud server

## O que é multi-tenancy?
1 Tenancy Significada: Locação Arrendamento
2 Em ti: Inquilino
3 Vários Clientes Por Aplicação
4 Aplicavel quando aplicação vira um produto
5 Clientes Compartilham Estrutua
6 Escopo do Multi-Tenancy: Usuário, Empresas, Etc.
7 Isolar as Unformações Logicamente
8 Falha de um cliente não pode afetar em outro

## Qual Modelo Utilizar?
1 Não há Verdade do Universo
2 Enternder o Contexto que Será Aplicado
3 Entender as Customizações
4 Númemos de Usuários
5 Recursos a Serem Utilizados

#### MODELOS DE IMPLEMENTAÇÃO

## TIPO (Tudo isolado (container, hadware, banco de dados))
1 Alto nivel de segurança
2 Alto consumo de hardware
3 Monitoramento Individual

## TIPO (Conatiner compartilhado, banco de dados diferente)
1 Customização
2 Consistencia dos dados
3 Volume de consumo
4 Muitos Usuarios por TENANT

## TIPO (Tudo compaartilhado (container, hadware, banco de dadoss))
1 Muitos TENANTS envolvidos
2 Baixa Customização 


## libs 
```
1 hyn/multi-tenant (trabalhas com subdominhos)
2 orchestral/tenanti (trabalhas com varias instancias de bancos )
```
## [Nested set model](https://en.wikipedia.org/wiki/Nested_set_model)


## Vuex  Single Source of Truth (SSOT). 
```
[Flux](https://facebook.github.io/flux/docs/in-depth-overview.html#content) 
```
## [O que é a fonte única da verdade?](https://www.schoolofnet.com/curso-vue-20-com-vuex/2280)
```
Imagine que você irá estruturar todas as suas informações, da aplicação, e concentrará em um único lugar. Constumamos falar que este local será um "armazém". Quem precisar alterar qualquer informação, deverá acessar este armazém. Não irá alterar direto no componente ou qualquer outro local que esteja, pois eles serão, somente, referência. O mais importante é que, todas informações só terão acesso, tanto para listagem quanto para alterações, em um único lugar. Tudo centralizado.

Se eu modificar alguma coisa no armazém, todos que buscarem informações nele, já terão uma resposta atualizada, porque a fonte é única. Os componentes deixarão de ter informações próprias. Eles buscarão estas informações no armazém. Algumas informações, menores, podem ainda, continuar por responsabilidade do componente, mas as informações principais, serão capturadas do armazém.

Imaginem que exista uma biblioteca que todos componentes precisem consultar, para ter qualquer informação, porque todas as informações importantes, estão nela e somente nela.

Este conceito de fonte única da verdade é muito utilizado em bancos de dados relacionais. Quando criamos uma tabela de pedidos e temos um cliente relacionado, nós apenas criamos um apontamento deste cliente, para a tabela de clientes, não estamos duplicando as informações. Deste modo, temos o id do cliente, relacionado ao pedido. Quando consultarmos, sempre teremos as fontes atualizadas, caso algué...

```

 ## Push notificantion
 ```
 http://vineeshnp.com/push-notification-on-progressive-web-apps-with-firebase-cloud-messaging/
 
 https://console.firebase.google.com/project/sisfin-2bb72/settings/cloudmessaging/
 ```

https://intense-dawn-46739.herokuapp.com/app#!/login

 ## Login
  ```
 cliente5@user.com
 cliente15@user.com
 cliente16@user.com
  ```
##Senha 
  ```
 secret
 ```
