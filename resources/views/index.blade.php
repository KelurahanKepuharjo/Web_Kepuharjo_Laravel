<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Landing Page</title>
</head>

<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo">S- Kepuharjo</a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="/login" class="nav__link">Login</a>
                    </li>
                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="#about" class="nav__link">About us</a>
                    </li>
                    <li class="nav__item">
                        <a href="#services" class="nav__link">Fitur</a>
                    </li>
                    <li class="nav__item">
                        <a href="#contact" class="nav__link">Contact us</a>
                    </li>


                    <i class='bx bx-toggle-left change-theme' id="theme-button"></i>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-grid-alt'></i>
            </div>

            <a href="/login" class="button button__header">Login</a>
        </nav>
    </header>

    <main class="main">
        <!--=============== HOME ===============-->
        <section class="home section" id="home">
            <div class="home__container container grid">
                <img class="svg__img svg__color home__img" src="assets/img/gambarhome.png" alt="">
                <div class="home__data">
                    <h1 class="home__title">S-Kepuharjo <br> Smart App Pengajuan Surat</h1>
                    <p class="home__description">Sebagai wujud komitmen dalam memberikan informasi seluas-seluasnya
                        kepada masyarakat. S-Kepuharjo akan mempermudahkan dalam proses pengajuan surat yang dilakukan
                        oleh masyarakat.</p>

                    <a href="/login" class="button">Login</a>

                </div>
            </div>
        </section>

        <!--=============== ABOUT ===============-->
        <section class="about section container" id="about">
            <div class="about__container grid">
                <div class="about__data">
                    <h2 class="section__title-center">Tentang Smart App<br> S-Kepuharjo</h2>
                    <p class="about__description">S-kepuharjo merupakan aplikasi berbasis website dan mobile kepuharjo
                        ini dapat digunakan oleh pihak masyarakat, RT, dan RW serta website khusus untuk pihak Admin
                        Kelurahan yang digunakan untuk menampung surat sekaligus digunakan untuk data master dari
                        masyarakat, dan diharapkan juga aplikasi pengajuan surat untuk masyarakat ini dapat dilakukan
                        dimanapun dan kapanpun sehingga menjadi lebih efektif dan efisien.</p>
                </div>
                <img class="svg__img svg__color about__img" src="assets/img/gambartentang.png" alt="">

            </div>
        </section>

        <!--=============== SERVICES ===============-->
        <section class="services section container" id="services">
            <h2 class="section__title">Fitur - Fitur Smart App<br> S-Kepuharjo</h2>
            <div class="services__container grid">
                <div class="services__data">
                    <h3 class="services__subtitle">S-KEPUHARJO MOBILE</h3>
                    <img class="svg__color services__img" src="assets/img/gbrgenggam.png" alt="">

                    <p class="services__description">Mengajukan surat sekarang jauh lebih mudah, cukup diajukan dimana
                        saja dalam genggaman tangan
                    <div>
                        <a href="#" class="button button-link">Learn More</a>
                    </div>
                </div>

                <div class="services__data">
                    <h3 class="services__subtitle">S-KEPUHARJO WEBSITE</h3>
                    <img class="svg__color services__img" src="assets/img/gbrmanajemen.png" alt="">

                    <p class="services__description">Selain Aplikasi Android anda dapat mengajukan lewat website dan
                        sekarang pengajuan surat jauh lebih mudah</p>
                    <div>
                        <a href="#" class="button button-link">Learn More</a>
                    </div>
                </div>

                <div class="services__data">
                    <h3 class="services__subtitle">S-KEPUHARJO TEPAT GUNA</h3>
                    <img class="svg__color services__img" src="assets/img/gbrefisien.png" alt="">

                    <p class="services__description">Manajement surat lebih baik dan lebih mudah dan dimana saja </p>
                    <div>
                        <a href="#" class="button button-link">Learn More</a>
                    </div>
                </div>
            </div>
        </section>

        <!--=============== APP ===============-->
        <section class="app section container">
            <div class="app__container grid">
                <div class="app__data">
                    <h2 class="section__title-center">Ajukan Surat sekarang <br> di S-Kepuharjo</h2>
                    <p class="app__description">Dengan Aplikasi Mobile yang dapat kamu dapatkan dari link berikut</p>
                    <div class="app__buttons">
                        <a href="#" class="button button-flex">
                            <i class='bx bxl-apple button__icon'></i> App Store
                        </a>
                        <a href="#" class="button button-flex">
                            <i class='bx bxl-play-store button__icon'></i> Google Play
                        </a>
                    </div>
                </div>
                <img class="svg__img svg__color app__img" src="assets/img/downloading.png" alt="">

            </div>
        </section>

        <!--=============== CONTACT US ===============-->

        <footer class="footer section">
            <div class="contact container" id="contact">
                <div class="contact__container grid">
                    <div class="contact__content">
                        <h2 class="section__title-center">S-Kepuharjo<br> Here</h2>
                        <p class="contact__description">Pengunjung {{ $totalVisits }}</p>
                        <p>Rata Rata Lama Kunjungan {{ $averageDuration }} Menit</p>
                    </div>

                    <ul class="contact__content grid">
                        <li class="contact__address">Telephone: <span
                                class="contact__information">+6283-1234-12345</span></li>
                        <li class="contact__address">Alamat : <span class="contact__information">Kec. Lumajang,
                                Kabupaten Lumajang, Jawa Timur 67316</span></li>
                        <li class="contact__address">Email : <span
                                class="contact__information">kel_kepuharjo@lumajangkab.go.id </span></li>
                    </ul>

                    <div class="contact__content">
                        <a href="#" class="button">Contact Us</a>
                    </div>
                </div>
            </div>
        </footer>

    </main>

    <!--=============== FOOTER ===============-->
    <!-- <footer class="footer section"> -->
    <!-- <div class="footer__container container grid">
                <div class="footer__content">
                    <a href="#" class="footer__logo">Delivery</a>
                    <p class="footer__description">Order Products Faster <br> Easier</p>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Our Services</h3>
                    <ul class="footer__links">
                        <li><a href="#" class="footer__link">Pricing </a></li>
                        <li><a href="#" class="footer__link">Discounts</a></li>
                        <li><a href="#" class="footer__link">Report a bug</a></li>
                        <li><a href="#" class="footer__link">Terms of Service</a></li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Our Company</h3>
                    <ul class="footer__links">
                        <li><a href="#" class="footer__link">Blog</a></li>
                        <li><a href="#" class="footer__link">Our mision</a></li>
                        <li><a href="#" class="footer__link">Get in touch</a></li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Community</h3>
                    <ul class="footer__links">
                        <li><a href="#" class="footer__link">Support</a></li>
                        <li><a href="#" class="footer__link">Questions</a></li>
                        <li><a href="#" class="footer__link">Customer help</a></li>
                    </ul>
                </div>

                <div class="footer__social">
                    <a href="#" class="footer__social-link"><i class='bx bxl-facebook-circle '></i></a>
                    <a href="#" class="footer__social-link"><i class='bx bxl-twitter'></i></a>
                    <a href="#" class="footer__social-link"><i class='bx bxl-instagram-alt'></i></a>
                </div>
            </div>

            <p class="footer__copy">&#169; S-Kepuharjo.</p>
        </footer> -->

    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class='bx bx-up-arrow-alt scrollup__icon'></i>
    </a>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
</body>

</html>
