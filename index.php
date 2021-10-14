<?php
   include("header.php");
   require('./config.php');
   $db = dbconnect();
?>

<?php
   
      /*  $memories_query = "SELECT * FROM memories WHERE 1";
        $result = mysqli_query($db, $memories_query);
		while ($row = mysqli_fetch_assoc($result)) {
			$memorial_link = 'view-memorial.php?id='.$row['memorial_id'];
*/?>

<!-- header-end -->
      <section class="banner homebanner">
         <div class="container">
            <div class="banner-inner-container">
               <div class="banner-content-outer">
                  <div class="row">
                     <div class="col-12 col-sm-12 col-md-6 order-sm-2 ">
                        <div class="banner-left-content">
                           <h1 class="banner-title d-sm-none d-col-none"> <span>Scanners </span> ,Perpetuate<br> And sharing </h1>
                           <!-- <h1 class="banner-title d-none d-sm-block d-col-block"> ומשתפים <span>סורקים </span> ,מנציחים</h1> -->
                           <p class="banner-desc">Because every person had a life story</p>
                           <a href="<?php echo $memorial_link;?>" class="btn yellow-btn ltr"><img src="./assets/images/back.svg" alt="back icon "/> <span>To open a personal commemorative page</span> </a>
                        </div>
                     </div>
                     <div class="col-12 col-sm-12 col-md-6 order-sm-1">
                        <div class="banner-right-content">
                           <img src="./assets/images/home-banner-img.png" alt="banner img" />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php
     // }
      ?>
      <section class="homelayer-2">
         <div class="container">
            <div class="homelayer-text-block">
               <p>מנציחים היא פלטפורמת הנצחה דיגיטלית, המאפשרת למשפחות להנציח את יקיריהם ולתעד את סיפור חייהם המרתק לדורות הבאים. דרך קוד QR אשר יודבק על הקבר/האנדרטה ניתן לסרוק ולהגיע ישירות לסיפורו האישי של הנפטר ולתעד את הביקור בקבר
               </p>
               <a href="<?php echo $memorial_link;?>" class="btn yellow-btn ltr btn-lg"><img src="./assets/images/back.svg" alt="back icon "/> <span>לפתיחת דף הנצחה אישי</span> </a>
            </div>
         </div>
      </section>
      <section class="service-section section-space">
         <div class="container">
            <div class="service-inner-container">
               <div class="row">
                  <div class="col-12">
                     <div class="section-heading">
                        <h2 class="title text-center">תיעוד משמעותי לדור ההמשך
</h2>
                     </div>
                     </div>
               </div>
                <div class="row">
                     <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="service-block text-center">
                            <img src="assets/images/folder.svg" alt="folder">
                            <div class="service-content">
                                <h5 class="subtitle">דף הנצחה אישי</h5>
                                <p class="rtl">כל משפחה תקבל דף בעיצוב אישי אשר יכלול את הסיפורים, הזיכרונות והחוויות שחלקו עם יקיריהם במהלך חייהם.</p>
                            </div>
                        </div>
                     </div>
                     <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="service-block text-center">
                           <img src="assets/images/path.svg" alt="path">
                           <div class="service-content">
                              <h5 class="subtitle">ניווט למקום הקבורה</h5>
                              <p class="rtl">  לפלטפורמה ממשק ניווט ישירות לקבר/לאנדרטה, על מנת שבני המשפחה יוכלו להגיע בקלות ולתעד את ביקורם</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="service-block text-center">
                           <img src="assets/images/img.svg" alt="image">
                           <div class="service-content">
                              <h5 class="subtitle">הוספת תמונות</h5>
                              <p class="rtl">לדף ההנצחה ניתן לצרף תמונות וסרטונים, במטרה להכניס לסיפור חיים ולהנציח את יקירכם בדרך מקורית.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="service-block text-center">
                              <img src="assets/images/QR-code.svg" alt="QR-code">
                              <div class="service-content">
                                 <h5 class="subtitle">קוד QR</h5>
                                 <p class="rtl"> כל משפחה תקבל קוד להדבקה על הקבר/ האנדרטה, על מנת שכל מבקר יוכל לסרוק ולקרוא את סיפור חייו של הנפטר.</p>
                              </div>
                        </div>
                     </div>
                     <div class="col-12">
                           <div class="service-footer">
                              <p class="memorial-page-link"> <a href="<?php echo $memorial_link;?>">להנצחת החוויות והזיכרונות לאהובים שאינם עוד >>></a></p>
                           </div>
                     </div>
                </div>
            </div>
         </div>
      </section>
      <section class="externalization-rufis-section">
            <div class="externalization-innr">
               <div class="container">
               <div class="row row-align">
                  <div class="col-md-6">
                     <div class="externalization-content">
                        <h3 class="rtl"> דרך סיפור ההנצחה, נוצר חיבור אמיתי ושונה לדור ההמשך.</h3>
                        <p class="rtl"> כל חוויה, זיכרון וסיפור גבורה של יקירכם יהיו מתועדים כאן לנצח. </p>
                        <a href="#" class="btn yellow-btn ltr btn-lg d-sm-none"><img src="./assets/images/back.svg" alt="back icon "/> <span> לעיצוב דף הנצחה ></span> </a>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="externalization-img">
                        <img src="assets/images/externalization-img.png" alt="img">
						<div class="mobile-btn d-none">
							<a href="<?php echo $memorial_link;?>" class="btn yellow-btn ltr btn-lg "><img src="./assets/images/back.svg" alt="back icon "/> <span> לעיצוב דף הנצחה ></span> </a>	
					  </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="home-faq">
         <div class="outer">
            <div class="home-faq-inner-container">
               <div class="left-img">
                  <img src="./assets/images/hand-img.png">
               </div>
               <div class="faq-box faq-accordian">
                  <h2 class="rtl"> יש לכם שאלות? יש לנו תשובות. </h2>
                  <div id="accordion" class="accordion">
                     <div class="faq-menu-link" >
                        <div class="faq-header" id="headingOne">
                           <div class="d-flex align-items-center collapsed " data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" role="navigation">
                              <span class="icon" ><i class="fas fa-plus"></i></span>
                              <p class="rtl">מהי העלות של דף הנצחה?</p>
                           </div>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                           <div class="faq-card-body">
                              <p class="rtl">
                                 העלות היא 350 שקלים בלבד באופן חד פעמי, והיא כוללת אחסון של הדף וקבלת מדבקת קוד QR.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="faq-menu-link" >
                        <div class="faq-header" id="headingTwo">
                           <div class="d-flex align-items-center collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" role="navigation">
                              <span class="icon" ><i class="fas fa-plus"></i></span>
                              <p class="rtl">איך מקימים דף הנצחה?</p>
                              
                           </div>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                           <div class="faq-card-body">
                              <p class="rtl">פשוט מאוד. מורידים את הטפסים, ממלאים ושולחים לצוות האתר.</p>
                           </div>
                        </div>
                     </div>
                     <div class="faq-menu-link" >
                        <div class="faq-header" id="headingThree">
                           <div class="d-flex align-items-center collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" role="navigation">
                              <span class="icon" ><i class="fas fa-plus"></i></span>
                              <p class="rtl">האם ניתן להוסיף תמונות לדף?
</p>
                              
                           </div>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                           <div class="faq-card-body">
                              <p class="rtl">וודאי. ניתן להוסיף תמונות וסרטונים על מנת להכניס חיים לסיפור של יקירכם. חשוב שהתמונות תהיינה שלכם (מאלבום פרטי) וללא זכויות יוצרים. 
</p>
                           </div>
                        </div>
                     </div>
                     <div class="faq-menu-link" >
                        <div class="faq-header" id="headingfour">
                           <div class="d-flex align-items-center collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour" role="navigation">
                              <span class="icon" ><i class="fas fa-plus"></i></span>
                              <p class="rtl">כמה זמן הדף יהיה קיים ברשת?</p>
                              
                           </div>
                        </div>
                        <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
                           <div class="faq-card-body">
                              <p class="rtl">לנצח. כל דף יהיה קיים לתמיד, כך שגם דור ההמשך יוכל לקרוא את סיפורו המרתק של הנפטר</p>
                           </div>
                        </div>
                     </div>
                     <div class="faq-menu-link" >
                        <div class="faq-header" id="headingfive">
                           <div class="d-flex align-items-center collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive" role="navigation">
                              <span class="icon" ><i class="fas fa-plus"></i></span>
                              <p class="rtl">איך מקבלים מדבקת קוד QR?</p>
                              
                           </div>
                        </div>
                        <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                           <div class="faq-card-body">
                              <p class="rtl">בתום הרישום והתשלום, צוות האתר ישלח לביתכם בדואר מדבקה מיוחדת להדבקה על הקבר או על האנדרטה.
</p>
                           </div>
                        </div>
                     </div>
                     <div class="faq-menu-link" >
                        <div class="faq-header" id="headingsix">
                           <div class="d-flex align-items-center collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" role="navigation">
                              <span class="icon" ><i class="fas fa-plus"></i></span>
                              <p class="rtl">איך אפשר להיכנס לדף ההנצחה האישי?</p>
                              
                           </div>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingsix" data-parent="#accordion">
                           <div class="faq-card-body">
                              <p class="rtl">לדף האישי ניתן להיכנס בעזרת סריקה של הקוד דרך הנייד, או באמצעות הקלקת שם הנפטר במנוע החיפוש של גוגל ולחיצה על התוצאה של אתר לנצח. 
</p>
                           </div>
                        </div>
                     </div>
                     <div class="faq-menu-link" >
                        <div class="faq-header" id="headingseven">
                           <div class="d-flex align-items-center collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" role="navigation">
                              <span class="icon" ><i class="fas fa-plus"></i></span>
                              <p class="rtl">האם ניתן לייצר דף פרטי?</p>
                              
                           </div>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingseven" data-parent="#accordion">
                           <div class="faq-card-body">
                              <p class="rtl">וודאי. תוכלו להגדיר בדף האם תרצו שהדף יהיה ציבורי ויונגש לכולם או רק בפני אנשים מסוימים. 
</p>
                           </div>
                        </div>
                     </div>
                     <div class="faq-menu-link" >
                        <div class="faq-header" id="headingeight">
                           <div class="d-flex align-items-center collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight" role="navigation">
                              <span class="icon" ><i class="fas fa-plus"></i></span>
                              <p class="rtl">איך סורקים את הקוד QR?</p>
                              
                           </div>
                        </div>
                        <div id="collapseEight" class="collapse" aria-labelledby="headingeight" data-parent="#accordion">
                           <div class="faq-card-body">
                              <p class="rtl">פותחים את המצלמה של הנייד, מכוונים את הצילום על ה- QR ולוחצים על הקישור שיתקבל.</p>
                           </div>
                        </div>
                     </div>
                     <div class="faq-menu-link" >
                        <div class="faq-header" id="headingnine">
                           <div class="d-flex align-items-center collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine" role="navigation">
                              <span class="icon" ><i class="fas fa-plus"></i></span>
                              <p class="rtl">האם ניתן לשתף את דף ההנצחה?</p>
                              
                           </div>
                        </div>
                        <div id="collapseNine" class="collapse" aria-labelledby="headingnine" data-parent="#accordion">
                           <div class="faq-card-body">
                              <p class="rtl">וודאי. בדף קיימים כפתורי שיתוף דרכם ניתן לשתף את הדף בווטצאפ וברשתות חברתיות</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="faq-bottom d-flex align-items-center">
                     <h4 class="rtl"> זו ההזדמנות שלכם להנציח את יקירכם לנצח</h4>
                     <a href="<?php echo $memorial_link;?>" class="btn yellow-btn ltr btn-lg"><img src="./assets/images/back.svg" alt="back icon "/> <span>לפתיחת דף הנצחה</span> </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
    
<?php
   include("footer.php");
?>