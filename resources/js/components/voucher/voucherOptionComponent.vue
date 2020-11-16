<template>
    <div class="container">
        <div class="icon-container">
            <img class="svg-icon" src="/icons/icon_wallet.svg" alt="">
        </div>
        <div class="title">
            <p> {{ option.token }} Tokens in Balance</p>
        </div>
        <div class="details-container">
            <p class="description">Redemption Amount</p>
            <p class="price">{{ option.ccy }} ${{ option.price }}</p>
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
                <button @click="handleOnSubmit">
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
                }).render('#paypal-button-container');
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
        border-radius: 25px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-family: 'Arvo', sans-serif;
        max-width: 30rem;
        height: auto;
        max-height: 40rem;
        padding: 2rem 2rem;
        overflow: hidden;
    }

    .container-main {

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
        font-size: 2rem;
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
        height: 15rem;
        max-width: 100%;
        max-height: 100%;
    }

    button {
        text-align: center;
        font-size: 1rem;
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
