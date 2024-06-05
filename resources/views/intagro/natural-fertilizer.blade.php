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
                        <a href="natural-fertilizer" class="dropdown-item active">Natural/Organic Fertilizer</a>
                        <a href="commodity" class="dropdown-item">Various Commodity</a>
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
                        <img class="img-fluid" src="{{asset('image')}}/organic f.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h6 class="section-title bg-white text-start text-intagro pe-3">Used For</h6>
                        <h1 class="display-6 mb-4">Natural Nutrient Fertilizer</h1>
                        <p>Our Natural/Organic Fertilizer is the epitome of eco-conscious gardening, offering a potent mix of composted plant materials, manure, and seaweed to deliver a slow-releasing, nutrient-dense feast for your plants. Tailored for those dedicated to organic cultivation, it enhances soil fertility and structure, promotes robust plant growth, and encourages a vibrant ecosystem in your garden or farm. By improving water retention and stimulating soil microbial activity, it ensures your plants are nourished naturally, fostering healthier growth and higher yields without relying on synthetic inputs. Ideal for all types of plants, from veggies and fruits to ornamentals, our Organic Fertilizer paves the way for a greener, more sustainable approach to gardening, enriching both the earth and your harvest.</p>
                        
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
                <h1 class="display-6 mb-4">Natural Nutrient Fertilizer</h1>
            </div>
            <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
                <<div class="project-item border rounded h-100 p-4" data-dot="01">
                    <div class="position-relative mb-4">
                        <img class="img-fluid rounded" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQO7ggUGZz_iBj3ro2Fc0dc1gUdcq1OqeY9uQ&usqp=CAU" alt="">
                        <!--<a href="{{asset('dgcom')}}/img/project-7.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>-->
                    </div>
                    <h6 class="text-center">Natural Seabird Guano Fertilizer</h6>
                    <div class="row">
                        <div class="col-lg-6 text-center">
                            <span>P2O5 <br> 22%</span>
                        </div>
                        <div class="col-lg-6 text-center" style="border-left-style: solid;">
                            <span>Form <br> Granule</span>
                        </div>
                    </div>
                </div>
                <div class="project-item border rounded h-100 p-4" data-dot="02">
                    <div class="position-relative mb-4">
                        <img class="img-fluid rounded" src="https://5.imimg.com/data5/RN/PA/MY-1207654/dolomite-powder.jpg" alt="">
                        <!--<a href="{{asset('dgcom')}}/img/project-8.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>-->
                    </div>
                    <h6 class="text-center">Dolomite</h6>
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <span>MgO <br> 18%</span>
                        </div>
                        <div class="col-lg-4 text-center" style="border-right-style: solid; border-left-style: solid;">
                            <span>CAO <br> 30%</span>
                        </div>
                        <div class="col-lg-4 text-center">
                            <span>Form <br> Powder</span>
                        </div>
                    </div>
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