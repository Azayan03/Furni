class customerReviews extends HTMLElement {
    constructor(){
        super();
        this.innerHTML=`<!-- Start Testimonial Slider -->
		<div class="testimonial-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 mx-auto text-center">
						<h2 class="section-title">Testimonials</h2>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-lg-12">
						<div class="testimonial-slider-wrap text-center">

							<div id="testimonial-nav">
								<span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
								<span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
							</div>

							<div class="testimonial-slider">
								
								<div class="item">
									<div class="row justify-content-center">
										<div class="col-lg-8 mx-auto">

											<div class="testimonial-block text-center">
												<blockquote class="mb-5">
													<p>&ldquo;really good quality, they are comfortable, easy to clean, and durable. Plus, all of their sofas come with a 10-year warranty, which should give some peace of mind when you're shopping!&rdquo;</p>
												</blockquote>

												<div class="author-info">
													<div class="author-pic">
														<img src="../Assests/images/person-1.png" alt="Sara Rezk" class="img-fluid">
													</div>
													<h3 class="font-weight-bold">Sara Rezk</h3>
													<span class="position d-block mb-3">Customer.</span>
												</div>
											</div>

										</div>
									</div>
								</div> 
								<!-- END item -->

								<div class="item">
									<div class="row justify-content-center">
										<div class="col-lg-8 mx-auto">

											<div class="testimonial-block text-center">
												<blockquote class="mb-5">
													<p>&ldquo;They are incredibly affordable, especially when you get into the world of sectionals. Plus, the quality for the price you are paying is absolutely unmatched anywhere else.&rdquo;</p>
												</blockquote>

												<div class="author-info">
													<div class="author-pic">
														<img src="../Assests/images/person_1.jpg" alt="Mohamed Amr" class="img-fluid">
													</div>
													<h3 class="font-weight-bold">Mohamed Amr</h3>
													<span class="position d-block mb-3">Customer.</span>
												</div>
											</div>

										</div>
									</div>
								</div> 
								<!-- END item -->

								<div class="item">
									<div class="row justify-content-center">
										<div class="col-lg-8 mx-auto">

											<div class="testimonial-block text-center">
												<blockquote class="mb-5">
													<p>&ldquo;They’re comfortable, and only get more comfy cozy with time.&rdquo;</p>
												</blockquote>

												<div class="author-info">
													<div class="author-pic">
														<img src="../Assests/images/person_2.jpg" alt="Ahmed Mansour" class="img-fluid">
													</div>
													<h3 class="font-weight-bold">Ahmed Mansour</h3>
													<span class="position d-block mb-3">Customer.</span>
												</div>
											</div>

										</div>
									</div>
								</div> 
								<!-- END item -->

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Testimonial Slider -->`;
    }
}

class landingSection extends HTMLElement {
    constructor(){
        super();
        this.innerHTML=`<div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Modern Interior <span clsas="d-block">Design Studio</span></h1>
                        <p class="mb-4" style="font-size: 18px; letter-spacing: 1px;">A Different Kind Of Company. A Different Kind Of Furniture.</p>
                        <p><a href="shop.html" class="btn btn-secondary me-2">Shop Now</a></p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="../Assests/images/couch.png" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>`;
    }
}

class whyUs extends HTMLElement {
    constructor(){
        super();
        this.innerHTML = `<!-- Start Why Choose Us Section -->
		<div class="why-choose-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-6">
						<h2 class="section-title">Why Choose Us</h2>
						<p>Why Us and not any one of the other compatitors?.</p>

						<div class="row my-5">
							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="../Assests/images/truck.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Fast &amp; Free Shipping</h3>
									<p>Experience swift and dependable delivery services, ensuring that your new furniture arrives promptly to enhance your living space without unnecessary delays.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="../Assests/images/bag.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Easy to Shop</h3>
									<p>Enjoy a seamless shopping experience on our website, designed with user-friendly features, making it easy for you to find and order the perfect pieces for your home.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="../Assests/images/support.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>24/7 Support</h3>
									<p>Our dedicated support team is available around the clock, 24/7, to assist you with any inquiries, provide product information, or address any concerns you may have.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="../Assests/images/return.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Hassle Free Returns</h3>
									<p>We stand by the quality of our products, but if you're not completely satisfied, our hassle-free returns policy ensures a straightforward and easy return process, allowing you to shop with confidence and peace of mind.</p>
								</div>
							</div>

						</div>
					</div>

					<div class="col-lg-5">
						<div class="img-wrap">
							<img src="../Assests/images/why-choose-us-img.jpg" alt="Image" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End Why Choose Us Section -->`;
    }
}

customElements.define('landing-section',landingSection);
customElements.define('customer-reviews',customerReviews);
customElements.define('why-us',whyUs);