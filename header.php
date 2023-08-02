<!DOCTYPE html>
<html lang="<?php echo str_replace("_","-",strtolower(get_locale()));?>">
<?php $td = get_template_directory_uri();
if( is_404() ){
 $addClass404 = 'scrolled add-fixed';
}

$globalGroup = get_field('themes_option','options');
$logoType = $globalGroup['logotype'];
$icon_mobile = $td . '/app/images/icon-mobile.svg';
  ?>
<head>
	<meta charset="<?php bloginfo('charset') ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="apple-touch-icon" sizes="120x120" href="<?= $td?>/app/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $td?>/app/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $td?>/app/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?= $td?>/app/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?= $td?>/app/favicons/safari-pinned-tab.svg" color="#389b48">
    <link rel="shortcut icon" href="<?= $td?>/app/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="<?= $td?>/app/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

	<meta property="og:image" content="<?= $td?>/app/images/dist/og.jpg"/>
	<meta name="mailru-domain" content="ZRsOOmiu8zCM18ew" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head() ?>
	<title><?= wp_get_document_title() ?></title>

    <!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-3E8XSQSGX3"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-3E8XSQSGX3');
	</script>
</head>

<body <?php body_class() ?>>
	<header class="header" id="fixed-header">
			<div class="row container">
                <div class="header__logo col">
                    <a  href="<?php if(is_front_page()){ echo "javascript:void(0);"; }else{echo home_url();} ?>" >
                        <?php if ($logoType["mime_type"] == 'image/svg+xml'): ?>
                            <?= file_get_contents($logoType['url']); ?>
                        <?php elseif($logoType): ?>
                            <img src="<?= $logoType['url'] ?>" class="no-lazy logo-main" alt="<?= $logoType['alt'] ?>" width="<?= $logoType['width'] ?>" height="<?= $logoType['height'] ?>">
                        <?php endif; ?>
                    </a>


                </div>
                <div class="header__right_box col">
                        <nav class="header__menu" aria-label="desktop-header-menu">
                            <?php wp_nav_menu([
                                'theme_location' => 'header_left',
                                'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
                                'container'       => '',
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => 'header__menu-ul',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_page_menu',
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'depth'           => 3,
//                            'walker'=> new example_walker
                            'walker'=> new wp_bootstrap_navwalker
                            ]) ?>
                        </nav>
                    <?php if (!wp_is_mobile()): ?>

                    <?php endif; ?>
                    <div class="header__burger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
				</div>
                <?php if ($globalGroup['button_hire_us']['url']): ?>
                    <div class="header__hire-us col">
                        <a href="<?= $globalGroup['button_hire_us']['url'] ?>" target="<?= $globalGroup['button_hire_us']['target'] ?>" class="hire-us"><?= $globalGroup['button_hire_us']['title'] ?></a>
                    </div>
                <?php endif; ?>

			</div>
	</header>
    <?php get_template_part( 'parts/nav', 'mobile-menu' ); ?>
