<template>
    <div class="main">
        <div class="pricing-wrapper">
            <voucher-option v-if="!isPurchaseComplete" v-bind:option="this.option" v-on:handleOnSubmitRequest="handleOnSubmitRequest"/>
            <voucher-success v-if="isPurchaseComplete"/>
        </div>
    </div>
</template>

<script>

import voucherOption from "../components/voucher/voucherOptionComponent"
import voucherSuccess from "../components/voucher/voucherRedemptionSuccessComponent"

export default {
    name: "Pricing",
    components: {voucherOption, voucherSuccess},
    data() {
        return {
            isPurchaseComplete: false,
            option: {
                token: 1000,
                price: 100,
                ccy: 'HKD'
            }
        }
    },
    methods: {
        getComponent() {
            console.log('hello')
            return voucherOption;
            //return this.isPurchaseComplete ? voucherSuccess : voucherOption;
        },
        handleOnSubmitRequest() {
            this.isPurchaseComplete = true;
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
