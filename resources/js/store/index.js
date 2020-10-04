import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    state: {
        user: null,
        isLoading: false,
        currentUser: null,
        activeUsers: [],
        userId: null,
        articles: [],
        secrets: [],
        userUnlockedSecrets: [],
        counsellingRequests: [],
        messages: [],
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
            return commit('updateMessages', message)
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
        async getAllMessages({commit}, userId) {
            return commit('setMessages', await axios.get('/messages/get_with_user_id', {
                    params: {user_id: userId}
                }
            ))
        },
        async getAllNotifications({commit}) {
            return commit('setNotifications', await axios.get('/notifications/get_all'))
        }
    },

    mutations: {
        updateActiveUsers(state, payload) {
            if (payload.users !== undefined) {
                state.activeUsers = payload.users
            } else if (!payload.isRemove && !state.activeUsers.some(user => user.id === payload.user.id)) {
                state.activeUsers.push(payload.user);
            } else {
                state.activeUsers = state.activeUsers.filter(u => u.id !== payload.user.id);
            }
        },

        updateMessages(state, message) {
            console.log('msg = ', message);
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
        updateUserUnlockedSecrets(state, secretId) {
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
            console.log('state messages = ', response.data.data);
            if (response.data.data) {
                state.messages = response.data.data;
            }
            let users = [];
            Object.keys(state.messages).forEach(function (key) {
                users[key] = state.messages[key][0].user.id === key ?
                    state.messages[key][0].user.name : state.messages[key][0].to_user.name;
            })
            state.usersWithPreviousConversation.push(users);
        },
        setAuthUser(state, userId) {
            state.userId = userId;
        },
        setCurrentUser(state, user) {
            state.currentUser = user;
        },
        setNotifications(state, response) {
            state.notifications = response.data.data;
        },
        setUserUnlockSecret(state, response) {
            state.userUnlockedSecrets = response.data.data.map(d => d.secret_id);
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
