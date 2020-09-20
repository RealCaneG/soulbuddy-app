<template>
    <div>
        <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar bg-white top-nav-collapse">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a href="/" class="navbar-brand"><img src='/images/logo.png' alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="lni-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <b-navbar-nav>
                    <li class="nav-item">
                        <router-link to="/home/articles"><a class="nav-link">Articles</a></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/home/secrets"><a class="nav-link">Secrets</a></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/home/counselling"><a class="nav-link">Counselling</a></router-link>
                    </li>
                </b-navbar-nav>
                <ul class="navbar-nav mr-auto w-100 justify-content-end clearfix">
                    <li class="nav-item" style="align-items: center">
                        <div id="notification" class="icon" @click="openDialogWindow($event)">
                            <b-icon icon="bell"></b-icon>
                            <b-badge variant="danger" class="badge-circle badge-sm badge-floating border-white">4
                            </b-badge>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div id="chatroom" class="icon" @click="openDialogWindow($event)">
                            <b-icon icon="chat"></b-icon>
                        </div>
                    </li>
                    <li class="nav-item" v-if="this.user.name !== null" @click="logout()">
                            <avatar :size="45" v-bind:username="this.user.name"></avatar>
                    </li>
                </ul>
            </div>
        </nav>
        <router-view class="content">
        </router-view>
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
            this.$store.dispatch('setAuthUser', this.user.id)
        },
        computed: {
            getActiveUsers() {
                return this.$store.state.activeUser;
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
                    console.log('echo users =', users);
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
                    this.$store.dispatch('setCurrentUser', user);
                    if (this.typingTimer) {
                        clearTimeout(this.typingTimer);
                    }
                    this.typingTimer = setTimeout(() => {
                        this.$store.dispatch('setCurrentUser', false);
                    }, 1000);
                })

            window.Echo.join('notification')
                .joining(user => {
                    this.$store.dispatch('updateNotification', {user: user, isRemove: false});
                })
                .listen('.notification-' + this.user.id, (event) => {
                    this.$store.dispatch('updateNotification', event.notification);
                })
                .listenForWhisper('typing', user => {
                    this.$store.dispatch('setCurrentUser', user);
                    if (this.typingTimer) {
                        clearTimeout(this.typingTimer);
                    }
                    this.typingTimer = setTimeout(() => {
                        this.$store.dispatch('setCurrentUser', false);
                    }, 1000);
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

    .navbar-brand img {
        width: 140px;
        height: 28px;
    }

    .navbar-expand-md .navbar-nav .nav-link {
        color: #333;
        font-weight: 300;
        cursor: pointer;
        position: relative;
        background: transparent;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        text-align: center;
        font-family: arvo, 'SansSerif', serif;
        font-size: 15px;
    }

    .navbar-expand-md .navbar-nav .nav-link:before {
        background-color: #F63854;
        content: '';
        display: block;
        height: 2px;
        position: absolute;
        margin: 0 auto;
        width: 0;
        top: 35px;
        left: 0;
        right: 0;
        bottom: 0;
        transition: width 1s;
        -ms-transition: width 1s;
        -webkit-transition: width 1s;
    }

    .navbar-expand-md .navbar-nav .active > .nav-link,
    .navbar-expand-md .navbar-nav .nav-link.active,
    .navbar-expand-md .navbar-nav .nav-link.open,
    .navbar-expand-md .navbar-nav .open > .nav-link {
        color: #F63854 !important;
        width: 100%;
    }

    .navbar-expand-md .navbar-nav .nav-link:hover,
    .navbar-expand-md .navbar-nav .nav-link:hover::before,
    .navbar-expand-md .navbar-nav .nav-link:focus {
        color: #F63854;
        width: 100%;
        transition: width 1s;
        -webkit-transition: width 1s;
    }

    .content {
        padding: 5% 10%
    }

    .dialog {
        width: 300px;
        height: 500px;
        position: fixed;
        top: 70px;
        right: 50px;
        border: #F63854;
    }

    .nav-item {
        margin-right: 1%;
    }

    .navbar {
        background: #fff;
        z-index: 999999;
        padding: 5px !important;
        top: 0px !important;
        box-shadow: 0px 3px 6px 3px rgba(0, 0, 0, 0.06);
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
