# DESATIVADO 

####  Proposta de Trabalho
<details><summary><b>Dashboard  IMG</b></summary>
<p>
 Este trabalho tem como objetivo desenvolver um Sistema de Gestão Administrativo / Financeiro, oferecendo serviços de otimização de atividades no setor financeiro, com as funcionalidades de contas a pagar e receber, gerenciamento de contas bancárias e fluxo de caixa. Além de oferecer informações que ajudam os setores estratégicos, dando apoio à tomada de decisão, oferecendo uma boa interação e acessibilidade dos serviços. Serão utilizados modelos como multi-tenancy, modelo na qual nasceu com a computação em nuvem, e PWA (Progressive Web Apps) dando uma melhor interação dos seus serviços.
</p></details>

```
Este projeto teve como objetivo de criar um sistem financeiro utilizando PWA,
para o TCC do curso Sistema de informação.
Algumas tecnologias utilizadas: Laravel, Vue.js, jquery, heroku, firebase,
push notification, php, javascript ...
```

## Dashboard
``` Na página principal, temos um pequeno resumo da situação financeira.```

<details><summary><b>Dashboard  IMG</b></summary>
<p>

![image4](https://user-images.githubusercontent.com/19413241/157049090-722c0033-fdb2-4d26-b532-bcd4d9b600ed.png)
 
</p></details>

``` Cadastro da conta bancária no sistema, para o levantamento do salto total do cliente. ```
<details><summary><b>Cadastro da conta bancária  IMG</b></summary>
<p>
 
![image7](https://user-images.githubusercontent.com/19413241/157230843-1787402e-3814-47f7-9ce9-397ade27267b.png)
 
</p></details>

``` Na funcionalidade, fluxo de caixa, há uma tabela que tem os seguintes dados: o saldo final, saldo do mês anterior, geração de caixa, recebimentos, outras receitas, receitas de vendas, pagamento e despesas financeiras. Pode-se baixar o relatório da tabela no formato .csv.  ```
<details><summary><b>Fluxo de caixa  IMG</b></summary>
<p>

![image6](https://user-images.githubusercontent.com/19413241/157492849-b3659e99-ee60-4105-8fbc-edc82280cc2d.png)
 
</p></details>

```Na funcionalidade extratos a receber, há uma tabela que tem os seguintes dados: valor, saldo, lançamento e data. No rodapé da página, há a soma do total recebido, total de pagamentos, número de lançamentos e total do período.```
<details><summary><b>Extratos a receber IMG</b></summary>
<p>

 ![image9](https://user-images.githubusercontent.com/19413241/159173964-a9bddc91-421b-4765-884d-b414a0264c64.png)
 
</p></details>

```Na funcionalidade de contas a receber há uma tabela que tem os seguintes dados: valor da conta, descrição e data do vencimento da conta. No rodapé da página, há a soma das contas pagas, a pagar, vencidas e o total.```
<details><summary><b>Contas a receber  IMG</b></summary>
<p>

![image8](https://user-images.githubusercontent.com/19413241/158430797-7e471e31-3e90-4a94-92ea-1fa8121a0469.png)

</p></details>

```Na funcionalidade de contas a pagar, há uma tabela que tem os seguintes dados: valor da conta, descrição e data do vencimento da conta. No rodapé da página, há a soma das contas pagas, a pagar, vencidas e o total de pagamentos feitos. ```
<details><summary><b>Contas a pagar IMG</b></summary>
<p>

![image10](https://user-images.githubusercontent.com/19413241/157668935-2e97f25d-c5ab-47bc-8ec9-700c955ef1a1.png)

 </p></details>
 
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
