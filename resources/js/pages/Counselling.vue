<template>
    <page-template>
        <div slot="bannerHeader" class="banner">
        </div>
<!--        <p slot="bannerDescription">Seek Comfort from Your Soul Buddy in an Anonymous, affordable and Private Way</p>-->
        <div slot="tools" class="tool-container">
            <div class="category-container">
                <div class="tools-desc">Match you to a request that you can help with..</div>
                <b-form-select :options="this.categories" v-model="category"></b-form-select>
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

    .banner {
        background-image: url("/images/counselling-banner.jpg");
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
