
<div class="settings-menu-links">
<ul class="nav nav-tabs menu-tabs">
<li class="nav-item active {{ request()->is('settings') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('settings') }}">General Settings</a>
</li>
<li class="nav-item">
<a class="nav-link" href="localization-details.html">Localization</a>
</li>
<li class="nav-item">
<a class="nav-link" href="payment-settings.html">Payment Settings</a>
</li>
<li class="nav-item">
<a class="nav-link" href="email-settings.html">Email Settings</a>
</li>
<li class="nav-item">
<a class="nav-link" href="social-settings.html">Social Media Login</a>
</li>
<li class="nav-item {{ request()->is('social.links') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('social.links') }}">Social Links</a>
</li>
<li class="nav-item">
<a class="nav-link" href="seo-settings.html">SEO Settings</a>
</li>
<li class="nav-item">
<a class="nav-link" href="others-settings.html">Others</a>
</li>
</ul>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        var path = window.location.pathname;

        $('.nav-item').each(function () {
            if ($(this).find('a').attr('href') === path) {
                $(this).addClass('active');
            }
        });
    });
</script>
