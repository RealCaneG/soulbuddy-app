<template>
    <div>
        <div class="wrapper-center">
            <div>
                <slot name="bannerHeader"></slot>
            </div>
            <div>
                <slot name="bannerDescription"></slot>
            </div>
        </div>
        <div class="tools">
            <slot name="tools"></slot>
        </div>
        <main class="content">
            <slot name="content"></slot>
        </main>
    </div>
</template>

<script>
    export default {
        name: "pageTemplate",
    }
</script>

<style scoped>
    .tools {
        padding: 0 1rem 0 1rem;
    }

    .content {
        padding: 0 7rem;
    }

    select {
        border-radius: 25px;
        font-size: .9rem;
        max-width: 10rem;
    }
</style>
