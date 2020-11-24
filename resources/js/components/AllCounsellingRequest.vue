<template>
    <div class="row list" v-infinite-scroll="loadRequests" infinite-scroll-throttle-delay="3000">
        <div class="col-md-4 list-item" v-for="(request, i) in counsellingRequests" :key=i>
            <div class="main">
                <div class="header">
                    <p class="h1 mb-2">
                        <b-icon :icon="getRequestIcon(request.category)"></b-icon>
                        {{ request.category.category }}
                    </p>
                </div>
                <div class="body">
                    <div>
                        <p @click="viewRequest(i)"><strong>{{ request.subject }}</strong> <br>
                            {{ truncateText(request.description, 0, 30) }}
                        </p>
                    </div>
                    <div class="button-container">
                        <button class="button" @click="acceptRequest(request.id, request.owner.id)">
                            <b-icon-chat-dots/>
                            Chat
                        </button>
                    </div>
<!--                    <b-modal id="modal-1" title="BootstrapVue" :visible.sync="confirmBoxVisible">
                        <p class="my-4">Hello from modal!</p>
                    </b-modal>-->
                </div>
                <div class="footer">
                    <div class="info-container">
                        <div class="d-flex profile-inline">
                            <avatar v-bind:username="request.owner.name"></avatar>
                            <div class="infos">
                                <div class="name"> by {{ request.owner.name }}</div>
                                <div>expire on {{ dateFormat(request.expiry_date) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <el-dialog v-if="currentRequest" :visible.sync="requestDialogVisible" width="40%">
            <div>
                <h3>
                    {{ currentRequest.subject }}
                </h3>
                <hr>
                <p>{{ currentRequest.description }}</p>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button type="primary" @click="requestDialogVisible = false">Close</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
import {articleMixin} from "../helpers/articleMixin";
import {mapActions} from "vuex";
import Avatar from "vue-avatar/src/Avatar";
import moment from "moment";

export default {
    props: ["category"],
    components: {Avatar},
    mixins: [articleMixin],
    name: "all-counselling-request",
    data() {
        return {
            isLoading: false,
            requestDialogVisible: false,
            confirmBoxVisible: false,
            currentRequest: '',
            numOfItems: 30,
            page: 1,
        };
    },
    computed: {
        counsellingRequests() {
            console.log(this.$store.state.counsellingRequests)
            if (this.category === null)
                return this.$store.state.counsellingRequests;
            return this.$store.state.counsellingRequests.filter(request => request.category.id === this.category)
        },
    },
    beforeMount() {
        this.getRequests();
    },
    methods: {
        ...mapActions({get: 'getPaginatedCounsellingRequest'}),
        confirmRequest(isConfirm) {
            this.confirmBoxVisible = !this.confirmBoxVisible;
        },
        acceptRequest(requestId, clientId) {
            let formData = new FormData();
            formData.append('request_id', requestId);
            formData.append('client_id', clientId)
            axios.post('/counselling/accept_request', formData, {
                headers: {"Content-Type": "multipart/form-data"}
            })
                .then(res => {
                    if (res.status === 200 && !res.data.error) {
                        this.$bvToast.toast(`Thank you for offering a helping hand, you can start chatting once the client approve the request!`, {
                            title: 'Info',
                            variant: 'info',
                            autoHideDelay: 5000,
                            appendToast: true
                        })
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
                this.$bvToast.toast(exp.response.data.message, {
                    title: 'Error',
                    variant: 'warning',
                    autoHideDelay: 5000,
                    appendToast: true
                })
            })
        },
        getRequestIcon(category) {
            let icon = 'question-circle-fill';
            switch (category.category) {
                case 'Love':
                    icon = 'heart-fill';
                    break;
                case 'Family':
                    icon = 'house-door-fill';
                    break;
                case 'Career':
                    icon = 'briefcase-fill';
                    break;
                case 'Mood':
                    icon = 'lightning-fill';
                    break;
                case 'Friendship':
                    icon = 'people-fill';
                    break;
                case 'Others':
                    icon = 'question-circle-fill';
                    break;
                case 'School':
                    icon = 'book';
                    break;
                default:
                    icon = 'question-circle-fill';
                    break;
            }

            return icon;
        },

        dateFormat(timestamp) {
            if (timestamp) {
                return moment(String(timestamp)).format('MM/DD/YYYY')
            }
        },

        viewRequest(requestIndex) {
            this.currentRequest = this.requests[requestIndex];
            this.requestDialogVisible = true;
        },

        loadRequests() {
            this.page++;
            this.getRequests();
        },

        getRequests() {
            this.isLoading = true;
            this.get(this.page);
        }
    },
}
</script>
<style scoped>
.footer {
    margin-bottom: 2rem;
}

.article-img {
    height: 300px;
    width: 100%;
}

.star-rating {
    padding-left: 1.5rem;
}

.article-img-secondary {
    width: 100%;
}

.main {
    box-shadow: 0 10px 15px 0 rgba(46, 51, 51, .27);
    border-radius: 1rem;
    overflow: hidden;
    margin-bottom: 1rem;
    min-height: 25rem;
    display: flex;
    flex-flow: column;
    justify-content: space-around;
}

.button-container {
    padding: 1rem 1rem;
    text-align: center;
}

button {
    text-align: center;
    font-size: 1rem;
    color: #F63854;
    padding: 0.5rem 3rem;
    border: 1px solid #F63854;
    border-radius: 2rem;
}

button:hover {
    color: white;
    background-color: #F63854;
}

button:focus {
    outline: none;
}

.body {
    padding: 1rem;
    font-size: 1.2rem;
    max-width: 50rem;
    font-family: Arvo, SansSerif, Sana, serif;
    color: #484848;
    display: flex;
    flex-flow: column;
    justify-content: space-between;
    height: 15rem;
}

.header {
    padding-top: 1rem;
    text-align: center;
    font-family: Arvo, serif;
    font-size: 1.5rem;
    font-weight: 700;
}

.infos {
    margin-top: auto;
    margin-bottom: auto;
    margin-left: 10px;
    font-size: 12px;
    font-family: Arvo, serif;
    font-weight: 700;
    color: #6c757d;
}

.info-container {
}

.profile-inline {
    padding: 20px;
}
</style>
