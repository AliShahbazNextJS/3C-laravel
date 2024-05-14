@extends('layouts.default')
@section('content')
    <div id="wrapper demo-page" class="demo-page">
    @include('includes.header')

        <div class="demo-page-section mb-5 px-lg-5">
            <div class="container">
                <div class="demo-page-inside">        
                    <div class="row ">
                        <div class="col-12 col-md-6 col-lg-6 d-flex flex-column justify-content-center">
                            <div class="mb-3 demo-page-1 text-center text-md-start mb-5 mb-md-0">
                                <div class="demo-us-text text-center text-md-start">
                                    <h1>Learn <b>About</b> StockPilot</h1>
                                </div>
                                <p>Our pilot analytics system tracks every published trade alert, cancel, and update; as well as actual subscriber account execution prices, across all order legs.</p>
                                <a class="btn custom-btn" href="#">See how it works</a>
                            </div>
                        </div> 
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="about-us-image mb-3">
                                <div class="about-us-image-section mb-3">
                                    <img src="images/demo-page-banner.png" alt="image" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="pilot-section mb-5 px-lg-5">
            <div class="container">
                <div class="pilot-section-container">
                    <div class="row text-center">
                        <div class="col-12">
                            <h2>Pilot</h2>
                        </div>
                        <div class="col-12">
                            <div class="about-us-image mb-3 d-flex flex-column-reverse flex-md-column align-items-center">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <div class="about-us-image-section mb-3">
                                    <img src="images/pilot-section-main.png" alt="image" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dealing-section mb-5 px-lg-5">
            <div class="container">
                <div class="dealing-section-container">
                    <div class="row">
                        <div class="col-12 dealing-section-header d-flex flex-column align-items-center text-center">
                            <h2>How Pilot deal with your <span>Analytics</span></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <div class="col-12  col-md-5 d-flex flex-column justify-content-center">
                            <div class="dealing-img-container">
                                <img src="images/dealing-section-vector.png" alt="image1" class="d-none d-md-block img-fluid mx-auto"/>
                                <img src="images/dealing-section-img1.png" alt="image2"  class="d-block d-md-none img-fluid mx-auto"/>
                            </div>
                        </div>
                        <div class="col-12 col-md-7 text-left p-3">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="py-3">Pre-Flight Ranking</h3>
                                    <p>When new traders register with the Stock Pilot platform, they are prompted to upload a copy of their personal transaction history data provided by their brokerage. </p>
                                    <a href="#">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                      </svg> </a>
                                </div>
                                <div class="col-12 col-lg-6 p-3">
                                    <div class="dealing-card p-4">
                                        <span class="rounded-circle">2</span>
                                        <h4 class="mt-2">Platform Ranking</h4>
                                        <p>We use the Platform Ranking System to rank each Pilot.</p>
                                        <a href="#">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                          </svg> </a>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 p-3">
                                    <div class="dealing-card p-4">
                                        <span class="rounded-circle">3</span>
                                        <h4 class="mt-2">Pilot Analytics</h4>
                                        <p>We use the Platform Ranking System to rank each Pilot.</p>
                                        <a href="#">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                          </svg> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="subscribes-section mb-5 px-lg-5">
            <div class="container">
                <div class="pilot-section-container">
                    <div class="row text-center">
                        <div class="col-12">
                            <h2>Subscribers</h2>
                        </div>
                        <div class="col-12">
                            <div class="about-us-image mb-3 d-flex flex-column-reverse flex-md-column align-items-center">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <div class="about-us-image-section mb-3">
                                    <img src="images/pilot-section-main.png" alt="image" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="possition-strategy_section mb-5 px-lg-5">
            <div class="container">
                <div class="possition-strategy-container">
                    <div class="row py-5">
                        <div class="col-12 mb-5">
                            <div class="row text-center text-md-start">
                                <div class="col-12 col-md-6 d-flex flex-column justify-content-center">
                                    <h2 class="mb-3">Position <span>Scaling</span></h2>
                                    <div class="possition-image-container d-md-none mb-3">
                                        <img src="images/possition-vector1.png" class="img-fluid mx-auto d-block"/>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <a href="#">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                      </svg> </a>
                                </div>
                                <div class="col-12 col-md-6 d-none d-md-block">
                                    <img src="images/possition-vector.png" class="img-fluid mx-auto d-block"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row text-center text-md-start">
                                <div class="col-12 col-md-6 d-none d-md-block">
                                    <img src="images/strategy-vector.png" class="img-fluid mx-auto d-block"/>
                                </div>
                                <div class="col-12 col-md-6 d-flex flex-column justify-content-center">
                                    <h2 class="mb-3">Strategy Amounts</h2>
                                    <div class="strategy-image-container d-md-none mb-3">
                                        <img src="images/strategy-vector.png" class="img-fluid mx-auto d-block"/>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <a href="#">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                      </svg> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container_">
            <div class="contact-us-form mb-5 col-lg-10 mx-auto d-block px-lg-5">
                <div class="text-center overflow-hidden mb-3">
                    <h2> <span>Request</span>a live demo!</h2>
                    <p>Please complete the form below and we will be in touch with you soon.</p>
                </div>
                <form class="row g-3">
                  <div class="col-md-6 col-12">
                    <label for="inputEmail4" class="form-label">Full Name<span class="times">*</span></label>
                    <input type="text" class="form-control bg-transparent" placeholder="Full Name" id="inputEmail4">
                  </div>
                  <div class="col-md-6 col-12 mb-3">
                    <label class="form-label" for="inputSelect">Select Service<span class="times">*</span></label>
                    <select class="form-select bg-transparent text-secondary" id="inputSelect" name="inputSelect">
                        <option value="Service1">Service1</option>
                        <option value="Service2">Service2</option>
                    </select>
                  </div>
                   <div class="col-md-6 col-12">
                    <label for="inputPassword5" class="form-label">Email<span class="times">*</span></label>
                    <input type="email" placeholder="mail@gmail.com" class="form-control bg-transparent" id="inputPassword5">
                  </div>
                   <div class="col-md-6 col-12">
                    <label for="inputPassword6" class="form-label">Contact Number<span class="times">*</span></label>
                    <div class="d-flex flex-row rounded border"> 
                        <select class="form-select bg-transparent text-secondary border-0 w-25 border-right" id="inputSelect" name="inputSelect">
                            <option value="us">US</option>
                            <option value="poland">POLAND</option>
                            <option value="china">CHINA</option>
                        </select>
                        <input type="password" placeholder="(+1) 000-000-1234"  class="form-control bg-transparent border-0" id="inputPassword6">    
                    </div>
                  </div>
                  <div class="mb-3">
                   <label for="exampleFormControlTextarea1" class="form-label">Description<span class="times">*</span></label>
                   <textarea class="form-control bg-transparent" placeholder="mail@gmail.com" id="exampleFormControlTextarea1" rows="4"></textarea>
                 </div>
                 <div class="communication-form mb-3 m-auto text-center">
                    <p class="mb-2">Preferred source of communication:</p>
                     <div class="communication ">
                        <div class="communication-email d-flex justify-content-between align-items-center px-5">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name=" flexRadioDefault" id="flexRadioDefault2" checked>
                              <label class="form-check-label" for="flexRadioDefault2">
                                    Email
                                </label>
                            </div>
                        <div class="communication-email">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name=" flexRadioDefault" id="flexRadioDefault2" checked>
                              <label class="form-check-label" for="flexRadioDefault2">
                                    Call
                                </label>
                            </div>
                        </div>
                     </div>
                    </div>
                </div>
                    <div class="communication-btn">
                        <a class="btn custom-btn" href="#">Submit</a>
                    </div>
                    <p class="mb-2 text-center">We will never share your information</p>
                </form>
            </div>
        </div>

        @include('includes.testimonials')
        @include('includes.newsletter')
        @include('includes.footer')
    </div>
@stop