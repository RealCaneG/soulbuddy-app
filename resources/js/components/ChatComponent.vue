<template>
    <div class="row pt-3">
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-header">
<!--                    <span>
                        <b-icon icon="box-arrow-left"
                                @click="enterChatRoom">
                        </b-icon>
                    </span>-->
                    <span>Messages</span>
                </div>
                <div v-if="toUserId != null" >
                    <div class="card-body p-0">
                        <ul  style="height: 30rem; overflow-y:scroll" v-chat-scroll>
                            <li class="p-2" v-for="m in this.messages[toUserId]" :key="m.id">
                                <div v-bind:class="dialogClassObject(m.user.id)">
                                    <strong>{{ m.user.name }}</strong>
                                    <div class="message-container">
                                        {{ m.message }}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="input-bar">
                        <input
                            @keydown="sendTypingEvent"
                            @keyup.enter="sendMessage"
                            v-model="newMessage"
                            type="text"
                            name="message"
                            class="form-control"
                            :disabled="!isInChatRoom">
                        </input>
                        <b-icon-caret-right-square-fill @click="sendMessage" class="send-icon"/>
                    </div>
                </div>
            </div>
            <span class="text-muted" v-if="currentTypingUser">{{ currentTypingUser.name }} is typing...</span>
        </div>
        <div class="col-2">
            <div class="card card-default">
                <div class="card-header">Active Users</div>
                <div class="card-body">
                    <ul class="user-list list-unstyled">
                        <li class="py-2"
                            v-for="(contact, index) in userContactList"
                            :key="index">
                            <span v-bind:class="{'online-user': isOnline(contact.contact_user)}"><b-icon-person-fill/></span>
                            <button @click="enterChatRoom(contact.contact_user.id)"> {{
                                    contact.contact_user.name
                                }}
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/*.chat-room {
    width: 100%;
    display: flex;
}*/

* {
    --bg-primary: #fff;
    --bg-secondary: #d3d8e452;
    --text-primary: #333;
    --text-secondary: #e861a2;
    --transition-speed: 500ms;
    --theme-color: #F63854;
}

.contact-list-container {

}

.chat-dialog-container {

}

.input-bar {
    display: flex;
    flex-direction: row;
    align-items: center;
    text-align: left;
}

.send-icon {
    color: var(--theme-color);
    font-size: 2rem;
}

.message-container {
    min-width: 100%;
    max-width: 100%;
    width: auto;
    flex-wrap: wrap;
}

.online-user {
    color: #00e676;
}

.dialog-to {
    background-color: #ffdede6e;
    text-align: left;
    padding: 5px 10px;
    border-radius: 1rem;
    min-width: 10%;
    width: auto;
    max-width: 45%;
    margin-right: auto;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.dialog-own {
    background-color: #cdf1f6;
    text-align: right;
    padding: 5px 10px;
    border-radius: 1rem;
    min-width: 10%;
    width: auto;
    max-width: 45%;
    margin-left: auto;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

</style>
<script>
import {mapActions} from "vuex";

export default {
    data() {
        return {
            newMessage: '',
            isInChatRoom: false,
            toUserId: null,
        }
    },
    computed: {
        getToUserId() {
            return this.toUserId;
        },
        currentUser() {
            console.log(`currentUser = ${JSON.stringify(this.$store.state.currentUser)}`)
            return this.$store.state.currentUser;
        },
        currentTypingUser() {
            return this.$store.state.currentTypingUser;
        },
        onlineUserIdList() {
            return this.$store.state.activeUsers.map(user => user.id);
        },
        userContactList() {
            return this.$store.state.approvedUsers;
        },
        messages() {
            return this.$store.state.messages;
        }
    },
    created() {
        this.fetchMessages();
        this.getContact();
    },
    //.filter(u=> u.user_id !== currentUser.id)
    methods: {
        ...mapActions({getContact: 'getUserContactList'}),
        getMessagesByUser() {
            console.log('get msg by user');
            console.log(this.toUserId);
            console.log(this.messages);
            return (this.messages == null || this.toUserId === undefined) ? [] : this.messages[this.toUserId];
        },
        isOnline(user) {
            let userId = user.id;
            return this.onlineUserIdList.find(u => u === userId) != null;
        },
        dialogClassObject(userId) {
            return {
                'dialog-own': this.toUserId !== userId,
                'dialog-to': this.toUserId === userId
            }
        },
        enterChatRoom(id) {
            this.isInChatRoom = !this.isInChatRoom;
            if (this.toUserId != null) {
                this.toUserId = null;
            } else {
                this.toUserId = id;
            }
        },
        fetchMessages() {
            this.$store.dispatch('getAllMessages');
        },
        sendMessage() {
            let msgObj = {
                message: this.newMessage,
                to_user_id: this.toUserId,
                user_id: this.currentUser.id,
                user: {
                    id: this.currentUser.id,
                    name: this.currentUser.name
                }
            }
            this.$store.dispatch('updateMessages', msgObj);
            let formData = new FormData();
            formData.append("message", msgObj.message);
            formData.append("user_id", msgObj.to_user_id);
            axios
                .post('/messages', formData, {
                    headers: {"Content-Type": "multipart/form-data"}
                }).then(res => console.log('message sent!'));
            this.newMessage = '';
        },
        sendTypingEvent() {
            Echo.join('message')
                .whisper('typing', this.currentUser);
        }
    }
}
</script>
