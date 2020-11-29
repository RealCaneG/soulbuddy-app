<template>
    <div class="list-wrapper">
        <div class="list-container">
            <div class="header-container"><h1>Notification Inbox</h1></div>
            <div v-if="notifications.length === 0" class="no-notification">There is no notification for now.</div>
            <ul style="height:300px; overflow-y:scroll">
                <li class="p-2" v-for="n in notifications" :key="n.id">
                    <InfoNotification :notification="n" v-if="n.notification_type_id === 2"/>
                    <EventNotification :notification="n" v-if="n.notification_type_id === 1"/>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import InfoNotification from "../components/InfoNotification";
    import EventNotification from "../components/EventNotification";
    import {mapActions} from "vuex";

    export default {
        name: "AllNotification",
        components: {EventNotification, InfoNotification},
        data() {
            return {}
        },
        methods: {
            ...mapActions({getAll: 'getAllUnreadNotifications'})
        },
        computed: {
            notifications() {
                console.log(this.$store.state.notifications)
                return this.$store.state.notifications;
            }
        },
        created() {
            this.getAll();
        }
    }
</script>

<style scoped>
    .list-wrapper {
        padding: 2rem
    }

    .header-container {
        padding: 1rem;
        font-family: Roboto, serif;
        font-weight: 600;
        border-bottom: 1px solid #cecece;
    }

    .no-notification {
        text-align: center;
        padding: 1rem;
        color: #cecece;
        font-weight: 600;
        font-size: 20px;
        font-family: Roboto, serif;
    }

    .list-container {
        display: flex;
        flex-direction: column;
        border: 1px solid #cecece;
        border-radius: 25px;
        min-width: 44rem;
        max-width: 44rem;
        width: 100%;
    }

</style>
