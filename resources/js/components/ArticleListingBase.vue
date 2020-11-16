<template>
    <div class="main" @click="$emit('viewArticle')">
        <img v-if="article.article_images[0] != null" :src="article.article_images[0].article_image_path"
             class="article-img" alt="/images/logo.png">
        <img v-else src="/images/no_img.jpg" class="article-img-secondary" alt="">
        <div class="header">{{ truncateText(article.title, 0, 60) }}</div>
        <customized-star-rating class='star-rating' :object="article" :type="article"></customized-star-rating>
        <div class="body">
            <p> {{ truncateText(article.body, 0, 80) }}</p>
        </div>
        <div class="footer">
            <div class="info-container">
                <div class="d-flex profile-inline">
                    <avatar v-bind:username="this.article.author.name"></avatar>
                    <div class="infos">
                        <div class="name"> by {{ article.author.name }}</div>
                        <div>posted on {{ dateFormat(article.created_at) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {articleMixin} from "../helpers/articleMixin";
    import Avatar from "vue-avatar/src/Avatar";

    export default {
        name: "ArticleListingBase",
        props: ['article'],
        mixins: [articleMixin],
        components: {Avatar}
    }
</script>

<style scoped>
    .footer {
        margin-bottom: 2rem;
    }

    .article-img {
        height: 300px;
        width: 100%;
    }

    .star-rating {
        padding-left: 1.5rem;
    }

    .article-img-secondary {
        width: 100%;
    }

    .main {
        box-shadow: 0 10px 15px 0 rgba(46, 51, 51, .27);
        border-radius: 1rem;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    button {
        border: none;
        text-align: left;
        font-size: 13px;
        color: #6c757d;
        padding: 20px;
    }

    button:hover {
        color: #F63854;
        font-weight: bold;
        margin-left: auto;
    }

    .body {
        padding: 1.9rem;
        font-size: .8rem;
        max-width: 50rem;
        font-family: Arvo, SansSerif, Sana, serif;
        color: #484848;
    }

    .header {
        padding: 1rem 0 0 10px;
        text-align: center;
        font-family: Arvo, serif;
        font-size: 1.5rem;
        font-weight: 700;
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
    }

    .profile-inline {
        padding: 20px;
    }
</style>
