<?php 
   include('header.php');
?>
<section class="banner payment memorial-banner banner-eleven">
    <div class="container">
        <div class="banner-inner-container">
            <div class="banner-content-outer">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="banner-left-content workbanner-left-content">
                         <p class="banner-desc m-0">עמוד רכישה</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="memorial-fields-section paymentform-outer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="paymentform-wrap">
                  <form action="/action_page.php">
                    <div class="form-group">
                      <label for="name">מספר כרטיס אשראי</label>
                      <input type="text" class="form-control" id="name" placeholder="אלמ םש" name="name">
                    </div>		
                    <div class="form-group">
                      <label for="name">תאריך</label>
                      <div class="innerfield">
                            <div class="fiftyfield">
                                <input type="text" class="form-control" id="name" placeholder="00" name="name">
                            </div>	
                            <div class="fiftyfield">
                                <input type="text" class="form-control" id="name" placeholder="00" name="name">
                            </div>									
                        </div>	
                    </div>	
                    <div class="form-group">
                      <label for="name">מספר תעודת זהות</label>
                      <input type="text" class="form-control" id="name" placeholder="רפסמ" name="name">
                    </div>	
                    <div class="form-group">
                      <label for="name">CVV</label>
                      <input type="text" class="form-control" id="name" placeholder="000" name="name">
                    </div>							
                    <a href="payment-successful.php"><button type="button" class="submitbtn">המשך</button></a>
                    <div class="form-group forgetwrap">
                      <a class="forgetbtn" href="#">לא מצליח להתחבר</a>
                    </div>	
                  </form>
                </div>
            </div>			
        </div>

    </div>
</section>
<?php 
   include('footer.php');
?>