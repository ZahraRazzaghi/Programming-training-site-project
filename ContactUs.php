<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="Contact us,programming,learning programming,تماس با ما,برنامه نويسي">
    <title>تماس با ما</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style_index.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style_ContactUs.css " rel="stylesheet" type="text/css">
</head>
<body>
<!--- Start Form --->
<section class="section-bg" style="background-image: url(assets/images/header-img.jpg);" data-scroll-index="7">
    <div class="overlay pt-100 pb-100 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="contact-info">
                        <h2 class="contact-title">آیا سوالی دارید؟</h2>
                        <p class="contact-text"> سوالات خود را از طریق این فرم با ما مطرح کنید قول می دهیم در اصرع وقت به آن ها پاسخ دهیم.
همچنین می توانید انتقادات، پیشنهادات خود را خیلی سریع با ما در میان بگذارید.
                        </p>
                        <ul class="contact-info">
                            <div class="row">
                                <div class="info-left">
                                    <i><img src="assets/images/contast-us-img/phone.png"></i>
                                </div>
                                <div class="info-right">
                                    <h4 dir="ltr">+989028284143</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="info-left">
                                    <i><img src="assets/images/contast-us-img/email.png"></i>
                                </div>
                                <div class="info-right">
                                    <h4>zahrarazzaghi@yahoo.com</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="info-left">
                                    <i><img src="assets/images/contast-us-img/location.png"></i>
                                </div>
                                <div class="info-right">
                                    <h4>ایران</h4>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="contact-form">
                        <!--Contact Form-->
                        <form action="engin/DoContact.php" id='contact-form' method='POST' onsubmit="Swal.fire(
  'با تشکر از بازخورد شما!',
  'پیام شما را دریافت کردیم و در اسرع وقت آن را پاسخ خواهیم داد!',
  'success');">
                            <input type='hidden' name='form-name' value='contactForm' />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="email_title" type="text" name="name" class="form-control" id="first-name" placeholder="عنوان " >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="visitor_email" type="email" name="email" class="form-control" id="email" placeholder="ایمیل خود را وارد کنید *" required="required">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="visitor_message" rows="4" name="message" class="form-control" id="description" placeholder="پیغام خود را وارد کنید *" required="required"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!--contact button-->
                                    <input type="submit" name ="submit" value="ارسال" class="btn-big btn-bg"/>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="assets/js/sweetalert.js"></script>
</body>
</html>