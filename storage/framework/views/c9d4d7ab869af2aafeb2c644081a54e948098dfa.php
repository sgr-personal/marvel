<!-- icon section -->
    <section class="iconsec mt-5 padding-bottom">
        <div class="divider-p-top-lg"></div>
        <div class="container">
            <h2 class="text-center pt-4 mb-4 title-contact">Contact Us</h2>
           
            <div class="row">

                <div class="col-md-4">
                    <div class="icondiv justify-content-center d-flex tossing">
                        <img src="<?php echo e(asset('images/icon1.png')); ?>" alt="phone">
                    </div>
                    
                    <h6 class="text-center my-3 font-weight-bold title-contact">Call Us</h6>
                  
                    <p class="text-center text-capitalize"><strong class="font-weight-bold">Phone:</strong> <?php echo e(Cache::get('whatsapp_number')); ?><br>
                       
                </div>
                <div class="col-md-4">
                    <div class="icondiv justify-content-center d-flex floating">
                        <img src="<?php echo e(asset('images/icon2.png')); ?>" alt="location">
                    </div>
                    
                    <h6 class="text-center my-3 font-weight-bold title-contact">Visit Us</h6>
                    
                    <p class="text-center text-capitalize"><strong class="font-weight-bold">Address:</strong> Lorem ipsum dolor sit amet
                        consectetur adipisicing elit..
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="icondiv justify-content-center d-flex pulse">
                        <img src="<?php echo e(asset('images/icon3.png')); ?>" alt="visit">
                    </div>
                 
                    <h6 class="text-center my-3 font-weight-bold title-contact">Write Us</h6>
                    
                    <p class="text-center text-capitalize"> <strong class="font-weight-bold">Email:</strong><?php echo e(Cache::get('support_email')); ?></p>
                       
                </div>
            </div>
        </div>
    </section>
    <!-- eof icon sec -->



    <!-- contact form -->
    <section class="contactsec1">
        <div class="divider-top-md"></div>
        <div class="wrap">

            <div class="container">
                <form class="cool-b4-form" action="<?php echo e(route('contact')); ?>" method="POST">

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" id="name">
                                <label for="name">Name</label>
                                <span class="input-highlight"></span>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email">
                                <label for="email">Email</label>
                                <span class="input-highlight"></span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" id="phone">
                                <label for="phone">Phone Number</label>
                                <span class="input-highlight"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea name="message" id="message" class="form-control"></textarea>
                                <label for="message">Message</label>
                                <span class="input-highlight"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 mb-5 buttons-type">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="divider-p-bottom-lg"></div>
        </div>

    </section>

    <!-- eof contact form -->

    <!-- map -->
    <section class="mapsec padding-bottom">
        <div class="container">
            <div class="row">
                <div class="mapcontent col-md-12" id="map">
                    <iframe 
                        width="100%" 
                        height="400" 
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" 
                        src="https://maps.google.com/maps?q=+<?php echo e(Cache::get('map_latitude')); ?>+,+<?php echo e(Cache::get('map_longitude')); ?>+&hl=en&z=18&amp;output=embed"
                       >
                    </iframe>
   
                    </div>
            </div>
            <div class="divider-bottom-md"></div>
        </div>

    </section>
    <!-- eof map -->
<?php /**PATH /home/thetricu/marvel.niktechsolution.com/resources/views/themes/ekart/contact.blade.php ENDPATH**/ ?>