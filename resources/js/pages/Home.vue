<template>
    <div>
        <nav class="navbar">
            <ul class="navbar-nav">
                <li class="navbar-brand">
                    <a href="/">
                        <img src='/images/logo.png' alt="">
                    </a>
                </li>
                <li class="nav-item">
                    <router-link to="/home/articles">
                        <a class="nav-link">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pencil-alt"
                                 class="svg-inline--fa fa-pencil-alt fa-w-16" role="img"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 512 512">
                                <path fill="currentColor"
                                      d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z">
                                </path>
                            </svg>
                            <span class="link-text">Article Sharing</span>
                        </a>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/home/secrets">
                        <a class="nav-link">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-secret"
                                 class="svg-inline--fa fa-user-secret fa-w-14" role="img"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 448 512">
                                <path fill="currentColor"
                                      d="M383.9 308.3l23.9-62.6c4-10.5-3.7-21.7-15-21.7h-58.5c11-18.9 17.8-40.6 17.8-64v-.3c39.2-7.8 64-19.1 64-31.7 0-13.3-27.3-25.1-70.1-33-9.2-32.8-27-65.8-40.6-82.8-9.5-11.9-25.9-15.6-39.5-8.8l-27.6 13.8c-9 4.5-19.6 4.5-28.6 0L182.1 3.4c-13.6-6.8-30-3.1-39.5 8.8-13.5 17-31.4 50-40.6 82.8-42.7 7.9-70 19.7-70 33 0 12.6 24.8 23.9 64 31.7v.3c0 23.4 6.8 45.1 17.8 64H56.3c-11.5 0-19.2 11.7-14.7 22.3l25.8 60.2C27.3 329.8 0 372.7 0 422.4v44.8C0 491.9 20.1 512 44.8 512h358.4c24.7 0 44.8-20.1 44.8-44.8v-44.8c0-48.4-25.8-90.4-64.1-114.1zM176 480l-41.6-192 49.6 32 24 40-32 120zm96 0l-32-120 24-40 49.6-32L272 480zm41.7-298.5c-3.9 11.9-7 24.6-16.5 33.4-10.1 9.3-48 22.4-64-25-2.8-8.4-15.4-8.4-18.3 0-17 50.2-56 32.4-64 25-9.5-8.8-12.7-21.5-16.5-33.4-.8-2.5-6.3-5.7-6.3-5.8v-10.8c28.3 3.6 61 5.8 96 5.8s67.7-2.1 96-5.8v10.8c-.1.1-5.6 3.2-6.4 5.8z">
                                </path>
                            </svg>
                            <span class="link-text">Secret Trading</span>
                        </a>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/home/counselling">
                        <a class="nav-link">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-friends"
                                 class="svg-inline--fa fa-user-friends fa-w-20" role="img"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <path fill="currentColor"
                                      d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z">
                                </path>
                            </svg>
                            <span class="link-text">Casual Counselling</span>
                        </a>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/home/top_up">
                        <a class="nav-link">
                            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="gem"
                                 class="svg-inline--fa fa-gem fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 576 512">
                                <path fill="currentColor"
                                      d="M464 0H112c-4 0-7.8 2-10 5.4L2 152.6c-2.9 4.4-2.6 10.2.7 14.2l276 340.8c4.8 5.9 13.8 5.9 18.6 0l276-340.8c3.3-4.1 3.6-9.8.7-14.2L474.1 5.4C471.8 2 468.1 0 464 0zm-19.3 48l63.3 96h-68.4l-51.7-96h56.8zm-202.1 0h90.7l51.7 96H191l51.6-96zm-111.3 0h56.8l-51.7 96H68l63.3-96zm-43 144h51.4L208 352 88.3 192zm102.9 0h193.6L288 435.3 191.2 192zM368 352l68.2-160h51.4L368 352z">
                                </path>
                            </svg>
                            <span class="link-text">Purchase Vouchers</span>
                        </a>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/home/message">
                        <a class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                                 data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments fa-w-18"
                                 role="img" viewBox="0 0 576 512">
                                <path fill="currentColor"
                                      d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z"/>
                            </svg>
                            <span class="link-text">Chatroom</span>
                        </a>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/home/notification">
                        <a class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="far" data-icon="bell" class="svg-inline--fa fa-bell fa-w-14" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M439.39 362.29c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71zM67.53 368c21.22-27.97 44.42-74.33 44.53-159.42 0-.2-.06-.38-.06-.58 0-61.86 50.14-112 112-112s112 50.14 112 112c0 .2-.06.38-.06.58.11 85.1 23.31 131.46 44.53 159.42H67.53zM224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64z"/></svg>
                            <span class="link-text">Notification</span>
                        </a>
                    </router-link>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" @click="logout()">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sign-out-alt"
                             class="svg-inline--fa fa-sign-out-alt fa-w-16" role="img"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                  d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z">
                            </path>
                        </svg>
                        <span class="link-text">Logout</span>
                    </a>
                </li>
                <li class="nav-item" v-if="this.user.name !== null" @click="logout()">
                    <a href="#" class="nav-link">
                        <avatar :size="45" v-bind:username="this.user.name"></avatar>
                    </a>
                </li>
            </ul>
        </nav>
        <router-view class="main"></router-view>
        <div class="dialog" v-if="this.isDialogWindowOpen">
            <chat-component :user="this.user" class="dialog" v-if="isChatroomSelected"></chat-component>
        </div>
    </div>
</template>

<script>
import Avatar from "vue-avatar/src/Avatar";
import {mapActions} from "vuex";

export default {
    components: {Avatar},
    props: ['user'],
    name: "Home",
    mounted() {
        console.log(`this user ${JSON.stringify(this.user)}`)
        this.$store.dispatch('setAuthUser', this.user.id)
        this.$store.dispatch('setCurrentUser', this.user)
    },
    computed: {
        getActiveUsers() {
            return this.$store.state.activeUsers;
        }
    },
    data() {
        return {
            image_src: 'images/logo.png',
            isDialogWindowOpen: false,
            isChatroomSelected: false,
            isNotificationSelected: false,
            typingTimer: false,
        }
    },
    created() {
        window.Echo.join('message')
            .here(users => {
                //console.log(`echo active users = ${JSON.stringify(users)}`);
                this.$store.dispatch('updateActiveUsers', {users: users});
            })
            .joining(user => {
                this.$store.dispatch('updateActiveUsers', {user: user, isRemove: false});
            })
            .leaving(user => {
                this.$store.dispatch('updateActiveUsers', {user: user, isRemove: true});
            })
            .listen('.message-' + this.user.id, (event) => {
                this.$store.dispatch('updateMessages', event.message);
            })
            .listenForWhisper('typing', user => {
                this.$store.dispatch('setCurrentTypingUser', user);
                if (this.typingTimer) {
                    clearTimeout(this.typingTimer);
                }
                this.typingTimer = setTimeout(() => {
                    this.$store.dispatch('setCurrentTypingUser', false);
                }, 1000);
            })

        window.Echo.join('notification')
            .here(users => console.log('hello from notification'))
            .joining(user => {
                console.log('joining notification channel')
                //this.$store.dispatch('updateNotification', {user: user, isRemove: false});
            })
            .listen('.notification-' + this.user.id, (event) => {
                this.$store.dispatch('updateNotificationState', event.notification);
                this.$bvToast.toast(event.notification.description, {
                    title: event.notification.title,
                    variant: 'info',
                    autoHideDelay: 5000,
                    appendToast: true
                })

            })
    },
    methods: {
        ...mapActions(['updateActiveUsers']),

        openDialogWindow(event) {
            this.isDialogWindowOpen = !this.isDialogWindowOpen;
            switch (event.currentTarget.id) {
                case 'notification' :
                    this.isNotificationSelected = false;
                    this.isChatroomSelected = true;
                    break;
                case 'chatroom' :
                    this.isChatroomSelected = true;
                    this.isNotificationSelected = false;
                    break;
                default:
                    this.isChatroomSelected = false;
                    this.isNotificationSelected = false;

            }
            console.log(this.isDialogWindowOpen)
        },
        logout() {
            if (confirm("Are you sure you want to log out?")) {
                axios.post('logout').then(response => {
                    localStorage.removeItem('auth_token');
                    delete axios.defaults.headers.common['Authorization'];
                    this.$router.push('/logout');
                })
                    .catch(error => {
                        localStorage.removeItem('auth_token');
                        delete axios.defaults.headers.common['Authorization'];
                        this.$router.push('/logout');
                    });
            }
        }

    }
}
</script>

<style scoped>
a:link {
    text-decoration: none;
}

* {
    --bg-primary: #fff;
    --bg-secondary: #d3d8e452;
    --text-primary: #333;
    --text-secondary: #e861a2;
    --transition-speed: 500ms;
    --theme-color: #F63854;
}

.navbar-brand img {
    width: 15rem;
    margin-left: 1rem;
}

.navbar {
    position: fixed;
    background-color: var(--bg-primary);
    transition: width 600ms ease;
    overflow: scroll;
    padding: 5px !important;
    box-shadow: 0 3px 6px 3px rgba(0, 0, 0, 0.06);
    width: 5rem;
    height: 100vh;
    z-index: 99999;
    overflow-y: hidden;
    overflow-x: hidden;
}

.navbar-nav {
    list-style: none;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
}

.nav-item {
    width: 100%;
}

.nav-item:nth-last-child(-n+1) {
    margin-top: auto;
}

.nav-link {
    display: flex;
    align-items: center;
    height: 5rem;
    color: var(--text-primary);
    text-decoration: none;
    filter: grayscale(100%) opacity(0.7) !important;
    transition: var(--transition-speed);
}

.nav-link:active {
    filter: grayscale(0%) opacity(1) !important;
    background: var(--bg-secondary);
    color: var(--bg-secondary);
}

.nav-link:hover {
    filter: grayscale(0%) opacity(1) !important;
    background: var(--bg-secondary);
    color: var(--text-secondary);
}

.nav-link .vue-avatar--wrapper {
    margin: 0 1rem;
}

.link-text {
    display: none;
    margin-left: 1rem;
    min-width: 10rem;
}

.nav-link svg {
    width: 2rem;
    min-width: 2rem;
    margin: 0 1.5rem;
}

.main {
    margin-left: 5rem;
}

.dialog {
    width: 300px;
    height: 500px;
    position: fixed;
    top: 70px;
    right: 50px;
    border: var(--theme-color);
}

.nav-item {
    /*margin-right: 1%;*/
}

.navbar:hover {
    width: 18rem;
    padding-left: 1rem;
}

.navbar:hover .link-text {
    display: block;
    margin-left: 1rem;
    min-width: 10rem;
}

.navbar:hover .logo svg {
    margin-left: 11rem;
}

.navbar:hover .logo-text {
    left: 0px;
}

.navbar-nav .nav-item .icon .b-icon {
    color: #F63854;
    font-size: 25px;
}

/*    .navbar-nav .nav-item .vue-avatar--wrapper {
        width: 45px;
        height: 45px;
    }*/

.navbar-nav .nav-item .icon {
    text-align: center;
    border: 1px solid #f2dede;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    margin: 0 auto;
    padding-top: 17%
}

.navbar-nav .nav-item .icon .badge {
    border-radius: 50%;
    margin-left: 25px;
}
</style>
