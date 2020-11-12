import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    state: {
        currentUser: null,
        isLoading: false,
        currentTypingUser: null,
        activeUsers: [],
        approvedUsers: [],
        userId: null,
        articles: [],
        secrets: [],
        userUnlockedSecrets: [],
        counsellingRequests: [],
        messages: null,
        notifications: [],
        usersWithPreviousConversation: [],
        categories: [{text: 'Choose', value: null}],
    },

    actions: {
        setAuthUser({commit}, userId) {
            return commit('setAuthUser', userId)
        },
        async getCategories({commit}) {
            return commit('setCategories', await axios.get('/counselling/get_categories'))
        },

        async getUserUnlockedSecrets({commit}) {
            return commit('setUserUnlockSecret', await axios.get('/secret/get_user_unlocked_secrets'))
        },

        async getUserContactList({commit}) {
            return commit('SET_APPROVED_USER_LIST', await axios.get('/messages/get_approved_users'))
        },

        async updateApprovedUserList({commit}, userId) {
            return commit('updateApprovedUserList', await axios.get('/counselling/'))
        },

        setCurrentTypingUser({commit}, user) {
            return commit('setCurrentTypingUser', user)
        },

        setCurrentUser({commit}, user) {
            return commit('setCurrentUser', user)
        },

        updateActiveUsers({commit}, payload) {
            return commit('updateActiveUsers', payload)
        },

        updateUserUnlockedSecrets({commit}, secretId) {
            return commit('updateUserUnlockedSecrets', secretId);
        },

        updateMessages({commit}, message) {
            return commit('UPDATE_MESSAGES', message)
        },

        updateNotificationState({commit}, notification) {
            return commit('UPDATE_NOTIFICATION_STATE', notification)
        },
        async updateNotificationStatus({commit}, payload) {
            return commit('UPDATE_NOTIFICATION_STATUS', await axios.post('/notification/update_notification_status', payload,
                {
                    headers: {"Content-Type": "multipart/form-data"}
                }))
        },
        async dismissNotification({commit}, payload) {
            return commit('DISMISS_NOTIFICATION_BY_ID', await axios.post('/notification/update_notification_status', payload,
                {
                    headers: {"Content-Type": "multipart/form-data"}
                }))
        },
        async getAllArticles({commit}) {
            return commit('setArticles', await axios.get('/article/get_all'))
        },
        async getPaginatedArticles({commit}, page) {
            return commit('setArticles', await axios.get('/article/get_paginated_articles?page=' + page))
        },
        async getPaginatedSecrets({commit}, page) {
            return commit('setSecrets', await axios.get('/secret/get_paginated_secrets?page=' + page))
        },
        async getPaginatedCounsellingRequest({commit}, page) {
            return commit('setCounsellingRequest', await axios.get('/counselling/get_paginated_request?page=' + page))
        },
        async refreshArticles({commit}, page) {
            return commit('refreshArticles', await axios.get('/article/get_paginated_articles?page=' + page))
        },
        async refreshSecrets({commit}, page) {
            return commit('refreshSecrets', await axios.get('/secret/get_paginated_secrets?page=' + page))
        },
        async refreshCounsellingRequest({commit}, page) {
            return commit('refreshCounsellingRequest', await axios.get('/counselling/get_paginated_request?page=' + page))
        },
        async getAllMessages({commit}) {
            return commit('setMessages', await axios.get('/messages/get_with_user_id'))
        },
        async getAllUnreadNotifications({commit}) {
            return commit('setNotifications', await axios.get('/notification/get_all'))
        },
    },

    mutations: {
        DISMISS_NOTIFICATION_BY_ID(state, response) {
            if (response.data.error === true) return;
            let notification = response.data.data;
            state.notifications.forEach((n, index) => {
                if (n.id === notification.id) {
                    state.notifications.splice(index, 1);
                }
            })
        },

        updateActiveUsers(state, payload) {
            if (payload.users !== undefined) {
                state.activeUsers = payload.users
            } else if (!payload.isRemove && !state.activeUsers.some(user => user.id === payload.user.id)) {
                state.activeUsers.push(payload.user);
            } else {
                state.activeUsers = state.activeUsers.filter(u => u.id !== payload.user.id);
            }
        },

        UPDATE_MESSAGES(state, message) {
            console.log('msg = ', message);
            console.log('state user id', state.userId)
            console.log(JSON.stringify(state.messages))
            console.log(state.messages)
            if (state.userId === message.user_id) {
                if (state.messages[message.to_user_id])
                    state.messages[message.to_user_id].push(message);
                else state.messages.map((e) => {
                    let o = Object.assign({}, e);
                    o.message.to_user_id = message;
                    return o;
                })
            } else {
                if (state.messages[message.user_id]) {
                    state.messages[message.user_id].push(message);
                } else {
                    state.messages.map((e) => {
                        let o = Object.assign({}, e);
                        o.message.user_id = message;
                        return o;
                    })
                }
            }
        },
        UPDATE_NOTIFICATION_STATE(state, notification) { // remove notification from list
            if (state.notifications.find(n => n.id === notification.id)) return;
            state.notifications = [...state.notifications, notification];
        },
        UPDATE_NOTIFICATION_STATUS(state, response) { // remove notification from list
            console.log({response})
            if (response.data.error === true) return;
            let notification = response.data.data;
            let isRead = notification.is_read === '1';
            console.log({isRead});
            if (!isRead) return;
            state.notifications.forEach((n, index) => {
                if (n.id === notification.id) {
                    state.notifications.splice(index, 1);
                }
            })
        },
        updateUserUnlockedSecrets(state, secretId) {
            if (state.userUnlockedSecrets.find(s => s === secretId)) return;
            state.userUnlockedSecrets.push(secretId);
            console.log(state.userUnlockedSecrets);
        },
        setArticles(state, response) {
            //console.log('data = ', response.data.data.data);
            if (state.articles.length === 0) {
                state.articles = response.data.data.data;
            } else state.articles = [...state.articles, ...response.data.data.data]
        },
        refreshArticles(state, response) {
            state.articles = [];
            state.articles = response.data.data.data;
        },
        setSecrets(state, response) {
            if (state.secrets.length === 0) {
                state.secrets = response.data.data.data;
            } else state.secrets = [...state.secrets, ...response.data.data.data]
        },
        refreshSecrets(state, response) {
            state.secrets = [];
            state.secrets = response.data.data.data;
        },
        setCounsellingRequest(state, response) {
            if (state.counsellingRequests.length === 0) {
                state.counsellingRequests = response.data.data.data;
            } else state.counsellingRequests = [...state.counsellingRequests, ...response.data.data.data]
        },
        refreshCounsellingRequest(state, response) {
            state.counsellingRequests = [];
            state.counsellingRequests = response.data.data.data;
        },
        setMessages(state, response) {
            let fetchedMessages = response.data.data;
            console.log('fetched messages = ', fetchedMessages);
            if (fetchedMessages) {
                state.messages = fetchedMessages;
                console.log('fetched messages = ');
                console.log(state.messages);
            }
/*            let users = [];
            Object.keys(state.messages).forEach((key) => {
                users[key] = state.messages[key][0].owner.id === key ?
                    state.messages[key][0].owner.name : state.messages[key][0].to_user.name;
            })
            state.usersWithPreviousConversation.push(users);*/
        },
        SET_APPROVED_USER_LIST(state, response) {
            if (response.data.data) {
                state.approvedUsers = response.data.data;
            }
        },
        setAuthUser(state, userId) {
            state.userId = userId;
        },
        setCurrentTypingUser(state, user) {
            state.currentTypingUser = user;
        },
        setCurrentUser(state, user) {
            state.currentUser = user;
        },
        setNotifications(state, response) {
            console.log(`response from get all notification ${JSON.stringify(response)}`)
            console.log({response})
            state.notifications = response.data.data;
        },
        setUserUnlockSecret(state, response) {
            let userUnlockedSecretIds = [];
            response.data.data.map(d => {
                userUnlockedSecretIds.push(d.secret_id)
            });
            console.log(`finished looping ${userUnlockedSecretIds}`)
            state.userUnlockedSecrets = userUnlockedSecretIds;
            console.log(`the state ${state.userUnlockedSecrets}`)
        },
        setCategories(state, response) {
            let categories = state.categories;
            response.data.forEach(cat => categories.push({'text': cat.category, 'value': cat.id}));
            state.categories = categories;
        }
    },
    getters: {
        isLoggedIn(state) {
            return state.userId !== null;
        },

        getCategories(state) {
            return state.categories;
        },

        getAuthUser(state) {
            return state.userId;
        },

        getCurrentUser(state) {
            return state.currentUser;
        },

        getCurrentTypingUser(state) {
            return state.currentTypingUser;
        },

        getMessages(state) {
            return state.messages;
        },

        getActiveUsers(state) {
            return state.activeUsers;
        },

        getNotifications(state) {
            return state.notifications;
        }
    },

    strict: debug
});
