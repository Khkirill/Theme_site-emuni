<?php
$td = get_template_directory_uri();
$bgFirst = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
if(!$bgFirst[0] != ''){
    $bgFirst[0] = $td .'/app/images/dist/background_2.jpg';
}
get_header() ?>
    <main class="page">
        <?php if( $slider = get_field('first_screen_slider')) : ?>
        <section class="slider">

                <div class="slider__wrapper container">
                <?php foreach($slider as $slidItem) : ?>
                <div class="slider__content">
                    <div class="slider__item-box">
                        <div class="slider__title"><?= $slidItem['title_slide'] ?></div>
                        <div class="slider__subtitle"><?= $slidItem['subtitle_slide'] ?></div>
                        <div class="slider__price-text"><?= $slidItem['text_price_slide'] ?></div>
                        <?php $button = $slidItem['button_slide']; ?>
                        <?php if( $button['bl']!='' && $button['bn']!=''): ?>
                        <div class="slider__btn-box">
                            <a href="<?php echo $button['bl']; ?>"><?php echo $button['bn']; ?></a>
                        </div>
                        <?php endif; ?>
                        <div class="slider__image">
                            <?php
                            $image  = $slidItem['image_slide'];  ?>
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" />
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                </div>

        </section>
        <?php endif; ?>
        <section class="first-screen btParallax"  data-parallax="0.8" data-parallax-offset="0" style="background-image: url('<?= $bgFirst[0] ?>')">
            <div class="container row">
                <div class="col-12 col first-screen__content">
                    <div class="first-screen__breadcrumbs" data-aos="fade-up"  data-aos-duration="800">
                        <?php if ( function_exists( 'dimox_breadcrumbs' ) ) dimox_breadcrumbs(); ?>
                    </div>
                    <?php the_title('<h1 class="first-screen__title"  data-aos="fade-up"  data-aos-duration="900">', '</h1>', true); ?>
                    <div class="first-screen__description"  data-aos="fade-up"  data-aos-duration="1000">
                        <?php the_field('text_after_title'); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        $content = apply_filters('the_content', get_the_content());
        if(!empty($content)): ?>
            <section class="default-content">
                <div class="container row">
                    <div class="col-12 col default-content__box">
                        <?= $content ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if (have_rows('flexible_content_other_pages')): ?>
            <?php while (have_rows('flexible_content_other_pages')) : the_row();
                $ACF_layout = get_row_layout(); ?>
                <?php if ($ACF_layout == 'new_service_flexrow'): /// Flex Row ?>
                <section class="services">
                    <div class="container row">
                        <div class="services__left_column col-6 col">
                            <div class="section__sub-title sub-title" data-aos="fade-up"  data-aos-duration="800"><?php the_sub_field('sub_title'); ?></div>
                            <h2 class="section__title title-section" data-aos="fade-up"  data-aos-duration="900"><?php the_sub_field('title'); ?></h2>
                            <div class="description" data-aos="fade-up"  data-aos-duration="1000"><?php the_sub_field('description'); ?></div>
                            <?php $button = get_sub_field('button'); ?>
                            <?php if ($button['button_text'] != '' && $button['button_link'] != ''): ?>
                                <a class="btn btn__color_one" href="<?= $button['button_link']; ?>" data-aos="fade-up"  data-aos-duration="1100"><?= $button['button_text']; ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="services__right_column col-6 col" data-aos="fade-up"  data-aos-duration="800">
                            <?php $imgRight = get_sub_field('image_right') ?>
                            <?php if($imgRight): ?>
                            <img src="<?= $imgRight['url'] ?>" alt="<?= $imgRight['alt'] ?>" width="<?= $imgRight['width'] ?>" height="<?= $imgRight['height'] ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <?php elseif ($ACF_layout == 'column_three_text_flexrow'): /// Flex Row ?>
                <section class="second-services">
                    <div class="container">
                        <?php if( $secondServices = get_sub_field('content_repiter')) : ?>
                            <div class="second-services__wrapper row col-12">
                            <?php $i=1; foreach($secondServices as $item) : ?>
                                <div class="second-services__item col-4" data-aos="fade-up"  data-aos-duration="1<?= $i ?>00">
                                    <div class="sub-title second-services__sub-title"><?= $item['sub_title'] ?></div>
                                    <div class="second-services__title"><?= $item['title'] ?></div>
                                    <div class="second-services__description"><?= $item['description'] ?></div>
                                    <?php $button = $item['button_learn_more']; ?>
                                    <?php if ($button['button_text'] != '' && $button['button_link'] != ''): ?>
                                        <a class="lear-more" href="<?= $button['button_link']; ?>"><?= $button['button_text']; ?></a>
                                    <?php endif; ?>
                                </div>
                            <?php $i=1; endforeach;?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
                <?php elseif ($ACF_layout == 'our_experience_flexrow'): /// Flex Row ?>
                   <?php  $bgImage = get_sub_field('background_image');
                    if($bgImage != ''){
                        $addClassBg = 'btParallax';
                    }?>
                <section class="our-experience <?= $addClassBg ?>" <?php if ($bgImage): ?> data-parallax="0.1" data-parallax-offset="0" style="background-image: url('<?= $bgImage['url'] ?>')"<?php endif; ?>>
                    <div class="container row">
                        <div class="our-experience__left-column col col-6">
                            <div class="our-experience__title"><?php the_sub_field('title'); ?></div>
                            <div class="our-experience__description">
                                <?php the_sub_field('description'); ?>
                            </div>
                        </div>
                        <div class="our-experience__right-column col col-4">
                            <div class="our-experience__board__wrapper">
                                <div class="our-experience__board__subtitle sub-title"><?php the_sub_field('sub_title_board'); ?></div>
                                <h2 class="our-experience__board__title"><?php the_sub_field('title_board'); ?></h2>
                                <div class="our-experience__board__description">
                                    <?php the_sub_field('description_board'); ?>
                                </div>
                                <?php if( $iconBoard = get_sub_field('icon_board_repiter')) : ?>
                                <ul class="our-experience__iconbox">
                                    <?php foreach($iconBoard as $item) : ?>
                                        <li class="our-experience__iconbox__item">
                                            <div class="our-experience__iconbox__icon">
                                                <?php if ($item['icon']["mime_type"] == 'image/svg+xml'): ?>
                                                    <?= file_get_contents($item['icon']['url']); ?>
                                                <?php elseif($logoType): ?>
                                                    <img src="<?= $item['icon']['url'] ?>" alt="<?= $item['icon']['alt'] ?>" width="<?= $item['icon']['width'] ?>" height="<?= $item['icon']['height'] ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="our-experience__iconbox__text">
                                                <div class="our-experience__iconbox__text-title"><?= $item['title'] ?></div>
                                                <div class="our-experience__iconbox__text-description"><?= $item['description'] ?></div>
                                            </div>
                                        </li>
                                    <?php endforeach;?>
                                    </ul>
                                <?php endif; ?>

                                <?php $button = get_sub_field('button_board'); ?>
                                <?php if ($button['button_text'] != '' && $button['button_link'] != ''): ?>
                                    <a class="btn" href="<?= $button['button_link']; ?>"><?= $button['button_text']; ?> <span><?= file_get_contents($arrow_right_svg); ?></span></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <?php elseif ($ACF_layout == 'what_we_do_flexrow'): /// Flex Row ?>
                <?php $bgImage = get_sub_field('background_image');
                if($bgImage != ''){
                    $addClassBg = 'what-we-do__add-background btParallax';
                }
                ?>
                <section class="what-we-do <?= $addClassBg ?>" <?php if ($bgImage): ?>  data-parallax="0.1" data-parallax-offset="0" style="background-image: url('<?= $bgImage['url'] ?>')"<?php endif; ?>>
                    <div class="container">
                        <div class="what-we-do__subtitle sub-title col col-12"  data-aos="fade-up"  data-aos-duration="800"><?php the_sub_field('sub_title'); ?></div>
                        <div class="what-we-do__title title-section col col-12"  data-aos="fade-up"  data-aos-duration="900"><?php the_sub_field('title'); ?></div>
                        <div class="what-we-do__description col col-12"  data-aos="fade-up"  data-aos-duration="1000"><?php the_sub_field('description'); ?></div>
                        <?php if( $whatWeDo = get_sub_field('icon_title_repeater')) : ?>
                            <div class="what-we-do__icon-box row">
                            <?php $i=0; foreach($whatWeDo as $item) : ?>
                            <div class="what-we-do__icon-box__item col col-4 col-sm-12" data-aos="fade-up"  data-aos-duration="1<?= $i; ?>00">
                                <div class="what-we-do__icon-box__icon">
                                    <?php if ($item['icon']["mime_type"] == 'image/svg+xml'): ?>
                                        <?= file_get_contents($item['icon']['url']); ?>
                                    <?php elseif($logoType): ?>
                                        <img src="<?= $item['icon']['url'] ?>" alt="<?= $item['icon']['alt'] ?>" width="<?= $item['icon']['width'] ?>" height="<?= $item['icon']['height'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="what-we-do__icon-box__title"><?= $item['title'] ?></div>
                                <div class="what-we-do__icon-box__description"><?= $item['description'] ?></div>
                            </div>
                            <?php $i++; endforeach;?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
                <?php elseif ($ACF_layout == 'about_us_syn_res_flexrow'): /// Flex Row ?>
                <?php
                    $check_svg = $td . '/app/images/check.svg';
                    $star_svg = $td . '/app/images/star.svg';
                    $blockAlight = get_sub_field('type_info');
                if($blockAlight == 'image_left_text_right'){
                    $addClass = 'image-left';
                }?>
                    <section class="about-three-column">
                        <div class="container row about-three-column__lfrt <?= $addClass ?> ">
                            <div class="about-three-column__left col col-8">
                                <h2 class="title-section" data-aos="fade-up"  data-aos-duration="800"><?php the_sub_field('title'); ?></h2>
                                <div class="desciption-block" data-aos="fade-up"  data-aos-duration="900"><?php the_sub_field('description'); ?></div>
                            </div>
                            <div class="about-three-column__right  col col-4" data-aos="fade-up"  data-aos-duration="800">
                                <?php $image = get_sub_field('images'); ?>
                                <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" width="<?= $image['width'] ?>" height="<?= $image['height'] ?>">
                            </div>
                            </div>
                            <?php if( $threeColumn = get_sub_field('three_col_repeater')) : ?>
                                <div class="about-three-column__wrapper container row">
                                <?php $i=0; foreach($threeColumn as $item) : ?>
                                    <div class="about-three-column__item col col-4"  data-aos="fade-up"  data-aos-duration="1<?= $i; ?>00">
                                        <div class="about-three-column__item__image col-4">
                                            <?php
                                            $image  = $item['image'];
                                            $size   = 'thumbnail';
                                            $alt    = $image['alt'];
                                            $thumb  = $image['sizes'][ $size ];
                                            $width  = $image['sizes'][ $size . '-width' ];
                                            $height = $image['sizes'][ $size . '-height' ];?>
                                            <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
                                        </div>
                                        <div class="about-three-column__item__content col-8">
                                            <div class="about-three-column__item__subtitle col-12"><?= $item['after_title'] ?></div>
                                            <div class="about-three-column__item__title col-12"><?= $item['title'] ?></div>
                                            <div class="about-three-column__item__description col-12"><?= $item['text'] ?></div>
                                            <div class="about-three-column__item__button-box">
                                                <?php if( $item['read_more_text']!='' && $item['read_more_link']!=''): ?>
                                                    <a class="read-more" href="<?= $item['read_more_link']; ?>">
                                                        <span><?= file_get_contents($check_svg); ?></span><?= $item['read_more_text']; ?>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if( $item['get_started_text']!='' && $item['get_started_link']!=''): ?>
                                                    <a class="get-started" href="<?= $item['get_started_link']; ?>">
                                                        <span><?= file_get_contents($star_svg); ?></span><?= $item['get_started_text']; ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php $i++; endforeach;?>
                            </div>
                            <?php endif; ?>
                    </section>
                <?php elseif ($ACF_layout == 'our_exp_about_flexrow'): /// Flex Row ?>
                    <?php  $bgImage = get_sub_field('background_image');
                    if($bgImage != ''){
                        $addClassBg = 'btParallax';
                    }
                    $contentAlign = get_sub_field('align_information');
                    $viewBlock = get_sub_field('views_block_type');
                    if($viewBlock =='full-bg'){
                        $addClassView = 'bg-column-full';
                    }else{
                        $addClassView = 'bg-column';
                    }?>
                    <section class="our_exp_about <?= $addClassBg; ?>" <?php if ($bgImage): ?> data-parallax="0.1" data-parallax-offset="0" style="background-image: url('<?= $bgImage['url'] ?>')"<?php endif; ?>>
                        <div class="container row">
                            <div class="our_exp_about__content col col-12 <?= $contentAlign ?>">
                                <?php if(get_sub_field('sub_title')): ?>
                                    <div class="our_exp_about__subtitle sub-title" data-aos="fade-up" data-aos-duration="800"><?php the_sub_field('sub_title'); ?></div>
                                <?php endif; ?>
                                <?php if(get_sub_field('title')): ?>
                                    <div class="our_exp_about__title title-section" data-aos="fade-up"  data-aos-duration="900"><?php the_sub_field('title',false, false); ?></div>
                                <?php endif; ?>
                               <?php if(get_sub_field('description')): ?>
                                   <div class="our_exp_about__description" data-aos="fade-up"  data-aos-duration="1000">
                                       <?php the_sub_field('description'); ?>
                                   </div>
                               <?php endif; ?>
                            </div>
                        </div>
                        <div class="container row col col-12 <?= $addClassView ?> ">
                            <?php if( $iconBoard = get_sub_field('icon_board_repiter')) : ?>
                                <ul class="our_exp_about__iconbox container row">
                                    <?php $i=0; foreach($iconBoard as $item) : ?>
                                        <li class="our_exp_about__iconbox__item col-4 col"data-aos="fade-up"  data-aos-duration="1<?= $i; ?>00">
                                            <div class="our_exp_about__iconbox__wrapper">
                                                <div class="our_exp_about__iconbox__icon">
                                                    <?php if ($item['icon']["mime_type"] == 'image/svg+xml'): ?>
                                                        <?= file_get_contents($item['icon']['url']); ?>
                                                    <?php elseif($logoType): ?>
                                                        <img src="<?= $item['icon']['url'] ?>" alt="<?= $item['icon']['alt'] ?>" width="<?= $item['icon']['width'] ?>" height="<?= $item['icon']['height'] ?>">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="our_exp_about__iconbox__text">
                                                    <div class="our_exp_about__iconbox__text-title"><?= $item['title'] ?></div>
                                                    <div class="our_exp_about__iconbox__text-description"><?= $item['description'] ?></div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php $i++; endforeach;?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <?php $button = get_sub_field('button_board');
                              $btnOutline = get_sub_field('button_our_line'); ?>
                        <?php if(($button['button_text'] != '' && $button['button_link'] != '' || $btnOutline['button_text'] != '' && $btnOutline['button_link'] != '')): ?>
                            <div class="container row col col-12 our_exp_about__button">
                            <?php if ($button['button_text'] != '' && $button['button_link'] != ''): ?>
                                <a class="btn" href="<?= $button['button_link']; ?>" data-aos="fade-left"  data-aos-duration="800"><?= $button['button_text']; ?></a>
                            <?php endif; ?>
                            <?php if ($btnOutline['button_text'] != '' && $btnOutline['button_link'] != ''): ?>
                                <a class="btn btn__outline_whrite" href="<?= $btnOutline['button_link']; ?>" data-aos="fade-left"  data-aos-duration="900"><?= $btnOutline['button_text']; ?> </a>
                            <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php elseif ($ACF_layout == 'services_in_box_flexrow'): /// Flex Row ?>
                    <section class="services_in">
                        <div class="container row">
                            <div class="services_in__content col col-12 <?= $contentAlign ?>">
                                <?php if(get_sub_field('sub_title')): ?>
                                    <div class="services_in__subtitle sub-title" data-aos="fade-up"  data-aos-duration="800"><?php the_sub_field('sub_title'); ?></div>
                                <?php endif; ?>
                                <?php if(get_sub_field('title')): ?>
                                    <div class="services_in__title title-section" data-aos="fade-up"  data-aos-duration="900"><?php the_sub_field('title'); ?></div>
                                <?php endif; ?>
                                <?php if(get_sub_field('description')): ?>
                                    <div class="services_in__description" data-aos="fade-up"  data-aos-duration="1000">
                                        <?php the_sub_field('description'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if( $servicesItems = get_sub_field('services_content_repeater')) : ?>
                            <div class="services_in__services-box row">
                                    <?php $i=0; foreach($servicesItems as $scItem) : ?>
                                        <div class="services_in__items col col-3" data-aos="fade-up"  data-aos-duration="1<?= $i; ?>00">
                                            <div class="services_in__items__images">
                                                <a href="<?= $scItem['button_link']; ?>">
                                                <?php
                                                $image  = $scItem['image_services'];
                                                $size   = 'large';
                                                $alt    = $image['alt'];
                                                $thumb  = $image['sizes'][ $size ];
                                                $width  = $image['sizes'][ $size . '-width' ];
                                                $height = $image['sizes'][ $size . '-height' ];?>
                                                <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
                                                    <span class="bg-anim">
                                                        <span class="plus-plus">
                                                           <svg id="a" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"><path d="M18,1c9.37,0,17,7.63,17,17s-7.63,17-17,17S1,27.37,1,18,8.63,1,18,1m0-1C8.06,0,0,8.06,0,18s8.06,18,18,18,18-8.06,18-18S27.94,0,18,0h0Z" style="fill:#fff;"/><line x1="18" y1="6" x2="18" y2="30" style="fill:none; stroke:#fff; stroke-miterlimit:10;"/><line x1="30" y1="18" x2="6" y2="18" style="fill:none; stroke:#fff; stroke-miterlimit:10;"/></svg>
                                                        </span>
                                                    </span>

                                                </a>
                                            </div>
                                            <div class="services_in__items__content-box">
                                                <div class="services_in__items__subtitle"><?= $scItem['sub_title_services']; ?></div>
                                                <div class="services_in__items__title"><?= $scItem['title_services']; ?></div>
                                                <div class="services_in__items__description"><?= $scItem['description_services']; ?></div>
                                                <a href="<?= $scItem['button_link']; ?>" class="services_in__items__learmore"><?= $scItem['button_text']; ?></a>
                                            </div>
                                        </div>
                                    <?php $i++; endforeach;?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php elseif ($ACF_layout == 'image_left_content_right_flexrow'): /// Flex Row ?>
                <?php $blockSet = get_sub_field('block_setting');
                if($blockSet == 'content_left'){
                    $addClass = 'image-and-content__content-left';
                }
                ?>
                <section class="image-and-content <?= $addClass ?>">
                    <div class="container row">
                        <div class="image-and-content__image-box col col-6" data-aos="fade"  data-aos-duration="1200">
                            <?php
                            $image  = get_sub_field('image');
                            $size   = 'large';
                            $alt    = $image['alt'];
                            $thumb  = $image['sizes'][ $size ];
                            $width  = $image['sizes'][ $size . '-width' ];
                            $height = $image['sizes'][ $size . '-height' ];?>
                            <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
                        </div>
                        <div class="image-and-content__content-box col col-6" >
                            <div class="image-and-content__content-box__wrapper">
                                <?php if(get_sub_field('sub_title')): ?>
                                    <div class="image-and-content__subtitle sub-title" data-aos="fade-up"  data-aos-duration="800"><?php the_sub_field('sub_title'); ?></div>
                                <?php endif; ?>
                                <?php if(get_sub_field('title')): ?>
                                    <div class="image-and-content__title title-section" data-aos="fade-up"  data-aos-duration="900"><?php the_sub_field('title'); ?></div>
                                <?php endif; ?>
                               <?php if(get_sub_field('description')): ?>
                                   <div class="image-and-content__description " data-aos="fade-up"  data-aos-duration="1000"><?php the_sub_field('description'); ?></div>
                               <?php endif; ?>
                                <?php if( $iconBox = get_sub_field('icon_content_repeater')) : ?>
                                <ul class="image-and-content__icon-box" data-aos="fade-up"  data-aos-duration="1100">
                                    <?php foreach($iconBox as $iCont) : ?>
                                            <li>
                                                <div class="icon-box-icon">
                                                    <?php if ($iCont['icon']['mime_type'] == 'image/svg+xml'): ?>
                                                        <?= file_get_contents($iCont['icon']['url']); ?>
                                                    <?php elseif($iCont['icon']): ?>
                                                        <img src="<?= $iCont['icon']['url'] ?>" alt="">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="icon-content-box">
                                                    <div class="icon-title"><?= $iCont['title_icon'] ?></div>
                                                    <div class="icon-text"><?= $iCont['text_icon'] ?></div>
                                                </div>
                                            </li>
                                    <?php endforeach;?>
                                </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <?php elseif ($ACF_layout == 'faq_flexrow'): /// Flex Row ?>
                <?php $faqContent = get_sub_field('question_answer_repeater');
                    $addRightColumn = get_sub_field('add_right_plate');
                    $rightGroup = get_sub_field('plate_right_information'); ?>
                <section class="faq">
                    <div class="container row">
                        <div class="faq__left-column col col-8" >
                            <?php if(get_sub_field('sub_title')): ?>
                                <div class="faq__sub-title sub-title" data-aos="fade-up"  data-aos-duration="800"><?php the_sub_field('sub_title'); ?></div>
                            <?php endif; ?>
                            <?php if(get_sub_field('title')): ?>
                                <div class="faq__title title-section" data-aos="fade-up"  data-aos-duration="800"><?php the_sub_field('title'); ?></div>
                            <?php endif; ?>
                            <?php if(get_sub_field('description')): ?>
                                <div class="faq__description" data-aos="fade-up"  data-aos-duration="800"><?php the_sub_field('description'); ?></div>
                            <?php endif; ?>
                            <?php if( $faqContent) : ?>
                                <ul class="faq__list">
                                <?php $i=0; foreach($faqContent as $faqItem) : ?>
                                     <li class="faq__question-wrapper" data-aos="fade-up"  data-aos-duration="1<?= $i; ?>00">
                                         <div class="faq__subtitle"><?= $faqItem['question'] ?><span class="faq__plus"></span></div>
                                         <div class="faq__content-wrapper">
                                             <?= $faqItem['answer'] ?>
                                         </div>
                                     </li>
                                <?php $i++; endforeach;?>
                            </ul>
                            <?php endif; ?>
                        </div>
                        <?php if ($addRightColumn): ?>
                            <div class="faq__right-column col col-4" data-aos="fade-left"  data-aos-duration="1000">
                                <div class="faq__plate">
                                    <div class="faq__plate__subtitle sub-title"><?= $rightGroup['sub_title_plate']; ?></div>
                                    <div class="faq__plate__title"><?= $rightGroup['title_plate']; ?></div>
                                    <div class="faq__plate__description"><?= $rightGroup['description_plate']; ?></div>
                                    <?php if( $rightGroup['icon_desc_plate_repeater']) : ?>
                                        <ul class="faq__plate__icon-information">
                                        <?php foreach($rightGroup['icon_desc_plate_repeater'] as $item) : ?>
                                            <li>
                                                <div class="faq__plate__icon-box">
                                                    <?php if ($item['icon']['mime_type'] == 'image/svg+xml'): ?>
                                                        <?= file_get_contents($item['icon']['url']); ?>
                                                    <?php elseif($item['icon']): ?>
                                                        <img src="<?= $item['icon']['url'] ?>" alt="<?= $item['icon']['alt'] ?>">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="faq__plate__icon-content-box">
                                                    <div class="faq__plate__icon-title"><?= $item['title'] ?></div>
                                                    <div class="faq__plate__icon-description"><?= $item['description'] ?></div>
                                                </div>
                                            </li>
                                        <?php endforeach;?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
                <?php elseif ($ACF_layout == 'sc_bg_left_inf_right_inf_flexrow'): /// Flex Row ?>
                    <?php $bgImage = get_sub_field('bg_image');
                    if($bgImage != ''){
                        $addClassBg = 'btParallax';
                    } ?>
                <section class="bg-ct <?= $addClassBg; ?>" <?php if ($bgImage): ?> data-parallax="0.1" data-parallax-offset="0" style="background-image: url('<?= $bgImage['url'] ?>')"<?php endif; ?>>
                    <?php if( $rows = get_sub_field('content_information_repeater')) : ?>
                        <div class="container row ">
                        <?php
                        $rowsCount = 1;
                        $countItemElement = count($rows);
                        foreach ($rows as $Item) {
                            $btnType = $Item['button_type'];
                            $button = $Item['button']; ?>
                            <?php if ($rowsCount % 3 == 1) { ?>
                                <div class="bg-ct__wrap col-12">
                            <?php } ?>
                                    <div class="bg-ct__item bg-ct__item-<?= $rowsCount ?>" data-aos="fade-up"  data-aos-duration="1<?= $rowsCount ?>00">
                                        <div class="bg-ct__item-wrapper">
                                            <div class="bg-ct__subtitle sub-title">
                                                <?= $Item['sub_title'] ?>
                                            </div>
                                            <div class="bg-ct__title title-section"><?= $Item['title'] ?></div>
                                            <div class="bg-ct__description"><?= $Item['description'] ?></div>
                                            <?php if ($button['button_text'] != '' && $button['button_link'] != ''): ?>
                                            <div class="bg-ct__button">
                                             <?php if ($btnType == 'button_bg'): ?>
                                                    <a class="btn btn__color_one" href="<?= $button['button_link']; ?>"><?= $button['button_text']; ?> </a>
                                            <?php else: ?>
                                                    <a class="read-more" href="<?= $button['button_link']; ?>"><?= $button['button_text']; ?> </a>
                                            <?php endif; ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                            <?php if (($rowsCount % 3 == 0) || ($countItemElement == $rowsCount)) { ?>
                                </div>
                            <?php } ?>

                            <?php $rowsCount++;
                        } ?>
                        </div>
                    <?php endif; ?>
                </section>
                <?php elseif ($ACF_layout == 'section_contact_us_flexrow'): /// Flex Row ?>
                 <?php $boardForm = get_sub_field('form_board_group');
                    $contactInformation = get_sub_field('contact_information_repeater');
                    $iconPhone = $td . '/app/images/phone.svg';
                    $iconMail = $td . '/app/images/mail.svg';
                    $iconMapLocal = $td . '/app/images/map_locate.svg';
                    $iconMapEurope = $td . '/app/images/europe_map.svg';
                    $image = get_sub_field('image');
                    $size = 'large';
                    $alt = $image['alt'];
                    $thumb = $image['sizes'][$size];
                    $width = $image['sizes'][$size . '-width'];
                    $height = $image['sizes'][$size . '-height']; ?>
                <section class="contact-us">
                    <?php if( $contactInformation) : ?>
                        <div class="container row">
                            <?php $i=0; foreach($contactInformation as $ctItems) : ?>
                            <div class="col-6 col-sm-12 contact-us__info row">
                                <?php foreach($ctItems['contacts_info_repeater'] as $itemInf) : ?>
                                    <?php $typeInf = $itemInf['type_information'] ?>
                                    <div class="contact-us__item col inf-<?= $typeInf ?>">
                                        <div class="contact-us__info__item col-12 " data-aos="fade-up"  data-aos-duration="1<?= $i; ?>00">
                                            <?php if ($typeInf == 'head-office'): ?>
                                                <div class="icon">
                                                    <?= file_get_contents($iconMapLocal); ?>
                                                </div>
                                                <div class="info">
                                                    <div class="info__title"><?= $itemInf['title_information'] ?></div>
                                                    <div class="info__text">
                                                        <?= $itemInf['location'] ?>
                                                    </div>
                                                </div>
                                            <?php elseif ($typeInf == 'phone'): ?>
                                                <div class="icon">
                                                    <?= file_get_contents($iconPhone); ?>
                                                </div>
                                                <div class="info">
                                                    <div class="info__title"><?= $itemInf['title_information'] ?></div>
                                                    <?php if($itemInf['phone_or_email_1']):
                                                        $tel1 = $itemInf['phone_or_email_1'];
                                                        $tel1 = str_replace(array('(', ')', ' ', '-'), '', $tel1);?>
                                                        <a href="tel:<?= $tel1; ?>" class="info__phone">
                                                            <?= $itemInf['phone_or_email_1']; ?>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if($itemInf['phone_or_email_2']):
                                                        $tel2 = $itemInf['phone_or_email_2'];
                                                        $tel2 = str_replace(array('(', ')', ' ', '-'), '', $tel2);?>
                                                        <a href="tel:<?= $tel2; ?>" class="info__phone">
                                                            <?= $itemInf['phone_or_email_2']; ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php elseif ($typeInf == 'email'): ?>
                                                <div class="icon">
                                                    <?= file_get_contents($iconMail); ?>
                                                </div>
                                                <div class="info">
                                                    <div class="info__title"><?= $itemInf['title_information'] ?></div>
                                                    <?php if($itemInf['phone_or_email_1']): ?>
                                                        <a href="mailto:<?= $itemInf['phone_or_email_1']; ?>" class="info__email">
                                                            <?= $itemInf['phone_or_email_1']; ?>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if($itemInf['phone_or_email_2']): ?>
                                                        <a href="mailto:<?= $itemInf['phone_or_email_2']; ?>" class="info__email">
                                                            <?= $itemInf['phone_or_email_2']; ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <?php $i++; endforeach;?>
                        </div>
                    <?php endif; ?>

                    <div class="container row contact-us__board">
                        <?php if($boardForm): ?>
                            <div class="contact-us__board__prewrap col col-6 col-md-9 col-sm-12" data-aos="fade-left"  data-aos-duration="800">
                                <div class="contact-us__board__wrapper">
                                <?php if($boardForm['sub_title_board']): ?>
                                    <div class="contact-us__board__subtitle sub-title" data-aos="fade-left"  data-aos-duration="900"><?= $boardForm['sub_title_board']; ?></div>
                                <?php endif; ?>
                                <?php if($boardForm['title_board']): ?>
                                    <div class="contact-us__board__title title-section" data-aos="fade-left"  data-aos-duration="1000"><?= $boardForm['title_board']; ?></div>
                                <?php endif; ?>
                                <?php if($boardForm['description_board']): ?>
                                    <div class="contact-us__board__description" data-aos="fade-left"  data-aos-duration="1100">
                                        <?= $boardForm['description_board']; ?>
                                    </div>
                                <?php endif; ?>

                                <?= do_shortcode($boardForm['pasted_shordcode_form']); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </section>
                <?php elseif ($ACF_layout == 'price_table_flexrow'): /// Flex Row ?>
                    <section class="price-table">
            <div class="container row price-table__row">
                <?php if(get_sub_field('title_table')): ?>
                    <div class="price-table__title col col-10">
                        <h2><?php the_sub_field('title_table'); ?></h2>
                    </div>
                <?php endif; ?>

                <?php if(get_sub_field('table_description')): ?>
                    <div class="price-table__description col col-10"><?php the_sub_field('table_description'); ?></div>
                <?php endif; ?>

            </div>
            <?php if( $table = get_sub_field('price_table_content_foreach')) : ?>
                 <div class="container row price-table__row">
                     <div class="price-table__wrapper col-10">
                <?php foreach($table as $item) : ?>
                            <div class="price-table__item">
                                <div class="price-table__top">
                                    <h4 class="price-table__top__title"><?= $item['column_1_title'] ?></h4>
                                    <p class="price-table__top__price"><?= $item['column_2_text'] ?></p>
                                </div>
                                <div class="price-table__bottom">
                                    <p class="price-table__bottom__text"><?= $item['column_1_description'] ?></p>
                                </div>
                            </div>
                <?php endforeach;?>

                     </div>
                </div>
            <?php endif; ?>
            <?php if(get_sub_field('table_description_bottom')): ?>
                <div class="container row price-table__row">
                    <div class="price-table__description-bottom col col-10">
                        <?php the_sub_field('table_description_bottom'); ?>
                    </div>
                </div>
            <?php endif; ?>

        </section>
                <?php elseif( $ACF_layout == 'section_our_doctors_flexrow' ): ?>
                    <section class="our-doctors">
                        <div class="container row">
                            <div class="col-12 col">
                                <?php if(get_sub_field('title_section')): ?>
                                    <h2 class="title-text__title title-section-small"><?php the_sub_field('title_section'); ?></h2>
                                <?php endif; ?>
                                <?php if(get_sub_field('description')): ?>
                                    <div class="title-text__description">
                                        <?php the_sub_field('description'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if( $ourDoctors = get_sub_field('our_doctors_foreach')) : ?>
                            <div class="container">
                                <div class="our-doctors__wrapper row">
                                    <?php foreach($ourDoctors as $item) : ?>
                                        <div class="our-doctors__item col col-3 col-lg-6 col-sm-12">
                                            <div class="our-doctors__wrap">
                                                <div class="our-doctors__image">
                                                    <?php $image  = $item['doctor_photo'];  ?>
                                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" />

                                                </div>
                                                <div class="our-doctors__name"><?= $item['doctor_name'] ?></div>
                                                <div class="our-doctors__text">
                                                    <?= $item['doctor_description'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </section>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </main>
<?php get_footer() ?>







