<template>
    <div class="row list" v-infinite-scroll="loadArticles" infinite-scroll-throttle-delay="3000">
        <div class="col-md-4 list-item mt-3" v-for="(article, i) in articles" :key=i>
            <article-listing-base v-bind:article="article" v-on:viewArticle="viewArticle(i)">
            </article-listing-base>
        </div>
        <el-dialog v-if="currentArticle" :visible.sync="articleDialogVisible" width="70%">
            <div class="dialog-main">
                <div>
                    <div class="header">{{ currentArticle.title }}</div>
                    <div class="info-container">
                        <div class="d-flex profile-inline">
                            <avatar v-bind:username="currentArticle.author.name"></avatar>
                            <div class="infos">
                                <div class="name">{{ currentArticle.author.name }}</div>
                                <div>{{ dateFormat(currentArticle.created_at) }}</div>
                            </div>
                        </div>
                        <customized-star-rating class="rating" :object="currentArticle" :type="article"></customized-star-rating>
                    </div>
                    <div class="pictures">
                        <div class="picture col-md-6" v-for="(img, i) in currentArticle.article_images" :key=i>
                            <img :src="img.article_image_path" class="img-thumbnail" alt="">
                        </div>
                    </div>
                    <div class="body">
                        <p> {{ currentArticle.body }} </p>
                    </div>
                </div>
            </div>
            <div slot="footer" class="dialog-footer">
                <el-button type="primary" @click="articleDialogVisible = false">Close</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    import {articleMixin} from "../helpers/articleMixin";
    import {mapActions} from "vuex";
    import Avatar from "vue-avatar/src/Avatar";
    import ArticleListingBase from "./ArticleListingBase";

    export default {
        components: {ArticleListingBase, Avatar},
        mixins: [articleMixin],
        name: "all-articles",
        props: ['category'],
        computed: {
            articles() {
                if (this.category === null) return this.$store.state.articles
                return this.$store.state.articles.filter(article => article.category.id === this.category);
            },
        },
        data() {
            return {
                articleDialogVisible: false,
                isLoading: false,
                currentArticle: '',
                numOfItems: 30,
                page: 1,
            };
        },
        beforeMount() {
            this.getArticles();
        },
        methods: {

            ...mapActions({
                get: 'getPaginatedArticles'
            }),
            viewArticle(articleIndex) {
                if (!this.articleDialogVisible) {
                    console.log('click')
                    this.currentArticle = this.articles[articleIndex];
                    this.articleDialogVisible = true;
                }
            },

            loadArticles() {
                this.page++;
                this.getArticles();
            },

            getArticles() {
                this.isLoading = true;
                this.get(this.page).then(() => {
                    this.isLoading = false;
                });
            }
        },
    }
</script>

<style scoped>
    .list-item {
        display: block;
        padding: 0 1.5rem 0 1.5rem;
    }

    .footer {
        border-bottom: 1px solid #d8d8d8;
        max-width: 50rem;
        margin-bottom: 50px;
    }

    .dialog-main {
        padding: 0 5rem 5rem 5rem;
        display: flex;
        justify-content: center;
    }

    .rating {
        margin-left: auto;
    }

    .body {
        padding: 20px;
        max-width: 50rem;
        font-family: Arvo, SansSerif, Sana;
        color: #2a2a2a;
    }

    .header {
        border-left: 3px solid #F63854;
        padding-left: 10px;
        font-weight: 500;
        font-family: Arvo, serif;
        font-size: 32px;
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
        display: flex;
        align-items: center;
        flex-direction: row;
    }

    .profile-inline {
        padding: 20px;
    }

    .dialog-footer{
        display: flex;
        justify-content: center;
    }

    .picture {
    }

</style>
