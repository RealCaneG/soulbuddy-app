<template>
   <div>
       <ul style="height:300px; overflow-y:scroll">
           <li class="p-2" v-for="n in notifications" :key="n.id">
               <InfoNotification :notification="n" v-if="n.notification_type_id === 2"/>
               <EventNotification :notification="n" v-if="n.notification_type_id === 1"/>
           </li>
       </ul>
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
        return {
        }
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

</style>
