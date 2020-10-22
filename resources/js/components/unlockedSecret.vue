<template>
    <div>
        <div class="main" @click="handleSecret">
            <div class="top-container">
                <div>
                    <div class="header">
                        <div style="text-align: left">
                            [{{this.secret.category.category}}]
                        </div>
                        <div>
                            {{ truncateText(this.secret.title, 0, 60) }}
                        </div>
                    </div>
                    <div class="body">
                        <p> {{ truncateText(secret.body, 0, 80) }}</p>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="info-container">
                    <div class="d-flex profile-inline">
                        <avatar v-bind:username="this.secret.author.name"></avatar>
                        <div class="infos">
                            <div class="name"> by {{ this.secret.author.name }}</div>
                            <div> available until {{ dateFormat(secret.expiry_date) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Avatar from "vue-avatar/src/Avatar";
    import {articleMixin} from "../helpers/articleMixin";

    export default {
        name: "unlockedSecret",
        components: {Avatar},
        props: ['secret'],
        mixins: [articleMixin],
        methods: {
            handleSecret() {
                this.$emit('handleSecret', this.secret.id);
            },
        },
    }
</script>

<style scoped>
    .main {
        padding: 1rem;
        box-shadow: 0 10px 15px 0 rgba(46, 51, 51, .27);
        border-radius: 1rem;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .body {
        padding-top: 1.9rem;
        font-size: .8rem;
        max-width: 50rem;
        font-family: Arvo, SansSerif, Sana, serif;
        color: #484848;
    }

    .header {
        text-align: left;
        font-family: Arvo, serif;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .top-container {
        display: flex;
        flex-direction: row;
        padding: 1rem;
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

    .unlock {
        display: flex;
        flex-direction: column;
    }

    .unlock label {
        font-size: .8rem;
        color: #F63854;
        text-align: center;
    }

    .info-container {
    }

    .profile-inline {
        padding: 20px;
    }
</style>
