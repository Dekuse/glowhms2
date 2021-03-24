
	<?php require APPROOT . '/views/home/inc/header.php'; ?>
	<?php require APPROOT . '/views/home/inc/navbar.php'; ?>



        <section class="home_banner_area">
            <div class="banner_inner d-flex align-items-center">
	
									<ul class="rslides">
						<li><img src="<?php echo URLROOT ?>/public/assets/IMG/1.JPG" alt=""></li>
						<li><img src="<?php echo URLROOT ?>/public/assets/IMG/1.JPG" alt=""></li>
						<li><img src="<?php echo URLROOT ?>/public/assets/IMG/1.JPG" alt=""></li>
						</ul>
				<div class="container">
					<div class=" text-center">
						<h3>Register Your <span>Company</span></h3>
						<p class="banner_detail">COME AND ENJOY ETHIOPIA, THE LAND OF ORIGINS.</p>
						<a class="black_btn" href="#">FASTVISA ON ARRIVAL</a>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Services Area =================-->
        <section class="services_area p_120">
        	<div class="container">
        		<div class="main_title">
        			<h2>Our Offered Services</h2>
        			<p>Top Services of ,Main Department for Immigration and Nationality Affairs-MDINA</p>
        		</div>
        		<div class="row services_inner">
        			<div class="col-lg-4">
        				<div class="services_item">
        					<img src="<?php echo URLROOT ?>/public/home assests/img/icon/service-icon-1.png" alt="">
        					<a href="#"><h4>Passport Services</h4></a>
        					<p>Lorem ipsum dolor sit amet, consecteturadipis icing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="services_item">
        					<img src="<?php echo URLROOT ?>/public/home assests/img/icon/service-icon-2.png" alt="">
        					<a href="#"><h4>Visa Services</h4></a>
        					<p>Lorem ipsum dolor sit amet, consecteturadipis icing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="services_item">
        					<img src="<?php echo URLROOT ?>/public/home assests/img/icon/service-icon-3.png" alt="">
        					<a href="#"><h4>Company Registration</h4></a>
        					<p>Lorem ipsum dolor sit amet, consecteturadipis icing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>


<?php require APPROOT . '/views/home/inc/footer.php'; ?>
<script>
  $(function() {
    $(".rslides").responsiveSlides();
  });
</script>
<script src="<?php echo URLROOT ?>/public/home assests/js/responsiveslides.min.js"></script>
<!-- FOOTER -->
</body>
</html>

