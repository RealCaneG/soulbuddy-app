<template>
    <page-template>
        <h2 slot="bannerHeader">Secrets</h2>
        <p slot="bannerDescription"></p>
        <div slot="tools">
            <!-- <div class="row">
                 <div class="col-md-8 tools-desc"><p></p></div>
                 <b-form-select class="col-md-4" :options="this.categories" v-model="category"></b-form-select>
             </div>-->

            <div class="wrapper-center">
                <b-button v-b-modal.create-secret-modal @click="$bvModal.show('create-secret-modal')">Write a
                    Secret
                </b-button>
            </div>
            <b-modal class="dialog" busy="true" centered id="create-secret-modal">
                <template v-slot:modal-title>
                    <h2>Write an Secret</h2>
                    <!---->
                </template>
                <create-secret-component
                    v-on:onSubmit="submitForm"></create-secret-component>
                <template v-slot:modal-footer>
                    <p></p>
                </template>
            </b-modal>
        </div>
        <template>
            <all-secrets-component slot="content"></all-secrets-component>
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
                categories: [{text: 'Choose', value: null}],
                category: null,
            }
        },
        beforeMount() {
            this.$store.dispatch('getUserUnlockedSecrets');
        },
        async mounted() {
            const res = await axios.get('/counselling/get_categories');
            console.log(res.data);
            res.data.forEach(cat => this.categories.push({'text': cat.category, 'value': cat.id}))
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
            },
        }
    }
</script>

<style scoped>
    .dialog {
        margin-top: 5rem;
    }

    .wrapper-center {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .tools-desc {
        text-align: right;
    }
</style>
