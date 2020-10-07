<template>
    <div class="main">
        <div class="pricing-wrapper">
            <div v-for="(pricing, i) in pricings.data" :key=i @click="generateButton(pricing.price, i)">
                <b-card class="pricing-item mt-4 mb-4 text-center">
                    <b-card-header class="h3 font-weight-bold"> {{ pricing.token }} Tokens</b-card-header>
                    <b-card-text class="h1">
                        <b-icon icon="gem" font-scale="4" animation="throb"></b-icon>
                    </b-card-text>
                    <b-card-text class="h4 font-weight-light">
                        - ${{ pricing.price }} {{pricing.ccy}} -
                    </b-card-text>
                    <b-card-text>
                        <hr>
                        <div class="mt-1 mb-1" :id="'paypal-button-container-' + i"></div>
                    </b-card-text>
                </b-card>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Pricing",
        data() {
            return {
                pricings: {},
                status: 'ready',
                totalPrice: '0',
            }
        },
        mounted() {
            const theTotalPrice = this.getTotalPrice();
        },
        beforeMount() {
            this.getPricings();
            this.totalPrice = '50';
        },
        methods: {
            generateButton(price, index) {
                let child = document.getElementById(`paypal-button-container-${index}`).firstChild;
                if (child != null) child.remove();
                paypal.Buttons({
                    createOrder: (data, actions) => {
                        // This function sets up the details of the transaction, including the amount and line item details.
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: price,
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
                            console.log('Details =', details);
                            this.captureTransaction(details);
                            alert('Transaction completed by ' + details.payer.name.given_name);
                        });
                    },
                    onCancel: function (data) {
                        // Show a cancel page, or return to cart
                    }
                }).render(`#paypal-button-container-${index}`);
            },

            getTotalPrice() {
                return this.totalPrice;
            },

            getPricings() {
                axios.get('/payment/get_all_pricing')
                    .then(response => {
                        this.pricings = response.data;
                    })
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
                    }))
            }
        }
    }
</script>


<style scoped>
    .card {
        max-width: 20rem;
    }

    .card-header {
        background-color: #ffffff;
    }

    .pricing-item {
        margin-right: 2rem;
    }

    .pricing-wrapper {
        display: flex;
        justify-content: center;
        flex-direction: row;
    }
</style>
