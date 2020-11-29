<template>
    <div class="notification-container">
        <div class="item">
            <div class="title">
                {{ notification.title }}
            </div>
            <div class="description">
                {{ notification.description }}
            </div>
        </div>
        <div class="buttons pt-2">
            <b-btn class="button" v-bind:disabled="isEventHandled" @click="handleEvent(true)">Accept</b-btn>
            <b-btn class="button" v-bind:disabled="isEventHandled" @click="handleEvent(false)">Reject</b-btn>
        </div>
    </div>
</template>

<script>
    import {mapActions} from "vuex";

    export default {
        name: "EventNotification",
        props: ['notification'],
        data() {
            console.log(this.notification)
            return {
                isEventHandled: false,
            }
        },
        methods: {
            ...mapActions({updateNotificationStatus: 'updateNotificationStatus'}),
            handleEvent(isApproved) {
                let notificationId = this.notification.id;
                let requestId = this.notification.payload_id;
                let userIdToBeApproved = this.notification.from_user_id;
                console.log(`this notification = ${this.notification}`)
                let formData = new FormData();
                formData.append('request_id', requestId);
                formData.append('is_approved', isApproved);
                formData.append('user_id_to_approve', userIdToBeApproved);
                axios.post('/counselling/approve_request', formData, {
                    headers: {"Content-Type": "multipart/form-data"}
                })
                    .then(res => {
                        if (!res.data.error && res.status === 200) {
                            this.$bvToast.toast(`You have ${isApproved ? 'approve' : 'reject'} the request${isApproved ? ', you can start the counselling session!' : '.'}`, {
                                title: 'Info',
                                variant: 'info',
                                autoHideDelay: 5000,
                                appendToast: true
                            })
                            this.isEventHandled = true;
                            let formData = new FormData();
                            formData.append('notification_id', notificationId);
                            formData.append('is_read', 1);
                            this.updateNotificationStatus(formData)
                        } else {
                            this.$bvToast.toast(res.data.message, {
                                title: 'Error',
                                variant: 'warning',
                                autoHideDelay: 5000,
                                appendToast: true
                            })
                        }
                    }).catch(exp => {
                    console.log({exp})
                    this.$bvToast.toast(exp, {
                        title: 'Error',
                        variant: 'warning',
                        autoHideDelay: 5000,
                        appendToast: true
                    })
                })
            }
        }
    }
</script>

<style scoped>
    .title {
        font-family: 'Arvo',sans-serif;
        font-weight: 600;
    }

    .description {
        font-size: 1rem;
        font-family: 'Nunito',sans-serif;
        color: #585858;
    }

    .notification-container {
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        border-radius: .3rem;
        background-color: #f5df405c;
        width: 100%;
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

    .buttons {
        display: flex;
        flex-direction: row;
        margin-left: .5rem;
    }

    .buttons > .button + .button {
        margin-left: 1rem;
    }


</style>
