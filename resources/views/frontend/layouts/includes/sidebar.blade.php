<div class="togo-fixed-sidebar togo-sidebar-left">
    <div class="togo-header-container">
        <!--Logo-->
        <div class="logo">
            <h1><a href="{{ url("frontend.home") }}">YGE<span>TEKSTİL A.Ş.</span></a></h1>
        </div>
        <!-- Burger menu -->
        <div class="burger-menu">
            <div class="line-menu line-half first-line"></div>
            <div class="line-menu"></div>
            <div class="line-menu line-half last-line"></div>
        </div>

        <nav class="togo-menu-fixed">
            <ul>
                <li><h5>Demo Site</h5></li>
                <li><a href="{{ url("frontend.home") }}">ANASAYFA</a></li>
                <li><a href="{{ url("frontend.about") }}">HAKKIMIZDA</a></li>
                <li><a href="{{ url("frontend.login") }}">@if(isset($_SESSION["user"]["id"])) ÜYE PANEL @else ÜYE GİRİŞİ @endif</a></li>
                <li><a href="{{ url("frontend.contact") }}">İLETİŞİM</a></li>
            </ul>
        </nav>

        <div class="togo-menu-social-media">
            <div class="social">
                @if($settings->facebook != "") <a href="{{ $settings->facebook }}"><i class="ti-facebook"></i></a> @endif
                    @if($settings->twitter != "")<a href="{{ $settings->twitter }}"><i class="ti-twitter"></i></a> @endif
                    @if($settings->instagram != "")<a href="{{ $settings->instagram }}"><i class="ti-instagram"></i></a> @endif
                    @if($settings->pinterest != "")<a href="{{ $settings->pinterest }}"><i class="ti-pinterest"></i></a> @endif
                    @if($settings->youtube != "")<a href="{{ $settings->youtube }}"><i class="ti-youtube"></i></a> @endif
            </div>
            <div class="togo-menu-copyright">
                <p>{!! $settings->copyright !!}</a></p>
            </div>
        </div>
    </div>
</div>