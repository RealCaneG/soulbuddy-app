<template>
    <div class="row list" v-infinite-scroll="loadSecrets" infinite-scroll-throttle-delay="3000">
        <div class="col-md-4 list-item" v-for="(secret, i) in secrets" :key=i>
            <component :is="secretComponent(secret.id)" v-bind="{secret: secret}"
                       v-on:handleSecret="handleSecret(secret.id)"></component>
        </div>
        <el-dialog v-if="currentSecret" :visible.sync="secretDialogVisible" width="70%">
            <div>
                <h3>
                    {{ currentSecret.title }}
                </h3>
                <hr>
                <p>{{ currentSecret.body }}</p>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button type="primary" @click="secretDialogVisible = false">Close</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
    import LockedSecret from "./lockedSecret";
    import {mapActions} from "vuex";

    export default {
        components: {LockedSecret},
        name: "all-secrets",
        props: ['category'],
        data() {
            return {
                secretDialogVisible: false,
                isLoading: false,
                currentSecret: '',
                numOfItems: 30,
                page: 1,
            };
        },
        computed: {
            secrets() {
                if (this.category === null) return this.$store.state.secrets;
                return this.$store.state.secrets.filter(secret => secret.category.id === this.category);
            },
            userUnlockedSecrets() {
                return this.$store.state.userUnlockedSecrets;
            }
        },
        beforeMount() {
            this.getSecrets();
        },
        methods: {
            ...mapActions({
                update: 'updateUserUnlockedSecrets',
                get: 'getPaginatedSecrets'
            }),
            secretComponent(secretId) {
                return this.userUnlockedSecrets.includes(secretId) ? 'unlocked-secret' : 'locked-secret';
            },
            viewSecret(secretId) {
                this.currentSecret = this.secrets.find(secret => secret.id === secretId)
                this.secretDialogVisible = true;
            },
            loadSecrets() {
                this.page++;
                this.getSecrets();
            },
            handleSecret(secretId) {
                console.log(`unlocked secrets id: ${this.userUnlockedSecrets}`)
                if (this.userUnlockedSecrets.includes(secretId)) {l
                    this.viewSecret(secretId)
                    return;
                }
                let formData = new FormData();
                formData.append('secret_id', secretId);
                axios.post('/secret/unlock_secret', formData, {
                    headers: {"Content-Type": "multipart/form-data"}
                })
                    .then(res => {
                        if (res.status === 200) {
                            this.update(secretId);
                            this.$bvToast.toast(`You have successfully unlock the secret!`, {
                                title: 'Success',
                                variant: 'success',
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
            getSecrets() {
                this.isLoading = true;
                this.get(this.page).then(() => {
                    this.isLoading = false;
                });
            }
        },
    }
</script>

<style scoped>
    .info {

    }

    .description {

    }

    /* toast action */
    .toasted .primary .action,
    .toasted.toasted-primary .action {
        color: #202f36 !important;
    }

    /* toast container */
    .toasted .primary,
    .toasted.toasted-primary {
        font-weight: 500 !important;
        padding: 6px 30px !important;
        /* border-radius: 999px !important; */
    }

    /* success toast */
    .toasted .primary.success,
    .toasted.toasted-primary.success {
        background: #4db76d !important;
        box-shadow: 0px 6px 16px rgba(94, 203, 127, 0.5) !important;
    }

    .profile {
        display: flex;
    }
</style>
