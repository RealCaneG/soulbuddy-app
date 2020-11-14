<template>
    <div class="container">
        <div class="icon-container">
            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 1000 1000"
                 xml:space="preserve">
                <g>
                    <path class="st0"
                          d="M190.4,926.7h579.4c55.1,0,100-44.9,100-100v-93.5c23-6.7,39.9-28,39.9-53.2V583c0-25.2-16.9-46.4-39.9-53.2   v-93.5c0-36.8-19.9-68.9-49.6-86.3v-51.6c0-32.5-26.4-59-59-59h-77.9c-22-85.2-99.4-148.4-191.4-148.4s-169.5,63.1-191.4,148.4   h-111c-54.6,0-99.1,44.4-99.1,99.1v488.2C90.4,881.9,135.2,926.7,190.4,926.7z M869.6,680.1c0,8.5-6.9,15.4-15.4,15.4H734.7   c-35.2,0-63.9-28.7-63.9-63.9s28.7-63.9,63.9-63.9h119.6c8.5,0,15.4,6.9,15.4,15.4V680.1z M761.2,279.5c10.5,0,19,8.5,19,19v38.5   c-3.4-0.4-6.9-0.5-10.4-0.5h-86c3.8-15.5,5.8-31.5,5.8-47.6c0-3.1-0.1-6.2-0.2-9.3H761.2z M491.9,131.1   c86.9,0,157.6,70.7,157.6,157.6c0,16.3-2.5,32.3-7.3,47.6H544c4.1-7.5,6.4-16.1,6.4-25.4c0-13.8-4.1-25.2-12.5-34.7   c-7.5-8.5-18.5-15.5-34.3-22c-24.4-10.2-28.6-15.5-28.6-23.4c0-11.4,10.7-15.4,20.6-15.4c15.5,0,25.4,5.6,30.2,8.3   c2,1.2,4.5,1.4,6.7,0.5c2.2-0.8,3.9-2.5,4.8-4.8l6.5-17.9c1.3-3.6-0.1-7.7-3.5-9.6c-9.3-5.5-19.5-8.8-31-10v-18.8c0-4.4-3.6-8-8-8   h-17c-4.4,0-8,3.6-8,8v20.7c-25,6.6-40.8,25.6-40.8,50c0,30.7,25.2,44.7,49.7,54.4c21.2,8.6,25.5,16.1,25.5,24.7   c0,11-9.7,18.5-24.2,18.5c-11.7,0-24.6-3.9-34.3-10.4c-2-1.4-4.6-1.7-7-0.9c-2.3,0.8-4.2,2.6-5,4.9l-4,11.3h-94.8   c-4.9-15.3-7.3-31.3-7.3-47.6C334.2,201.8,405,131.1,491.9,131.1z M208.8,279.5h85.6c-0.1,3.1-0.2,6.2-0.2,9.3   c0,16.2,1.9,32.1,5.8,47.6h-91.2c-15.7,0-28.4-12.8-28.4-28.4C180.4,292.2,193.1,279.5,208.8,279.5z M130.4,338.5   c0-12.2,3.7-23.5,10-32.9c0,0.8,0,1.5,0,2.3c0,37.7,30.7,68.4,68.4,68.4h265.8v0.2h33v-0.2h262.1c33.1,0,60,26.9,60,60v91.3h-95.1   c-57.3,0-103.9,46.6-103.9,103.9c0,57.3,46.6,103.9,103.9,103.9h95.1v91.3c0,33.1-26.9,60-60,60H190.4c-33.1,0-60-26.9-60-60V338.5   z"/>
                    <path class="st0"
                          d="M741.4,593.1c-21.2,0-38.4,17.2-38.4,38.4s17.2,38.4,38.4,38.4c21.2,0,38.4-17.2,38.4-38.4   S762.6,593.1,741.4,593.1z M741.4,633.1c-0.9,0-1.6-0.7-1.6-1.6s0.7-1.6,1.6-1.6s1.6,0.7,1.6,1.6S742.3,633.1,741.4,633.1z"/>
                </g>
            </svg>
        </div>
        <div class="title">
            <p> {{ option.token }} Tokens in Balance</p>
        </div>
        <div class="details-container">
            <p class="description">Redemption Amount</p>
            <p class="price">{{ option.ccy }} {{ option.price }}</p>
        </div>
        <div class="mt-1 mb-1" id="button-container">
            <button v-if="!isSubmitted" @click="handleOnClick">Submit Request</button>
            <div id="paypal-button-container"/>
        </div>
        <confirmation-box class="container-main">
            <template v-slot:header>
                Confirm Request
            </template>
            <template v-slot:description>
                Confirm to submit redemption request?
            </template>
            <template v-slot:buttons>
                <button class="button-secondary" @click="handleOnClose">
                    Cancel
                </button>
                <button  @click="handleOnSubmit">
                    Submit
                </button>
            </template>
        </confirmation-box>
    </div>
</template>

<script>
import ConfirmationBox from "../ConfirmationBox";
export default {
    components: {ConfirmationBox},
    props: ['option'],
    name: "voucherOptionComponent",
    mounted() {

    },
    data() {
        return {
            isSubmitted: false,
        }
    },
    methods: {
        handleOnClose() {
            this.$modal.hide('confirmation-box');
        },
        handleOnSubmit() {
            this.isSubmitted = true;
            this.$modal.hide('confirmation-box');
            this.generateButton();
        },
        handleOnClick() {
            this.$modal.show('confirmation-box');
        },
        generateButton() {
            paypal.Buttons({
                createOrder: (data, actions) => {
                    // This function sets up the details of the transaction, including the amount and line item details.
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: this.option.price,
                                currency_code: 'HKD',
                            }
                        }],
                        application_context: {
                            shipping_preference: 'NO_SHIPPING'
                        }
                    });
                },
                onApprove: (data, actions) => {
                    // This function captures the funds from the transaction.
                    return actions.order.capture().then(details => {
                        // This function shows a transaction success message to your buyer.
                        console.log('Details =', JSON.stringify(details));
                        this.captureTransaction(details);
                        alert('Transaction completed by ' + details.payer.name.given_name);
                    });
                },
                onCancel: function (data) {
                    this.$bvToast.toast(`Transaction is cancelled!`, {
                        title: 'Success',
                        variant: 'success',
                        autoHideDelay: 5000,
                        appendToast: true
                    });
                }
            }).render('paypal-button-container');
        },
        captureTransaction(details) {
            let formData = new FormData();
            let purchase_units = details.purchase_units[0];
            let captures = purchase_units.payments.captures[0];
            formData.append('to_user_id', this.$userId);
            formData.append('payment_id', captures.id);
            formData.append('payer_id', details.payer.payer_id);
            formData.append('merchant_id', purchase_units.payee.merchant_id);
            formData.append('payer_email', details.payer.email_address);
            formData.append('payee_email', purchase_units.payee.email_address);
            formData.append('transaction_type', 'TOP_UP');
            formData.append('country_code', details.payer.address.country_code);
            formData.append('amount', purchase_units.amount.value);
            formData.append('ccy', purchase_units.amount.currency_code);
            formData.append('given_name', details.payer.name.given_name);
            formData.append('surname', details.payer.name.surname);
            formData.append('intent', details.intent);
            formData.append('payment_method', 'PAYPAL');
            formData.append('status', details.status);
            formData.append('reference_id', details.id);

            axios.post('/payment/capture_transaction', formData, {
                headers: {"Content-Type": "multipart/form-data"}
            })
                .then((res => {
                    this.status = 'ready';
                    this.isSubmitted = false;
                    this.$emit('handleOnSubmitRequest');
                }))
        }
    }
}
</script>

<style scoped>
.container {
    background-color: #F2F2F2;
    border-radius: 3px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    font-family: 'Arvo', sans-serif;
    max-width: 20rem;
    max-height: 20rem;
    padding: 2rem 5rem;
}

.vm--modal {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.icon-container {

}

.title {
    color: black;
    font-size: 1rem;
}

.details-container {
    color: #808080;
}

.description {
    font-size: 1rem;
}

.price {
    font-size: 2rem;
}

.svg-icon {
    max-width: 100%;
    max-height: 100%;
}

button {
    text-align: center;
    font-size: .5rem;
    color: #F63854;
    padding: 0.5rem 2rem;
    border: 1px solid #F63854;
    border-radius: 2rem;
}

button + button {
     margin-left: 1rem;
}

.button-secondary {
    color: grey;
    border: 1px solid grey;
}

.button-secondary:hover {
    color: white;
    border: 1px solid #F63854;
    background-color: #F63854;
}

button:hover {
    color: white;
    background-color: #F63854;
}



button:focus {
    outline: none;
}

</style>
