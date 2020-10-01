<template>
    <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar bg-white top-nav-collapse">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a href="/" class="navbar-brand"><img src='/images/logo.png' alt="" width="140" height="28"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="lni-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <b-navbar-nav>
                <li class="nav-item">
                    <router-link to="/home/articles"><a>Articles</a></router-link>
                </li>
            </b-navbar-nav>
            <ul class="navbar-nav mr-auto w-100 justify-content-end clearfix">
                <li class="nav-item" v-if="userName !== null">
                    <avatar v-bind:username="userName"></avatar>
                </li>
                <li class="nav-item" style="align-items: center">
                    <div class="icon">
                        <b-icon icon="bell"></b-icon>
                        <b-badge variant="danger" class="badge-circle badge-sm badge-floating border-white">4</b-badge>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="icon">
                        <b-icon icon="chat"></b-icon>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import Avatar from "vue-avatar/src/Avatar";

    export default {
        components: {Avatar},
        name: "MainNav",
        props: ['userName'],
        mounted() {
            //this.user = this.$store.getters.getCurrentUser;
            console.log('This User = ', this.user)
        },
        data() {
            return {
                image_src: 'images/logo.png',
                user: null
            }
        }
    }
</script>

<style scoped>

    .nav-item {
        margin-right: 1%;
    }

    .navbar {
        background: #fff;
        z-index: 999999;
        padding: 5px !important;
        top: 0px !important;
        box-shadow: 0px 3px 6px 3px rgba(0, 0, 0, 0.06);
    }

    .navbar-nav .nav-item .icon .b-icon {
        color: #F63854;
        font-size: 25px;
    }

    .navbar-nav .nav-item .icon {
        text-align: center;
        border: 1px solid #f2dede;
        color: #F63854;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        margin: 0 auto;
        padding-top: 17%
    }

    .navbar-nav .nav-item .icon .badge {
        border-radius: 50%;
        margin-left: 25px;
    }
</style>
