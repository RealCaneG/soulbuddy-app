<template>
    <modal name="confirmation-box">
        <header class="header">
            <slot name="header">
                Confirm?
            </slot>
        </header>
        <main class="description">
            <slot name="description"></slot>
        </main>
        <footer class="buttons">
            <slot name="buttons"></slot>
        </footer>
    </modal>
</template>

<script>
export default {
    name: "ConfirmationBox"
}
</script>

<style scoped>

.header {
    font-size: 3rem;
    font-family: 'Arvo-Bold', Arial, Helvetica, sans-serif;
    font-weight: bold;
    color: #d84315;
}

.description {
    font-size: 1rem;
    font-family: 'Arvo-Bold', Arial, Helvetica, sans-serif;
    font-weight: 300;
    color: #495057;
}

.buttons {
    display: flex;
    flex-direction: row;
    text-align: center;
    justify-content: center;
    align-items: center;
}


</style>
