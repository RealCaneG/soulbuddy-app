<template>
    <page-template>
        <h2 slot="bannerHeader">Counselling</h2>
        <p slot="bannerDescription">Seek Comfort from Your Soul Buddy in an Anonymous, affordable and Private Way</p>
        <div slot="tools">
            <div class="row">
                <div class="col-md-8 tools-desc"><p>Match you to a request that you can help with..</p></div>
                <b-form-select class="col-md-4" :options="this.categories" v-model="category"></b-form-select>
            </div>

            <div class="wrapper-center">
                <b-button v-b-modal.create-request-modal @click="$bvModal.show('create-request-modal')">Raise Your
                    Request
                </b-button>
            </div>
            <b-modal class="dialog" busy="true" centered id="create-request-modal">
                <template v-slot:modal-title>
                    <h2>Counselling Request</h2>
                </template>
                <create-counselling-request :all-categories="categories"
                                            v-on:onSubmit="submitForm"></create-counselling-request>
                <template v-slot:modal-footer>
                    <p>Please fill out the form above to request a casual counselling and connect to your soul buddy.
                        Each successfully matched counselling will cost 5 vouchers from your account</p>
                </template>
            </b-modal>
        </div>
        <template>
            <all-counselling-request slot="content" :category="category"></all-counselling-request>
        </template>
    </page-template>
</template>

<script>
    import PageTemplate from "../components/pageTemplate";
    import CreateCounsellingRequest from "../components/CreateCounsellingRequest";

    export default {
        name: "Counselling",
        components: {CreateCounsellingRequest, PageTemplate},
        data() {
            return {
                categories: this.$store.state.categories,
                category: null,
                isLoading: false,
            }
        },
        mounted() {
            if (this.$store.state.categories.length <= 1)
                this.$store.dispatch('getCategories');
        },
        methods: {
            openDialog() {

            },
            submitForm(formData) {
                this.isLoading = true;
                axios.post('/counselling/create_counselling_request',
                    formData).then(response => {
                    this.$bvModal.hide('create-request-modal');
                    this.$store.dispatch('refreshCounsellingRequest', 1);
                    this.isLoading = false;
                })
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
