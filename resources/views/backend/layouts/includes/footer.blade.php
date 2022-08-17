<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                {!! $settings->copyright !!}
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="text-sm-end d-none d-sm-block">
                        @if($authUser->role == "client")
                            <span style="margin-right: 15px;"><a href="{{ url("backend.client.cookiePolicy") }}">Çerez Politikası</a></span>
                            <span style="margin-right: 15px;"><a href="{{ url("backend.client.privacyPolicy") }}">Gizlilik Politikası</a></span>
                        @endif
                        Powered By <i class="fa fa-heart text-danger"></i> <a href="https://www.yasingokhanerdogan.com/" target="_blank" class="text-reset">YGE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
