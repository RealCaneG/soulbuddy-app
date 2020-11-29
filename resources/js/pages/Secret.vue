<template>
    <page-template>
        <div slot="bannerHeader" class="banner"/>
        <div slot="tools" class="tool-container">
            <div class="category-container">
                <div class="tools-desc"/>
                <b-form-select :options="this.categories" v-model="category"></b-form-select>
            </div>

            <div class="wrapper-center">
                <b-button v-b-modal.create-secret-modal @click="$bvModal.show('create-secret-modal')">Write a
                    Secret
                </b-button>
            </div>
            <b-modal class="dialog" busy="true" centered id="create-secret-modal">
                <template v-slot:modal-title>
                    <h2>Write an Secret</h2>
                </template>
                <create-secret-component
                    v-on:onSubmit="submitForm"></create-secret-component>
                <template v-slot:modal-footer>
                    <p></p>
                </template>
            </b-modal>
        </div>
        <template>
            <all-secrets-component slot="content" :category="category"></all-secrets-component>
        </template>
    </page-template>
</template>

<script>
    import PageTemplate from "../components/pageTemplate";

    export default {
        name: "Secret",
        components: {PageTemplate},
        data() {
            return {
                categories: this.$store.getters.getCategories,
                category: null,
            }
        },
        beforeMount() {
            this.$store.dispatch('getUserUnlockedSecrets');
        },
        mounted() {
            if (this.$store.state.categories.length <= 1) {
                this.$store.dispatch('getCategories')
            }
        },
        methods: {
            openDialog() {

            },
            submitForm(formData) {
                axios
                    .post("/secret/create_secret", formData, {
                        headers: {"Content-Type": "multipart/form-data"}
                    })
                    .then(res => {
                        this.$bvModal.hide('create-secret-modal');
                        this.$store.dispatch('refreshSecrets', 1)
                    });
            }
            ,
        }
    }
</script>

<style scoped>
    .dialog {
        margin-top: 5rem;
    }

    .banner {
        background-image: url("/images/secret-banner.jpg");
        background-repeat: no-repeat;
        background-size: 100%;
        background-position: center;
        height: 30%;
        overflow: hidden;
    }

    .tool-container {
        text-align: center;
    }

    .tools-desc {
        text-align: right;
        font-family: 'Arvo', serif;
        font-weight: 600;
        font-size: .9rem;
        margin-right: 1rem;
    }

    button {
        text-align: center;
        font-size: 1rem;
        color: white;
        padding: 0.5rem 3rem;
        border: 1px solid #F63854;
        border-radius: 2rem;
        background-color: #f63854;
    }

    button:hover {
        color: white;
        background-color: #F63854;
    }

    button:focus {
        outline: none;
    }

    .category-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }
</style>
