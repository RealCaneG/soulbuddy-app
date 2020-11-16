<template>
    <modal name="confirmation-box" :height="'auto'"
           :styles="'justify-content: space-between; display: flex;flex-direction: column;padding: 1rem 1rem;border-radius: 25px;'">
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
    .modal-confirm {
        justify-content: space-between;
        display: flex;
        flex-direction: column;
        padding: 1rem 1rem;
        border-radius: 25px;
    }

    .header {
        font-size: 2rem;
        font-family: 'Arvo-Bold', Arial, Helvetica, sans-serif;
        font-weight: bold;
        margin-bottom: 1rem;
        color: #F63854;
    }

    .description {
        font-size: 1rem;
        font-family: 'Arvo-Bold', Arial, Helvetica, sans-serif;
        font-weight: 300;
        margin-bottom: 1rem;
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
