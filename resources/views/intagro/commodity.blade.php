<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Intagro Asia Pte Ltd</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    
    <link href="{{asset('image')}}/logo intagro.jpeg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    
    <link href="{{asset('dgcom')}}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{asset('dgcom')}}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{asset('dgcom')}}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('dgcom')}}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('dgcom')}}/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border position-relative text-intagro" style="width: 6rem; height: 6rem;" role="status"></div>
        <i class="fa fa-laptop-code fa-2x text-intagro position-absolute top-50 start-50 translate-middle"></i>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <!-- <div class="container-fluid bg-light px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="small text-secondary" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="small text-secondary" href="#">Career</a></li>
                    <li class="breadcrumb-item"><a class="small text-secondary" href="#">Terms</a></li>
                    <li class="breadcrumb-item"><a class="small text-secondary" href="#">Privacy</a></li>
                </ol>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Follow us:</small>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn-square text-intagro border-end rounded-0" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn-square text-intagro border-end rounded-0" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn-square text-intagro border-end rounded-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn-square text-intagro pe-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Topbar End -->


    <!-- Brand & Contact Start -->
    <div class="container-fluid py-4 px-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="row align-items-center top-bar">
            <div class="col-lg-4 col-md-12 text-center text-lg-start">
                <a href="" class="navbar-brand m-0 p-0">
                    <img src="{{asset('image')}}/logo intagro.jpeg"  style="width:100%;"class="responsive" alt="Logo"> 
                </a>
            </div>
            <div class="col-lg-8 col-md-7 d-none d-lg-block">
                <div class="row">
                    <div class="col-4">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="flex-shrink-0 btn-lg-square border rounded-circle">
                                <i class="far fa-clock text-intagro"></i>
                            </div>
                            <div class="ps-3">
                                <p class="mb-2">Opening Hour</p>
                                <h6 class="mb-0">Monday - Saturday</h6>
                                <h6> 8:00AM - 5:00PM</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="flex-shrink-0 btn-lg-square border rounded-circle">
                                <i class="fa fa-phone text-intagro"></i>
                            </div>
                            <div class="ps-3">
                                <p class="mb-2">Call Us</p>
                                <h6 class="mb-0">+012 345 6789</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="flex-shrink-0 btn-lg-square border rounded-circle">
                                <i class="far fa-envelope text-intagro"></i>
                            </div>
                            <div class="ps-3">
                                <p class="mb-2">Email Us</p>
                                <h6 class="mb-0">admin01@intagro.com</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand & Contact End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="#" class="navbar-brand ms-3 d-lg-none">MENU</a>
        <button type="button" class="navbar-toggler me-3" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav me-auto p-3 p-lg-0">
                <a href="intagro" class="nav-item nav-link">Home</a>
                <a href="about-us" class="nav-item nav-link">About Us</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Product & Services</a>
                    <div class="dropdown-menu border-0 rounded-0 rounded-bottom m-0">
                        <a href="macro-fertilizer" class="dropdown-item">Macro Nutrient Fertilizer</a>
                        <a href="micro-fertilizer" class="dropdown-item">Micro Nutrient Fertilizer</a>
                        <a href="natural-fertilizer" class="dropdown-item">Natural/Organic Fertilizer</a>
                        <a href="commodity" class="dropdown-item active">Various Commodity</a>
                    </div>
                </div>
                <a href="contact-us" class="nav-item nav-link">Contact Us</a>
            </div>
            {{-- <a href="#" class="btn btn-sm btn-light rounded-pill py-2 px-4 d-none d-lg-block">Get Started</a> --}}
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- About Start -->
    <!--<div class="container-xxl py-5">-->
    <!--    <div class="container">-->
    <!--        <div class="row g-5">-->
    <!--            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">-->
    <!--                <div class="img-border" style="border-color: #0ba1b2;">-->
    <!--                    <img class="img-fluid" src="{{asset('dgcom')}}/img/about.jpg" alt="">-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">-->
    <!--                <div class="h-100">-->
    <!--                    <h6 class="section-title bg-white text-start text-intagro pe-3">About Us</h6>-->
    <!--                    <h1 class="display-6 mb-4">1#BEST Supplier More Then <span class="text-intagro"> 9 Years</span> Of Experience</h1>-->
    <!--                    <p>Intagro Asia Pte Ltd was established in 2014. -->
    <!--                        We focus on supporting businesses in the field of fertilizers and commodities. With the support of many local companies, we are growing and ready to meet business needs throughout Asia.</p>-->
    <!--                    <h6>Visi</h6>-->
    <!--                    <p class="mb-4 text-primary">-->
    <!--                        - aasdasdsadasd-->
    <!--                        <br>-->
    <!--                        - asdasasdad-->
    <!--                    </p>-->
    <!--                    <h6>Misi</h6>-->
    <!--                    <p class="mb-4">-->
    <!--                        - aasdasdsadasd-->
    <!--                        <br>-->
    <!--                        - asdasasdad-->
    <!--                    </p>-->
    <!--                    {{-- <div class="d-flex align-items-center mb-4 pb-2">-->
    <!--                        <img class="flex-shrink-0 rounded-circle" src="{{asset('dgcom')}}/img/team-1.jpg" alt="" style="width: 50px; height: 50px;">-->
    <!--                        <div class="ps-4">-->
    <!--                            <h6>Jhon Doe</h6>-->
    <!--                            <small>SEO & Founder</small>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <a class="btn btn-primary rounded-pill py-3 px-5" href="">Read More</a> --}}-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- About End -->

    


    <!-- Service Start -->
    <!--<div class="container-xxl py-5">-->
    <!--    <div class="container">-->
    <!--        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">-->
    <!--            <h6 class="section-title bg-white text-center text-intagro px-3">Product & Services</h6>-->
    <!--            <h1 class="display-6 mb-4">Macro Nutrient Fertilizer</h1>-->
    <!--        </div>-->
    <!--        <div class="row content-center">-->
    <!--            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">-->
    <!--                <a class="service-item d-block rounded text-center h-100 p-4" href="">-->
    <!--                    <img class="img-fluid rounded mb-4" src="{{asset('image')}}/macro f.jpg" alt="">-->
    <!--                    <h4 class="mb-0">Macro Nutrient Fertilizer</h4>-->
    <!--                </a>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- Service End -->
    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="img-border" style="border-color: #0ba1b2;">
                        <img class="img-fluid" src="{{asset('image')}}/commodity f.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h6 class="section-title bg-white text-start text-intagro pe-3">Used For</h6>
                        <h1 class="display-6 mb-4">Various Commodity</h1>
                        <p>Dive into the captivating world of commodities with our latest article, which offers an insightful exploration into the trade of some of the most sought-after goods in the market. From the aromatic richness of coffee beans, the indulgent essence of cocoa beans, to the therapeutic properties of clove oil and eugenol, each commodity is unpacked to reveal its unique journey from cultivation to market. Additionally, we delve into the sustainable energy sector through wood pellets, highlighting their role in green energy solutions. This article not only sheds light on the economic and cultural significance of these commodities but also examines the trends, challenges, and opportunities within their global markets, providing a comprehensive overview for enthusiasts, investors, and industry professionals alike.</p>
                        
                        {{-- <div class="d-flex align-items-center mb-4 pb-2">
                            <img class="flex-shrink-0 rounded-circle" src="{{asset('dgcom')}}/img/team-1.jpg" alt="" style="width: 50px; height: 50px;">
                            <div class="ps-4">
                                <h6>Jhon Doe</h6>
                                <small>SEO & Founder</small>
                            </div>
                        </div>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="">Read More</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    
    
    <!-- Project Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="section-title bg-white text-center text-intagro px-3">Our Product and Services</h6>
                <h1 class="display-6 mb-4">Various Commodity</h1>
            </div>
            <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="project-item border rounded h-100 p-4" data-dot="01">
                    <div class="position-relative mb-4">
                        <img class="img-fluid rounded" src="https://www.naturalpigments.com/media/magefan_blog/blog_clove_oil_1.jpg" alt="">
                        <!--<a href="{{asset('dgcom')}}/img/project-10.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>-->
                    </div>
                    <h6 class="text-center">Clove Oil</h6>
                    <!--<span>Digital agency website design and development</span>-->
                </div>
                <div class="project-item border rounded h-100 p-4" data-dot="02">
                    <div class="position-relative mb-4">
                        <img class="img-fluid rounded" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTptQSaMduNXUsVw-lccRgz7msf6B1-_1V7ig&usqp=CAU" alt="">
                        <!--<a href="{{asset('dgcom')}}/img/project-10.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>-->
                    </div>
                    <h6 class="text-center">Eugenol</h6>
                    <!--<span>Digital agency website design and development</span>-->
                </div>
                <div class="project-item border rounded h-100 p-4" data-dot="03">
                    <div class="position-relative mb-4">
                        <img class="img-fluid rounded" src="data:image/jpeg;base64,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" alt="">
                        <!--<a href="{{asset('dgcom')}}/img/project-10.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>-->
                    </div>
                    <h6 class="text-center">Cocoa Bean</h6>
                    <!--<span>Digital agency website design and development</span>-->
                </div>
                <div class="project-item border rounded h-100 p-4" data-dot="04">
                    <div class="position-relative mb-4">
                        <img class="img-fluid rounded" src="https://assets.epicurious.com/photos/63e54a0664e14d52936a2937/16:9/w_4203,h_2364,c_limit/CoffeeSubscriptions_IG_V1_030922_6350_V1_final.jpg" alt="">
                        <!--<a href="{{asset('dgcom')}}/img/project-10.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>-->
                    </div>
                    <h6 class="text-center">Coffee Bean</h6>
                    <!--<span>Digital agency website design and development</span>-->
                </div>
                <div class="project-item border rounded h-100 p-4" data-dot="05">
                    <div class="position-relative mb-4">
                        <img class="img-fluid rounded" src="https://woodpellet-nusantara.com/uploads/pel-19.webp" alt="">
                        <!--<a href="{{asset('dgcom')}}/img/project-10.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>-->
                    </div>
                    <h6 class="text-center">Wood Pellet</h6>
                    <!--<span>Digital agency website design and development</span>-->
                </div>
            </div>
        </div>
    </div>
    <!-- Project End -->


    


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-body footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-light mb-4">Address</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Intagro Asia Pte.,Ltd 133 New Bridge Road, #08-01 Chinatown Point Singapore 059413</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>admin01@intagro.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-secondary rounded-circle me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-secondary rounded-circle me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-secondary rounded-circle me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-secondary rounded-circle me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-light mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="about-us">About Us</a>
                    <a class="btn btn-link" href="contact-us">Contact Us</a>
                    <a class="btn btn-link" href="#">Our Product & Services</a>
                    <a class="btn btn-link" href="#">Terms & Condition</a>
                    <a class="btn btn-link" href="#">Support</a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-light mb-4">Gallery</h5>
                    <div class="row g-2">
                        <div class="col-4">
                            <img class="img-fluid rounded" src="https://i.pinimg.com/564x/c0/6a/bf/c06abfaeb244a4627910bdaa757286c0.jpg" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded" src="https://imgsrv2.voi.id/4j9GT6OEbLsaSGM1ygI3Lnsdi32IgwHtKRMH_m5qZsI/auto/1200/675/sm/1/bG9jYWw6Ly8vcHVibGlzaGVycy8zMDI1MzUvMjAyMzA4MTcyMjA3LW1haW4uY3JvcHBlZF8xNjkyMjg0ODY1LmpwZw.jpg" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded" src="{{asset('dgcom')}}/img/project-3.jpg" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded" src="{{asset('dgcom')}}/img/project-4.jpg" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded" src="{{asset('dgcom')}}/img/project-5.jpg" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded" src="{{asset('dgcom')}}/img/project-6.jpg" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">Intagro.com</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a href="https://htmlcodex.com">Ajidamn</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('dgcom')}}/lib/wow/wow.min.js"></script>
    <script src="{{asset('dgcom')}}/lib/easing/easing.min.js"></script>
    <script src="{{asset('dgcom')}}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{asset('dgcom')}}/lib/counterup/counterup.min.js"></script>
    <script src="{{asset('dgcom')}}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{asset('dgcom')}}/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('dgcom')}}/js/main.js"></script>
</body>

</html>