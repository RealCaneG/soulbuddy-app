<template>
    <page-template>
        <h2 slot="bannerHeader">Articles</h2>
        <p slot="bannerDescription"></p>
        <div slot="tools">
            <div class="row">
                <div class="col-md-8 tools-desc"><p></p></div>
                <b-form-select class="col-md-4" :options="this.categories" v-model="category"></b-form-select>
            </div>

            <div class="wrapper-center">
                <b-button v-b-modal.create-article-modal @click="$bvModal.show('create-article-modal')">Write an
                    Article
                </b-button>
            </div>
            <b-modal class="dialog" busy="true" centered id="create-article-modal">
                <template v-slot:modal-title>
                    <h2>Write an Article</h2>
                    <!---->
                </template>
                <create-article-component
                    v-on:onSubmit="submitForm"></create-article-component>
                <template v-slot:modal-footer>
                    <p></p>
                </template>
            </b-modal>
        </div>
        <template>
            <all-articles-component slot="content" :category="category"></all-articles-component>
        </template>
    </page-template>
</template>

<script>
    import PageTemplate from "../components/pageTemplate";

    export default {
        name: "Article",
        components: {PageTemplate},
        data() {
            return {
                categories: this.$store.state.categories,
                category: null,
            }
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
                    .post("/article/create_article", formData, {
                        headers: {"Content-Type": "multipart/form-data"}
                    })
                    .then(res => {
                        this.$bvModal.hide('create-article-modal');
                        this.$store.dispatch('refreshArticles', 1)
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
