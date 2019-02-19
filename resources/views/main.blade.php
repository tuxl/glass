<!DOCTYPE HTML>
<!--
	Multiverse by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>Multiverse by HTML5 UP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="photoswipe/photoswipe.css" />
    <link rel="stylesheet" href="photoswipe/photoswipe.css" />
    <link rel="stylesheet" href="photoswipe/default-skin/default-skin.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">

<style>
    .info{
        transition: bottom 0.5s;
        position: absolute;
        bottom: -45px;
        color: #ffffff;
        background: #000;
        width: 100%;
        height: 45px;
        line-height: 45px;
        padding-left: 20px;
        font-size: 13px;
        opacity: 0.8;
    }
    .thumb:hover .info{
        bottom: 0;
    }

    .navmenu{
        transition: width 0.5s, height 0.5s;
        width: 60px;
        height: 60px;
        position: fixed;
        right: 20px;
        background: #ffffff;
        top: 60px;
        overflow: hidden;
        padding: 10px;
        border: 1px solid #dcdcdc;
        font-weight: 500;
        color: #000;
    }

    .navmenu:hover{
        width: 200px;
        height: 300px;
    }

    .navmenu:hover .catlist{
        display: block;
    }

    .catlist{
        list-style: none;
        display: none;

    }
    .catlist a{
        color: #000000;
        text-decoration: none;
    }
    .menutitle{
        font-size: 15px;
        font-weight: 500;
        color: #000;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        /*background: red;*/
    }
</style>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <h1><a href="index.html"><strong>Multiverse</strong> by HTML5 UP</a></h1>
        <nav>
            <ul>
                <li><a href="#footer" class="icon fa-info-circle">About</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main -->
    <div id="main">
        @foreach ($data as $k=>$item)
            <article class="thumb">
                <a style="cursor: pointer" class="image"
                   onclick="clickReaction(event)"
                   index="{{ $k }}"
                   w="{{ $item->w }}"
                   h="{{ $item->h}}"
                   mainpic="{{ $item->mainpic }}">
                    <img src="{{ $item->mainpic }}" alt="" />
                </a>
                <div class="info">{{ $item->title }}</div>
            </article>
        @endforeach

    </div>

    <!-- Footer -->
    <footer id="footer" class="panel">
        <div class="inner split">
            <div>
                <section>
                    <h2>Magna feugiat sed adipiscing</h2>
                    <p>Nulla consequat, ex ut suscipit rutrum, mi dolor tincidunt erat, et scelerisque turpis ipsum eget quis orci mattis aliquet. Maecenas fringilla et ante at lorem et ipsum. Dolor nulla eu bibendum sapien. Donec non pharetra dui. Nulla consequat, ex ut suscipit rutrum, mi dolor tincidunt erat, et scelerisque turpis ipsum.</p>
                </section>
                <section>
                    <h2>Follow me on ...</h2>
                    <ul class="icons">
                        <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                        <li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
                        <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
                        <li><a href="#" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
                    </ul>
                </section>
                <p class="copyright">
                    &copy; Unttled. Design: <a href="http://html5up.net">HTML5 UP</a>.
                </p>
            </div>
            <div>
                <section>
                    <h2>Get in touch</h2>
                    <form method="post" action="#">
                        <div class="fields">
                            <div class="field half">
                                <input type="text" name="name" id="name" placeholder="Name" />
                            </div>
                            <div class="field half">
                                <input type="text" name="email" id="email" placeholder="Email" />
                            </div>
                            <div class="field">
                                <textarea name="message" id="message" rows="4" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <ul class="actions">
                            <li><input type="submit" value="Send" class="primary" /></li>
                            <li><input type="reset" value="Reset" /></li>
                        </ul>
                    </form>
                </section>
            </div>
        </div>
    </footer>

</div>


<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>

<div class="navmenu">
    <div class="menutitle">
        分类
    </div>
    <ul class="catlist">
        @foreach ($catlist as $k=>$item)
            <li>
                <a href="?cid={{ $item->id }}">{{ $item->name }}</a>
            </li>
        @endforeach

    </ul>
</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.poptrox.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="photoswipe/photoswipe.min.js"></script>
<script src="photoswipe/photoswipe-ui-default.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>