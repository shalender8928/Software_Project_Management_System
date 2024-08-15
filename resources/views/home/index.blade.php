<!DOCTYPE html>
<html lang="en">

@include('home.css_section') 

<body>

  <!-- ======= Header ======= -->

  @include('home.header_section')   

  <!-- End Header -->

  <!-- ======= hero Section ======= -->

  @include('home.section')

  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= Featured Services Section Section ======= -->

    @include('home.featured_services')

    <!-- End Featured Services Section -->

    <!-- ======= About Us Section ======= -->

    @include('home.about_section')

    <!-- End About Us Section -->

    <!-- ======= Services Section ======= -->

    @include('home.service_section')

    <!-- End Services Section -->

   

 

    

    @include('home.facts_section')

  

  

    <!-- ======= Contact Section ======= -->

      @include('home.contact_section')
      
    <!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->

    @include('home.footer_section')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- Vendor JS Files -->
    
  @include('home.js_section')


</body>

</html>
