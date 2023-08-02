<?php $td = get_template_directory_uri();
$icon_mobile = $td . '/app/images/icon-mobile.svg';
$phone = get_field('phone_number','options');
$phoneNoSpace = get_field('phone_number_nospace','options');

//$search_icon = $td . '/app/images/search-icon.svg';
?>
<div class="header__modal" style="    transform: translateX(100%)">
    <div class="modal__logo_box">

        <div class="header__burger">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
		<div class="container">
			<div class="modal__content">
				<?php wp_nav_menu([
					'theme_location' => 'header_left',
					'container' => '',
					'container_aria_label' => 'mobile-header-menu',
					'items_wrap' => '<nav><ul class="modal__menu">%3$s</ul></nav>',
				]) ?>
                <?php if( $phone !='' && $phoneNoSpace !=''): ?>
                    <div class="header__button-phone">
                        <div class="btn-phone">
                            <a href="tel:<?= $phoneNoSpace ?>"> <?= file_get_contents($icon_mobile); ?><?= $phone ?></a>
                        </div>
                    </div>
                <?php endif; ?>
			</div>
		</div>
	</div>