<template>
    <div class="row list" v-infinite-scroll="loadSecrets" infinite-scroll-throttle-delay="3000">
        <div class="col-md-12 list-item" v-for="(secret, i) in secrets" :key=i>
            <component :is="secretComponent(secret.id)" v-bind="{secret: secret}"
                       v-on:handleSecret="handleSecret(i)"></component>
        </div>
        <el-dialog v-if="currentSecret" :visible.sync="secretDialogVisible" width="70%">
            <div>
                <h3>
                    {{ currentSecret[0].title }}
                </h3>
                <hr>
                <p>{{ currentSecret[0].body }}</p>
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
                userUnlockedSecrets: this.$store.state.userUnlockedSecrets,
            };
        },
        computed: {
            secrets() {
                if (this.category === null) return this.$store.state.secrets;
                return this.$store.state.secrets.filter(secret => secret.category.id === this.category);
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
            viewSecret(index) {
                this.currentSecret = this.secrets[index]
                this.secretDialogVisible = true;
            },
            loadSecrets() {
                this.page++;
                this.getSecrets();
            },
            handleSecret(secretId) {
                if (this.userUnlockedSecrets.includes(secretId)) {
                    this.viewSecret(secretId)
                }
                let formData = new FormData();
                formData.append('secret_id', secretId);
                axios.post('/secret/unlock_secret', formData, {
                    headers: {"Content-Type": "multipart/form-data"}
                })
                    .then(res => {
                        if (res.status === 200) {
                            this.update(secretId);
                        }
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

    .profile {
        display: flex;
    }
</style>
