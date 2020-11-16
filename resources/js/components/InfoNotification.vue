<template>
    <div class="content col-6">
        <div class="title">
            {{ this.notification.title }}
        </div>
        <div class="description">
            {{ this.notification.description }}
        </div>
        <b-btn @click="handleOnButtonClick">Dismiss</b-btn>
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

}

.description {

}

.content {
    background-color: #00acc1;
    border-radius: .25rem;
}
</style>
