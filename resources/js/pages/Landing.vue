<template>
    <div id="body">
        <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar bg-white top-nav-collapse">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a href="/" class="navbar-brand"><img :src="image_src" alt="" width="140" height="28"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="lni-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end clearfix">
                        <li class="nav-item">
                            <scrollactive>
                                <a class="nav-link scrollactive-item" href="#backdrop">
                                    Home
                                </a>
                            </scrollactive>
                        </li>
                        <li class="nav-item">
                            <scrollactive>
                                <a class="nav-link scrollactive-item" href="#about">
                                    About
                                </a>
                            </scrollactive>
                        </li>
                        <li class="nav-item">
                            <scrollactive>
                                <a class="nav-link scrollactive-item" href="#services">
                                    Services
                                </a>
                            </scrollactive>
                        </li>
                        <li class="nav-item">
                            <scrollactive>
                                <a class="nav-link scrollactive-item" href="#contact">
                                    Contact
                                </a>
                            </scrollactive>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">
                                Register
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="backdrop" class="justify-content-center align-center align-middle">
            <div class="bg-transparent col-lg-7 col-md-12 col-sm-12 col-xs-12 ">
                <b-jumbotron class="bg-transparent" header="Lorem ipsum dolor sit amet.">
                    <p style="fill: #ffffff">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis metus sed
                        odio tempus gravida sed ut nunc. Cras ac nisi venenatis, euismod diam placerat, eleifend tortor.
                        Morbi eget ullamcorper lorem. Fusce vitae cursus nibh. Duis ut elementum elit. Donec leo metus,
                        vehicula quis tellus sit amet, facilisis aliquam turpis. Curabitur laoreet, elit ac rhoncus
                        gravida, nunc libero convallis ex, sed cursus nibh sem a nisi. Fusce non lacus malesuada lectus
                        mattis suscipit interdum ut leo. Aenean aliquet erat risus, vel vulputate dolor porta dictum.
                        Donec bibendum nec ipsum eu condimentum. Curabitur gravida venenatis nibh, nec suscipit eros
                        facilisis eget. Nulla facilisi.</p>
                    <b-button variant="danger" pill href="#">LEARN MORE</b-button>
                </b-jumbotron>
            </div>
        </div>
        <section id="services" class="section-padding">
            <div class="container">
                <div class="section-header text-center">
                    <h2 class="section-title wow fadeInDown animated" data-wow-delay="0.3s"
                    >
                        Our Services</h2>
                    <div class="shape wow fadeInDown animated" data-wow-delay="0.3s"
                    ></div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-3 col-xs-12">
                        <div class="services-item" style="">
                            <div class="icon">
                                <b-icon icon="people"></b-icon>
                            </div>
                            <div class="services-content">
                                <h3>Lorem ipsum id.</h3>
                                <p>Ut maximus enim dolor. Aenean auctor risus eget tincidunt lobortis. Donec tincidunt
                                    bibendum
                                    gravida. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xs-12">
                        <div class="services-item" style="">
                            <div class="icon">
                                <b-icon icon="people"></b-icon>
                            </div>
                            <div class="services-content">
                                <h3>Lorem ipsum id.</h3>
                                <p>Ut maximus enim dolor. Aenean auctor risus eget tincidunt lobortis. Donec tincidunt
                                    bibendum
                                    gravida. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xs-12">
                        <div class="services-item" style="">
                            <div class="icon">
                                <b-icon icon="people"></b-icon>
                            </div>
                            <div class="services-content">
                                <h3>Lorem ipsum id.</h3>
                                <p>Ut maximus enim dolor. Aenean auctor risus eget tincidunt lobortis. Donec tincidunt
                                    bibendum
                                    gravida. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xs-12">
                        <div class="services-item" style="">
                            <div class="icon">
                                <b-icon icon="people"></b-icon>
                            </div>
                            <div class="services-content">
                                <h3>Lorem ipsum id.</h3>
                                <p>Ut maximus enim dolor. Aenean auctor risus eget tincidunt lobortis. Donec tincidunt
                                    bibendum
                                    gravida. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="about" class="about-area section-padding bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-xs-12 info">
                        <div class="about-wrapper">
                            <div>
                                <div class="site-heading">
                                    <p class="mb-3">Lorem ipsum dolor sit mi.</p>
                                    <h2 class="section-title">Lorem ipsum dolor sit amet vivamus.</h2>
                                </div>
                                <div class="content">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum dictum magna
                                        et leo
                                        convallis, ac bibendum augue pharetra. Cras faucibus, tortor vel tempor
                                        volutpat, augue
                                        lectus pellentesque leo, quis fermentum felis purus nec erat. Sed magna dolor,
                                        placerat
                                        nec maximus consectetur, interdum nec leo. Vivamus vel ante quis turpis lacinia
                                        ultrices
                                        quis at purus. Nullam a commodo nisl. Integer lobortis fringilla libero vitae
                                        commodo.
                                        Pellentesque et efficitur tortor, vel gravida est. Nullam quis leo lorem. Sed
                                        nec
                                        placerat odio. Cras dapibus, eros sit amet accumsan luctus, ex ipsum egestas
                                        sapien, sed
                                        maximus diam nibh eget sapien.
                                    </p>
                                    <a href="#" class="btn btn-common mt-3">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-xs-12">
                        <img class="img-fluid"
                             src="/images/shutterstock_1247321140 [Converted].png" alt="">
                    </div>
                </div>
            </div>
        </section>
        <div id="contact" class="container">
            <div class="section-header text-center">
                <h2 class="section-title">
                    Contact Us</h2>
                <div class="shape wow fadeInDown animated" data-wow-delay="0.3s"></div>
            </div>
            <div class="row contact-form-area wow fadeInUp animated" data-wow-delay="0.3s">
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <!-- Call To Action Section Start -->
                    <section id="cta" class="section-padding">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 wow fadeInLeft animated" data-wow-delay="0.3s"
                                     style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                                    <div class="cta-text">
                                        <h4>Lorem ipsum dolor sit amet vivamus.</h4>
                                        <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sed orci sit
                                            amet turpis lobortis maximus rhoncus molestie ante. Vestibulum laoreet
                                            lacinia
                                            neque ut fringilla. Donec tincidunt eget ante id.
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Call To Action Section Start -->
                </div>
                <div class="col-lg-5 col-md-12 col-xs-12">
                    <div class="map">
                        <object style="border:0; height: 280px; width: 100%;"
                                data="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJB6LSJ4T_AzQRFq4JKF2AvJg&amp;key=AIzaSyBw7OlwF3kj1huljNAgjkEpj3L2CVK7GuA"></object>
                    </div>
                </div>
            </div>
        </div>
        <footer id="footer" class="footer-area section-padding">
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                            <div class="widget">
                                <h3 class="footer-logo"><img :src=image_src alt=""></h3>
                                <div class="textwidget">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lobortis
                                        tincidunt est,
                                        et euismod purus suscipit quis.</p>
                                </div>
                                <div class="social-icon">
                                    <a class="facebook" href="#"><i class="lni-facebook-filled"></i></a>
                                    <a class="twitter" href="#"><i class="lni-twitter-filled"></i></a>
                                    <a class="instagram" href="#"><i class="lni-instagram-filled"></i></a>
                                    <a class="linkedin" href="#"><i class="lni-linkedin-filled"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <h3 class="footer-title">XXXXXX</h3>
                            <ul class="footer-link">
                                <li><a href="#">XXXXXX</a></li>
                                <li><a href="#">XXXXXX</a></li>
                                <li><a href="#">XXXXXX</a></li>
                                <li><a href="#">XXXXXX</a></li>
                                <li><a href="#">XXXXXX</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <h3 class="footer-title">XXXXXX</h3>
                            <ul class="footer-link">
                                <li><a href="#">XXXXXX</a></li>
                                <li><a href="#">XXXXXX</a></li>
                                <li><a href="#">XXXXXX</a></li>
                                <li><a href="#">XXXXXX</a></li>
                                <li><a href="#">XXXXXX</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <h3 class="footer-title">Contact</h3>
                            <ul class="address">
                                <li>
                                    <a href="#"><i class="lni-map-marker"></i> Lorem ipsum dolor sit amet, - <br> Lorem
                                        ipsum dolor sit amet</a>
                                </li>
                                <li>
                                    <a href="#"><i class="lni-phone-handset"></i> +852 XXXX XXXX</a>
                                </li>
                                <li>
                                    <a href="#"><i class="lni-envelope"></i> E: contact@soulbuddy.app</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright-content">
                                <p>Copyright © 2020 <a rel="nofollow" href="https://ui.soulbuddy.app">SoulBuddy</a> All
                                    Right
                                    Reserved
                                </p>
                                <a class="fb-ic mr-3" role="button"><i class="fab fa-lg fa-facebook-f"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        name: "landing",

        data() {
            return {
                image_src: 'images/logo.png'
            }
        },
        computed: {
            isLoggedIn() {
                return this.$store.getters.isLoggedIn;
            }
        },
        mounted() {
            this.$store.commit('setAuthUser', this.$userId);
        }

    }
</script>

<style scoped>
    .navbar-expand-md .navbar-nav .nav-item {
        padding-left: 25px;
    }

    .navbar-expand-md .navbar-nav li a:hover,
    .navbar-expand-md .navbar-nav li .active > a,
    .navbar-expand-md .navbar-nav li a:focus {
        color: #fff;
        outline: none;
    }

    .navbar-expand-md .navbar-nav .nav-link {
        color: #333;
        font-weight: 400;
        padding: 7px 0;
        cursor: pointer;
        position: relative;
        background: transparent;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .navbar-expand-md .navbar-nav .nav-link:before {
        background-color: #F63854;
        content: '';
        display: block;
        height: 2px;
        position: absolute;
        margin: 0 auto;
        width: 0;
        top: 35px;
        left: 0;
        right: 0;
        bottom: 0;
        transition: width 1s;
        -ms-transition: width 1s;
        -webkit-transition: width 1s;
    }

    .navbar-expand-md .navbar-nav .active > .nav-link,
    .navbar-expand-md .navbar-nav .nav-link.active,
    .navbar-expand-md .navbar-nav .nav-link.open,
    .navbar-expand-md .navbar-nav .open > .nav-link {
        color: #F63854 !important;
        width: 100%;
    }

    .navbar-expand-md .navbar-nav .nav-link:hover,
    .navbar-expand-md .navbar-nav .nav-link:hover::before,
    .navbar-expand-md .navbar-nav .nav-link:focus {
        color: #F63854;
        width: 100%;
        transition: width 1s;
        -webkit-transition: width 1s;
    }

    .navbar {
        padding: 10px 0;
    }

    .b-nav-item {
        font-family: Arvo;
        font-size: 14px;

    }

    .bg-gray {
        background: #f9f9f9;
    }

    .btn {
        font-size: 14px;
        padding: 10px 30px;
        cursor: pointer;
        font-weight: 400;
        color: #fff;
        border-radius: 30px;
        -webkit-transition: all 0.2s linear;
        -moz-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        transition: all 0.2s linear;
        display: inline-block;
    }

    .btn:focus,
    .btn:active {
        box-shadow: none;
        outline: none;
        color: #fff;
    }

    .btn-common {
        background-color: #F63854;
        position: relative;
        z-index: 1;
        text-transform: uppercase;
    }

    .btn-common:hover {
        color: #F63854;
        background: transparent;
        border: 1px dotted #F63854;
        box-shadow: 0 6px 22px rgba(0, 0, 0, 0.1);
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
    }

    .about-area .about-wrapper {
        height: 100%;
        width: 100%;
        display: table;
    }

    .about-area .content {
        margin-top: 15px;
    }

    .about-area p {
        color: #abacae;
    }

    .about-area .content p {
        margin-bottom: 30px;
    }

    .about-area img {
        border-radius: 4px;
    }

    h1, h2, h3, h4, .b-jumbotron {
        font-size: 38px;
        color: #222222;
        font-weight: 700;
        font-family: 'Arvo-Bold', Arial, Helvetica, sans-serif;
    }

    .section-header {
        margin-bottom: 30px;
    }

    .services-item {
        padding: 20px;
        border-radius: 4px;
        text-align: center;
        margin: 15px 0;
        box-shadow: 0 0 12px #F4F4F4;
        transition: all 0.3s ease-in-out 0s;
        -moz-transition: all 0.3s ease-in-out 0s;
        -webkit-transition: all 0.3s ease-in-out 0s;
        -o-transition: all 0.3s ease-in-out 0s;
    }

    .services-item:hover .icon {
        color: #ffffff;
    }

    .services-item .icon {
        text-align: center;
        align-content: center;
        justify-content: center;
        justify-items: center;
        justify-self: center;
        align-items: center;
        border: 1px solid #F2F2F2;
        color: #F63854;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        margin: 0 auto;
    }

    .services-item .icon .b-icon {
        color: #F63854;
        font-size: 30px;
        margin-top: 25%;
    }

    .services-item:hover .icon {
        background-color: #F63854;
        color: #F63854;
    }

    .services-item:hover .icon .b-icon {
        color: #F1F1F1;
    }

    .services-item .services-content h3 {
        margin-top: 10px;
        font-weight: 500;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .services-item .services-content h3 {
        font-size: 16px;
        color: #585b60;
    }

    .services-item .services-content h3:hover {
        color: #F63854;
    }

    .services-item .services-content p {
        font-weight: 400;
        font-family: 'Arvo', sans-serif;
        margin: 0px;
        font-size: 14px;
        color: #ABACAE;
        display: block;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
    }

    .services-item:hover {
        box-shadow: 0 10px 22px 10px rgba(27, 38, 49, 0.1);
    }

    #service {
        position: relative;
    }

    #backdrop p {
        color: #f8f9fa;
        font-weight: 400;
        font-family: 'Arvo', sans-serif;
        margin: 0px;
        font-size: 14px;
        padding-bottom: 10px;
        margin-bottom: 1rem;
    }

    #body {
        font-family: 'Open Sans', sans-serif;
    }

    #backdrop {
        background-image: url('/images/backdrop.jpg');
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        max-height: 600px;
        overflow: hidden;
        padding: 180px 0 80px;
    }

    #backdrop .display-3 {
        color: #222222;
        font-size: 42px;
        font-weight: 700;
        line-height: 60px;
        margin-bottom: 10px;
        text-align: left;
    }

    #backdrop .contents .header-button {
        margin-top: 20px;
        color: #222222;
    }

    #backdrop .contents .header-button .btn {
        margin-right: 10px;
    }

    .section-padding {
        padding: 60px 0;
    }


    .navbar {
        padding: 10px 0;
    }

    section {
        display: block;
    }

    div {
        background-color: #fff;
    }

    .footer-area {
        position: relative;
        padding: 150px 0px 0px;
        background: #fff;
    }

    .footer-area .footer-title {
        font-size: 18px;
        color: #333333;
        font-weight: 500;
        padding-bottom: 20px;
        letter-spacing: 0.5px;
    }

    .footer-area .footer-title span {
        color: #ccc;
        font-weight: 400;
    }

    .footer-area .textwidget p {
        color: #333;
    }

    .footer-area .footer-link li {
        margin-bottom: 10px;
    }

    .footer-area .footer-link li a {
        color: #333;
        font-size: 14px;
        font-weight: 400;
        position: relative;
    }

    .footer-area .footer-link li a:hover {
        color: #F63854;
    }

    .footer-area .address li {
        margin-bottom: 20px;
    }

    .footer-area .address li a {
        color: #666666;
        font-size: 14px;
        line-height: 30px;
        font-weight: 400;
    }

    .footer-area .address li a i {
        font-size: 22px;
        width: 32px;
        vertical-align: middle;
        height: 36px;
        text-align: center;
        display: inline-block;
        float: left;
        margin-right: 5px;
        line-height: 32px;
    }

    .footer-area #subscribe-form {
        margin-top: 10px;
    }

    .footer-area #subscribe-form .form-group {
        position: relative;
    }

    .footer-area #subscribe-form .form-group .btn-common {
        position: absolute;
        top: 0;
        right: 0;
        padding: 7px 15px;
        height: 52px;
        border-radius: 0;
        background: transparent;
        color: #F63854;
    }

    #copyright .copyright-content {
        border-top: 1px solid #d5d4e9;
        padding: 15px 0;
        margin: 45px 0 0px;
    }

    #copyright p {
        line-height: 42px;
        color: #333;
        text-align: center;
        margin: 0;
    }

    #copyright p a {
        color: #F63854;
    }

    .social-icon a {
        color: #272727;
        background: #fff;
        width: 32px;
        height: 32px;
        line-height: 34px;
        display: inline-block;
        text-align: center;
        border-radius: 4px;
        font-size: 16px;
        margin: 15px 6px 12px 4px;
        transition: all 0.3s ease-in-out 0s;
        -moz-transition: all 0.3s ease-in-out 0s;
        -webkit-transition: all 0.3s ease-in-out 0s;
        -o-transition: all 0.3s ease-in-out 0s;
    }

    .social-icon a:hover {
        color: #fff !important;
    }

    .social-icon .facebook:hover {
        background: #3b5999;
    }

    .social-icon .twitter:hover {
        background: #4A9CEC;
    }

    .social-icon .instagram:hover {
        background: #D6274D;
    }

    .social-icon .linkedin:hover {
        background: #1260A2;
    }

    .social-icon .google:hover {
        background: #CE332A;
    }

    ul, ol {
        list-style: outside none none;
        margin: 0;
        padding: 0;
    }

    ul li, ol li {
        list-style: none;
    }

</style>
