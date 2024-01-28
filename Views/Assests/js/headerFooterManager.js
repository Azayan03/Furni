class specialHeader extends HTMLElement {
  constructor(){
    super();
    this.innerHTML = `
        <!-- Start Header/Navigation -->
        <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    
            <div class="container">
                <a class="navbar-brand" href="index.html">Furni<span>.</span></a>
    
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <div class="collapse navbar-collapse" id="navbarsFurni">
                    <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li><a class="nav-link" href="shop.php">Shop</a></li>
                        <li><a class="nav-link" href="about.html">About us</a></li>
                        <li><a class="nav-link" href="services.html">Services</a></li>
                        <li><a class="nav-link" href="contact.html">Contact us</a></li>
                    </ul>
    
                    <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                        <li><a class="nav-link" href="profile.php"><img src="../Assests/images/user.svg"></a></li>
                        <li><a class="nav-link" href="cart.php"><img src="../Assests/images/cart.svg"></a></li>
                    </ul>
                </div>
            </div>
                
        </nav>
        <!-- End Header/Navigation -->
`;
    console.log("Created custom element!");
    }
}

class specialFooter extends HTMLElement {
  constructor(){
    super();
    this.innerHTML =`<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">

				<div class="sofa-img">
					<img src="../Assests/images/sofa.png" alt="Image" class="img-fluid">
				</div>

				<div class="row g-5 mb-5" >
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
						<p class="mb-4" >Furni is a one stop shop where you purchase everything from furniture to household items and more! We inject confidence into the online home shopping experience by solving for brands, manufacturers, and customers.</p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>

					</div>
					<div class="col-lg-8" >
						<div class="row links-wrap" >
							<div class="col-6 col-sm-6 col-md-3" style=" width: 100%; margin-top: 4rem;">
								<ul class="list-unstyled" style="display: flex; width: 100%; justify-content: space-between;">
									<li><a href="about.html">About us</a></li>
									<li><a href="services.html">Services</a></li>
									<li><a href="shop.php">Shop</a></li>
									<li><a href="contact.html">Contact us</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a> Distributed By <a hreff="https://themewagon.com">ThemeWagon</a>  <!-- License information: https://untree.co/license/ --></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- End Footer Section -->	`;
    console.log("Created custom element!");
    }
}

customElements.define('special-header',specialHeader)
customElements.define('special-footer',specialFooter)