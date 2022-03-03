# DESATIVADO 
```
Este projeto teve como objetivo de criar um sistem financeiro utilizando PWA,
para o TCC do curso Sistema de informação.
Algumas tecnologias utilizadas: Laravel, Vue.js, jquery, heroku, forebase com push notification, php, javascript ...
```

## Oques é SaaS?
- Significa Software como serviço
- Ambiente ComPatilhado.
- Customizações por Cliente
- Atentimento a vários clientes
- Precisa de arquitetura multe-tenancy.
- Ideal em cloud server

## O que é multi-tenancy?
- Tenancy Significada: Locação Arrendamento
- Em ti: Inquilino
- Vários Clientes Por Aplicação
- Aplicavel quando aplicação vira um produto
- Clientes Compartilham Estrutua
- Escopo do Multi-Tenancy: Usuário, Empresas, Etc.
- Isolar as Unformações Logicamente
- Falha de um cliente não pode afetar em outro

## Qual Modelo Utilizar?
- Não há Verdade do Universo
- Enternder o Contexto que Será Aplicado
- Entender as Customizações
- Númemos de Usuários
- Recursos a Serem Utilizados

#### MODELOS DE IMPLEMENTAÇÃO

## TIPO (Tudo isolado (container, hadware, banco de dados))
- Alto nivel de segurança
- Alto consumo de hardware
- Monitoramento Individual

## TIPO (Conatiner compartilhado, banco de dados diferente)
- Customização
- Consistencia dos dados
- Volume de consumo
- Muitos Usuarios por TENANT

## TIPO (Tudo compaartilhado (container, hadware, banco de dadoss))
- Muitos TENANTS envolvidos
- Baixa Customização 


## libs 
```
- hyn/multi-tenant (trabalhas com subdominhos)
- orchestral/tenanti (trabalhas com varias instancias de bancos )
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

 ## Push Notificantion
 ```
 http://vineeshnp.com/push-notification-on-progressive-web-apps-with-firebase-cloud-messaging/
 
 https://console.firebase.google.com/project/sisfin-2bb72/settings/cloudmessaging/
 ```

## Link para Projeto
https://intense-dawn-46739.herokuapp.com/app#!/login

 ## Login
  ```
 cliente5@user.com
 cliente15@user.com
 cliente16@user.com
  ```
## Senha 
  ```
 secret
 ```
