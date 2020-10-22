<template>
    <div>
        <div class="main" @click="handleSecret">
            <div class="top-container">
                <div>
                    <div class="header">
                        <div style="text-align: left">
                            [{{this.secret.category.category}}]
                        </div>
                        <div>
                            {{ truncateText(this.secret.title, 0, 60) }}
                        </div>
                    </div>
                    <div class="body">
                        <p> {{ truncateText(secret.body, 0, 80) }}</p>
                    </div>
                </div>
                <div class="unlock">
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                         width="6rem" height="6rem" viewBox="0 0 5556.000000 5557.000000"
                         preserveAspectRatio="xMidYMid meet">
                        <g transform="translate(0.000000,5557.000000) scale(0.100000,-0.100000)"
                           fill="#000000" stroke="none">
                            <path d="M27255 52780 c-4465 -95 -8758 -1354 -12545 -3678 -2845 -1746 -5339
                                    -4073 -7281 -6792 -1171 -1639 -2119 -3371 -2867 -5235 -987 -2463 -1573
                                    -5076 -1737 -7745 -35 -574 -40 -769 -40 -1545 0 -776 5 -971 40 -1545 404
                                    -6596 3394 -12736 8345 -17141 3236 -2878 7151 -4863 11370 -5763 1314 -280
                                    2583 -445 4015 -522 396 -21 1609 -30 2040 -15 3501 122 6790 919 9923 2405
                                    3120 1480 5961 3655 8238 6308 1654 1927 3001 4087 4001 6413 776 1803 1338
                                    3711 1667 5655 468 2758 471 5596 10 8355 -468 2804 -1413 5503 -2797 7990
                                    -994 1786 -2214 3458 -3616 4955 -384 410 -1007 1022 -1446 1422 -2274 2069
                                    -4960 3725 -7830 4826 -3021 1159 -6246 1721 -9490 1652z m1155 -5560 c1901
                                    -65 3686 -378 5430 -952 3219 -1060 6072 -2917 8363 -5443 2568 -2833 4245
                                    -6371 4807 -10142 88 -592 151 -1227 190 -1938 28 -496 23 -1541 -10 -2105
                                    -181 -3053 -1048 -5947 -2574 -8590 -1206 -2087 -2839 -3976 -4756 -5501
                                    -2839 -2260 -6271 -3681 -9860 -4083 -785 -88 -1374 -120 -2220 -120 -972 0
                                    -1727 49 -2630 170 -3252 436 -6355 1705 -8995 3679 -2143 1602 -3938 3627
                                    -5260 5934 -1950 3405 -2811 7275 -2500 11231 220 2781 1032 5454 2408 7920
                                    1480 2653 3642 4989 6191 6689 2955 1973 6378 3092 9906 3241 489 21 1084 24
                                    1510 10z"/>
                            <path d="M19755 34574 c-22 -2 -103 -8 -180 -14 -1239 -94 -2478 -560 -3490
                                    -1312 -697 -518 -1304 -1181 -1753 -1914 -1080 -1764 -1296 -3936 -586 -5883
                                    547 -1499 1620 -2770 3007 -3565 767 -440 1626 -729 2497 -841 379 -49 913
                                    -68 1275 -46 919 57 1762 277 2573 672 539 262 993 558 1447 944 202 172 620
                                    593 784 790 479 575 832 1160 1102 1825 39 95 64 145 73 144 8 -1 125 -70 261
                                    -153 l246 -151 1364 0 1365 0 676 811 c371 445 679 809 684 807 4 -2 311 -366
                                    681 -810 l672 -808 1364 0 1363 0 675 540 c371 297 677 540 680 540 3 0 309
                                    -243 680 -540 371 -297 678 -540 683 -540 4 0 311 122 682 270 l675 270 675
                                    -270 675 -270 686 0 686 0 677 1016 678 1017 -24 22 c-12 12 -929 777 -2035
                                    1699 l-2013 1676 -6447 0 -6448 0 -34 78 c-55 124 -214 437 -292 572 -887
                                    1551 -2340 2690 -4049 3175 -394 112 -794 187 -1230 231 -154 15 -891 29
                                    -1005 18z m-3545 -5439 c180 -15 428 -105 591 -216 301 -202 504 -499 584
                                    -855 24 -107 30 -369 11 -484 -47 -291 -166 -528 -368 -736 -160 -165 -337
                                    -278 -549 -348 -159 -53 -280 -69 -479 -63 -131 4 -186 10 -266 30 -255 65
                                    -460 181 -644 366 -191 192 -314 421 -371 694 -43 204 -26 485 42 692 37 112
                                    127 282 203 383 238 316 588 510 976 542 93 7 121 7 270 -5z"/>
                        </g>
                    </svg>
                    <div>
                        <label>Unlock now with {{this.secret.price}} token(s)</label>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="info-container">
                    <div class="d-flex profile-inline">
                        <avatar v-bind:username="this.secret.author.name"></avatar>
                        <div class="infos">
                            <div class="name"> by {{ this.secret.author.name }}</div>
                            <div> available until {{ dateFormat(secret.expiry_date) }}</div>
                        </div>
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
        name: "lockedSecret",
        components: {Avatar},
        props: ['secret'],
        mixins: [articleMixin],
        methods: {
            handleSecret() {
                this.$emit('handleSecret', this.secret.id);
            },
        },
    }

</script>

<style scoped>
    .footer {
    //margin-bottom: 2rem;
    }

    svg {
        width: 6rem;
    }

    svg g {
        fill: #F63854;
    }

    .main {
        padding: 1rem;
        box-shadow: 0 10px 15px 0 rgba(46, 51, 51, .27);
        border-radius: 1rem;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .body {
        padding-top: 1.9rem;
        font-size: .8rem;
        max-width: 50rem;
        font-family: Arvo, SansSerif, Sana, serif;
        color: #484848;
    }

    .header {
        text-align: left;
        font-family: Arvo, serif;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .top-container {
        display: flex;
        flex-direction: row;
        padding: 1rem;
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

    .unlock {
        display: flex;
        flex-direction: column;
    }

    .unlock label {
        font-size: .8rem;
        color: #F63854;
        text-align: center;
    }

    .info-container {
    }

    .profile-inline {
        padding: 20px;
    }
</style>
