<!DOCTYPE HTML>
<!--
	Multiverse by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>罗克勋个人作品展</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="lastid" content="{{ $lastid  }}" />
    <meta name="catid" content="{{ $catid  }}" />
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
    .zsimg {
        /*display: flex;*/
        /*justify-content: center;*/
    }
    .zsimg > img{
        max-width: 500px;
    }
</style>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header">
        {{--<h1><a >作者简介</a></h1>--}}
        <nav>
            <ul>
                <li><a href="#footer" class="icon fa-info-circle">作者简介</a></li>
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
                    <img src="{{ $item->thumb_path }}" alt="" />
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
                    <h2>罗克勋先生简介</h2>
                    <p>
                        罗克勋、湖南长沙人，山水画家，斋号清心居，湖南省美术家协会会员，怀化市国画院首届画家成员，北京凤凰岭书院中国画创作院画家。
                    </p>
                </section>
                <section>
                    <h2>生涯介绍</h2>
                    <ul class="icons">
                        <li>1991年拜怀化学院易图境先生为师学习花鸟画</li>
                        <li>2009年在怀化市博物馆举办个人画展</li>
                        <li>2010年入中国国家画院程大利山水画高研班学习</li>
                        <li>2012年入北京凤凰岭书院程大利山水画工作室</li>
                        <li>2014年入北京凤凰岭书院中国画创作院</li>
                    </ul>
                </section>

            </div>
            <div>
                <section>
                    <h2>个人证书</h2>
                    <div class="zsimg"><img src="/assets/img/z1.jpg"></div>
                    <div class="zsimg"><img src="/assets/img/z2.jpg"></div>
                    <div class="zsimg"><img src="/assets/img/z3.jpg"></div>
                    <div class="zsimg"><img src="/assets/img/z4.jpg"></div>
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