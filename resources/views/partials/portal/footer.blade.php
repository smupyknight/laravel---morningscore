<footer class="{{ !Auth::user()->requiresSetup() ? '' : 'setup-footer' }}">
    <div class="footer">
        <div class="footer-inner">
            <div class="logo-wrapper">
                <a href="/"><img src="{{ asset('img/logo/logo-blue.svg') }}" alt="logo"></a>
            </div>
            <div class="links-wrapper">
                <div class="link-container">
                    <a href="https://morningscore.io/forum/" target="_blank"><p class="title">Join the friendly forum</p></a>
                <!--    <div class="details">
                        <p>PLaceholder text</p>
                        <p>PLaceholder text</p>
                        <p>PLaceholder text</p>
                        <p>PLaceholder text</p>
                    </div> -->
                </div>
                <div class="border"></div>
                <div class="link-container">
                    <a href="https://morningscore.io/roadmap/" target="_blank"><p class="title">Roadmap</p></a>
               <!--    <div class="details">
                        <p>PLaceholder text</p>
                        <p>PLaceholder text</p>
                        <p>PLaceholder text</p>
                        <p>PLaceholder text</p>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="company-info">
                <p>
                    <span class="first"><b>Morningscore ApS</b></span>
                    <span>Gammelsø 4, 5000 Odense C, Denmark</span>
                    <span><span class="dot">•</span> Email: <b><a href="mailto:info@morningscore.io">info@morningscore.io</a></b></span>
                </p>
            </div>
            <div class="social-media">
                <a href="https://www.facebook.com/morningscore" target="_blank"><img src="https://morningscore.io/wp-content/themes/mtt-wordpress-theme/assets/img/social-media/facebook.svg"></a>
                <a href="https://www.instagram.com/morningscore/" target="_blank"><img src="https://morningscore.io/wp-content/themes/mtt-wordpress-theme/assets/img/social-media/instagram.svg"></a>
                <a href="https://www.linkedin.com/company/morningscore/" target="_blank"><img src="https://morningscore.io/wp-content/themes/mtt-wordpress-theme/assets/img/social-media/linkedin.svg"></a>
                <a href="https://twitter.com/morningscore_io" target="_blank"><img src="https://morningscore.io/wp-content/themes/mtt-wordpress-theme/assets/img/social-media/twitter.svg"></a>
            </div>
        </div>
    </div>
</footer>
