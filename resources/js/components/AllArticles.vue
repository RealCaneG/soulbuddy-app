<template>
    <div class="row list" v-infinite-scroll="loadArticles" infinite-scroll-throttle-delay="3000">
        <div class="col-md-8 list-item mt-3" v-for="(article, i) in articles" :key=i>
            <article-listing-base v-bind:article="article" v-on:viewArticle="viewArticle(i)">
            </article-listing-base>
        </div>

        <el-dialog v-if="currentArticle" :visible.sync="articleDialogVisible" width="70%">
            <div>
                <h3>
                    {{ currentArticle.title }}
                </h3>
                <div class="row">
                    <div class="col-md-6" v-for="(img, i) in currentArticle.article_images" :key=i>
                        <img :src="img.article_image_path" class="img-thumbnail" alt="">
                    </div>
                </div>
                <hr>
                <p>{{ currentArticle.body }}</p>
            </div>
            <span slot="footer" class="dialog-footer">
                        <el-button type="primary" @click="articleDialogVisible = false">Close</el-button>
                    </span>
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
        props:['category'],
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
        margin-left: auto;
        margin-right: auto;
    }

</style>
