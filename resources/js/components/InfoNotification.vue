<template>
    <div class="notification-container">
        <div>
            <div class="title">
                {{ this.notification.title }}
            </div>
            <div class="description">
                {{ this.notification.description }}
            </div>
        </div>
        <b-btn class="button" @click="handleOnButtonClick">Dismiss</b-btn>
    </div>
</template>

<script>
    import {mapActions} from "vuex";

    export default {
        name: "InfoNotification",
        props: ['notification'],
        methods: {
            ...mapActions({dismissNotification: "dismissNotification"}),
            handleOnButtonClick() {
                let formData = new FormData();
                formData.append('notification_id', this.notification.id);
                formData.append('is_read', 1);
                this.dismissNotification(formData);
            }
        }
    }
</script>

<style scoped>
    .title {
        font-family: 'Arvo', sans-serif;
        font-weight: 600;
    }

    .description {
        font-size: 1rem;
        font-family: 'Nunito', sans-serif;
        color: #585858;
    }

    .notification-container {
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        border-radius: .3rem;
        background-color: #28a74540;
        width: 50%;
    }

    button {
        text-align: center;
        font-size: 1rem;
        color: #F63854;
        padding: 0.5rem 3rem;
        border: 1px solid #F63854;
        border-radius: 2rem;
        background-color: transparent;
    }

    button:hover {
        color: white;
        border: 1px solid #F63854;
        background-color: #F63854;
    }

    button:focus {
        outline: none;
    }
</style>
