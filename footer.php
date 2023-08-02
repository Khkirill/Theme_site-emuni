<?php
$td = get_template_directory_uri();
$fooGroup = get_field('themes_option','options');
$icon_sussesCheck = $td . '/app/images/susse-check.svg';?>
 
<footer class="footer" id="contact-us">
    <div class="footer__contact-us">
        <div class="container row">
            <div class="col-5 col-lg-12 col footer__contact-us__info">
                <div class="footer__contact-us__info-box">
                    <div class="contact-title" data-aos="fade-right" data-aos-duration="700"><?= $fooGroup['contact_title'] ?> </div>
                    <?php if ($contacts = $fooGroup['contact_info']) : ?>
                        <ul class="">
                        <?php $i=1; foreach ($contacts as $ctItem) : ?>
                            <?php if ($ctItem['type_info'] == 'address_inf'): ?>
                                <li data-aos="fade-right" data-aos-duration="700"  data-aos-delay="<?= $i ?>00">
                                    <?php if ($ctItem['info_link']): ?>
                                        <a href="<?= $ctItem['info_link'] ?>" class="address-ct" rel="nofollow" target="_blank"><?= $ctItem['info_text'] ?></a>
                                    <?php else: ?>
                                        <span class="address-ct"><?= $ctItem['info_text'] ?></span>
                                    <?php endif; ?>

                                </li>
                            <?php elseif ($ctItem['type_info'] == 'phone_inf'): ?>
                                <li data-aos="fade-right" data-aos-duration="700" data-aos-delay="<?= $i ?>00">
                                    <a href="tel:<?= $ctItem['info_link'] ?>" class="phone-ct" rel="nofollow"><?= $ctItem['info_text'] ?></a>
                                </li>
                            <?php elseif ($ctItem['type_info'] == 'email_inf'): ?>
                                <li data-aos="fade-right" data-aos-duration="700" data-aos-delay="<?= $i ?>00">
                                    <a href="mailto:<?= $ctItem['info_link'] ?>" class="email-ct" rel="nofollow"><?= $ctItem['info_text'] ?></a>
                                </li>
                            <?php endif; ?>
                        <?php $i++; endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <?php $imageFooter  = $fooGroup['contact_image_info'] ; ?>
                <?php if($imageFooter): ?>
                    <div class="footer__contact-us__image"  data-aos="fade-zoom-in" data-aos-duration="900" data-aos-delay="300">
                    <?php if ($imageFooter["mime_type"] == 'image/svg+xml'): ?>
                        <?= file_get_contents($imageFooter['url']); ?>
                    <?php elseif($imageFooter): ?>
                        <img src="<?= $imageFooter['url'] ?>" alt="<?= $imageFooter['alt'] ?>" width="<?= $imageFooter['width'] ?>" height="<?= $imageFooter['height'] ?>">
                    <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-7 col-lg-12 col footer__contact-us__form">
                <div class="footer__contact-us__form-wrap" data-aos="fade-left" data-aos-duration="700">
                    <?php if($fooGroup['form_sub_title']): ?>
                        <h3 class="col col-12"><?= $fooGroup['form_sub_title'] ?></h3>
                    <?php endif; ?>
                    <?php if($fooGroup['form_title']): ?>
                        <h2 class="col col-12"><?= $fooGroup['form_title'] ?></h2>
                    <?php endif; ?>
                    <?php $insta = $fooGroup['shortcode_form'] ?>
                    <?= do_shortcode($insta); ?>
                    <div class="footer__contact-us__thans-popup" id="form-popup-footer" style="display: none">
                        <span><?= file_get_contents($icon_sussesCheck); ?></span>
                        <div class="text">
                            Thank you! Your submission has been received!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  	<div class="container footer__top">
  			<div class="row footer__row">
   				<div class="col col-12 footer__logo-menu">
                    <?php
                    $footerLogo = $fooGroup['logotype_footer'];
                    if ($footerLogo["mime_type"] == 'image/svg+xml'): ?>
                        <div class="footer__logo ">
                            <?= file_get_contents($footerLogo['url']); ?>
                        </div>
                    <?php elseif ($footerLogo): ?>
                        <div class="footer__logo ">
                            <img src="<?= $footerLogo['url'] ?>" alt="<?= $footerLogo['alt'] ?>" width="<?= $footerLogo['width'] ?>" height="<?= $footerLogo['height'] ?>">
                        </div>
                    <?php endif; ?>

                    <?php wp_nav_menu([
                        'theme_location' => 'footer_menu_col-1',
                        'container' => 'nav',
                    ]) ?>
  				</div>


  			</div>
  	</div>
    <div class="container footer__copyright col col-12 row">
         <?= $fooGroup['copyright_footer'] ?>
    </div>
  </footer>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
  <?php wp_footer() ?>

  </body>
</html>