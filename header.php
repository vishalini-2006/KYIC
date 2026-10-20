<!-- Link to unified responsive stylesheet -->
<link rel="stylesheet" type="text/css" href="public/front/css/responsive-custom.css">

<div class="navbar-header kyc-navbar-header">
    <a class="navbar-brand kyc-navbar-brand" href="index.php">
        <img src="public/front/image/kyc1.jpeg" class="logo kyc-navbar-logo" alt="KYC Finserv Logo" loading="lazy" />
    </a>
    <button type="button" class="navbar-toggle kyc-navbar-toggle" data-toggle="collapse" data-target="#navbar-menu" aria-label="Toggle navigation" id="kyc-nav-toggle-btn">
        <i class="fa fa-bars"></i>
    </button>
</div>

<div class="collapse navbar-collapse" id="navbar-menu">
    <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
        <li id="home"><a href="index.php">Home</a></li>
        <li id="about"><a href="aboutus.php">About Us</a></li>
        <li id="products"><a href="products.php">Products</a></li>
        <li id="trackapp"><a href="trackapplication.php">Track Application</a></li>
        <li id="contactus"><a href="contactus.php">Contact Us</a></li>
        <li class="btn_color">
            <a class="btn_color1 nav-btn-highlight" href="form.php">Application Form</a>
        </li>
        <li class="btn_color">
            <a class="btn_color1 nav-btn-highlight" href="index.php#apply">Apply Now</a>
        </li>
    </ul>
</div>

<script>
(function() {
    function initMobileNav() {
        var toggleBtn = document.getElementById('kyc-nav-toggle-btn') || document.querySelector('.navbar-toggle');
        var navMenu = document.getElementById('navbar-menu') || document.querySelector('.navbar-collapse');
        if (!toggleBtn || !navMenu) return;

        if (toggleBtn._navInitialized) return;
        toggleBtn._navInitialized = true;

        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var isOpen = navMenu.classList.contains('in') || navMenu.classList.contains('open') || navMenu.style.display === 'block';
            var icon = toggleBtn.querySelector('i.fa');

            if (isOpen) {
                navMenu.classList.remove('in');
                navMenu.classList.remove('open');
                navMenu.style.display = '';
                if (icon) {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            } else {
                navMenu.classList.add('in');
                navMenu.classList.add('open');
                navMenu.style.display = 'block';
                if (icon) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                }
            }
        });

        document.addEventListener('click', function(e) {
            if (!navMenu.contains(e.target) && !toggleBtn.contains(e.target)) {
                if (navMenu.classList.contains('in') || navMenu.classList.contains('open') || navMenu.style.display === 'block') {
                    navMenu.classList.remove('in');
                    navMenu.classList.remove('open');
                    navMenu.style.display = '';
                    var icon = toggleBtn.querySelector('i.fa');
                    if (icon) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMobileNav);
    } else {
        initMobileNav();
    }
})();
</script>

