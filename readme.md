## Oques é SaaS?
1 Significa Software como serviço
2 Ambiente ComPatilhado.
3 Customizações por Cliente
4 Atentimento a vários clientes
5 Precisa de arquitetura multe-tenancy.
6 Ideal em cloud server

## O Qque é multi-tenancy?
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
1 hyn/multi-tenant (trabalhas com subdominhos)
2 orchestral/tenanti (trabalhas com vaias instancias de bancos )

## [Nested set model](https://en.wikipedia.org/wiki/Nested_set_model)

