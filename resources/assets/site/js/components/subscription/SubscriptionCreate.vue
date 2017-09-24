<template src="./_template.html">
</template>
<script>
    export default{
        props: ['plan','csrf_token','action'],
        data(){
            return{
                token_payment: null,
                payment_type: 'credit_card',///boleto - bank_slip
                credit_card: {
                    number: '4111111111111111',
                    cvv: '123',
                    expiration: '12/25',
                    first_name: 'Nome',
                    last_name: 'Sobrenome'
                }
            }
        },
        ready(){
            /*
            * Deixar em modo TESTE
            * pegar o ID no configurações da conta
            * criar um token com ~ TEST ~ 
            */
            Iugu.setAccountID("111111111111111111111111111111");
            Iugu.setTestMode(true); // marca como TEST
            Iugu.setup();//consolidação
        },
        methods: {
            submit(){
                if(this.payment_type == 'credit_card'){//verificar se é cartão de credito
                    let expirationArray = this.credit_card.expiration.split('/');
                    /*
                    * validando o numero do cartão na Iugu  
                    */
                    let creditCard = Iugu.CreditCard(
                      this.credit_card.number,
                      expirationArray[0],
                      expirationArray[1],
                      this.credit_card.first_name,
                      this.credit_card.last_name,
                      this.credit_card.cvv
                    );
                    let self = this;
                    /*
                    * Gerando o token de pagamento
                    */
                    Iugu.createPaymentToken(creditCard, response => {
                        if(response.errors){//validação na propria biblioteca
                            Materialize.toast("Erro ao processar cartão de crédito. Tente novamente!", 4000);
                        }else{
//console.log(response.id);//retun token
                            self.token_payment = response.id;
                            setTimeout(()=>{
                                $('#subscription-form')[0].submit();
                            })
                        }
                    });
                }else{
                    $('#subscription-form')[0].submit();
                }
            }
        }
    }
</script>
