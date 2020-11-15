<template>
    <div class="container">
        <div class="icon-container">
            <img src="/icons/icon_cash.svg" alt="" class="svg-icon">
        </div>
        <div class="title">
            <p>Thank You!</p>
        </div>
        <div class="details-container">
            <p class="description">Your request will be processed within 5 working days. A confirmation email will be
                sent to your registered mailbox.</p>
        </div>
        <div class="footer-container">
            <p class="footer-description">Interest in how to earn more voucher?</p>
            <button class="inline-button">Learn More</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "voucherRedemptionSuccessComponent"
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

.inline-button {
    background-color: transparent;
    border: none;
    text-underline: #A5A5A5;
    border-bottom: 1px black solid;
}

.svg-icon {
    max-width: 100%;
    max-height: 100%;
    height: 15rem;
}
</style>
