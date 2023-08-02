<?php
/*
Template Name: Home
Template Post Type: page
*/
$td = get_template_directory_uri();
$arrow_bottom_svg = $td . '/app/images/arrow-to-bottom.svg';
$arrow_right_svg = $td . '/app/images/mbri-right.svg';
$slick_next_svg = $td . '/app/images/mbri-arrow-next.svg';
$slick_prev_svg = $td . '/app/images/mbri-arrow-prev.svg';
$firstScrean = get_field('first_screan_group');
$classMain = '';
if ( is_front_page() ) :
    $classMain = 'home';
    $firstColumn = 'col-7';
else :
    $classMain = 'other-page';
    $firstColumn = 'col-6';
endif;
get_header() ?>
<main class="<?= $classMain ?>">

    <section class="main-first">
        <div class="container">
            <div class="row">
                <div class="<?= $firstColumn ?> col-md-12 col main-first__left">
                    <div class="main-first__left__title">
                        <h1><?= $firstScrean['title'] ?></h1>
                    </div>
                    <div class="main-first__left__description" >
                        <?= $firstScrean['description'] ?>
                    </div>
                    <?php if($firstScrean['button_btn']): ?>
                        <div class="main-first__left__button">
                            <a href="<?= $firstScrean['button_btn']['url'] ?>" class="btn" target="<?= $firstScrean['button_btn']['target'] ?>" data-aos="fade-right" data-aos-duration="1600" data-aos-delay="500"><?= $firstScrean['button_btn']['title'] ?></a>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="col-5 col-md-12 col main-first__right">
                    <?php if ($firstScrean['image_right']["mime_type"] == 'image/svg+xml'): ?>
                        <?= file_get_contents($firstScrean['image_right']['url']); ?>
                    <?php elseif($firstScrean['image_right']): ?>
                        <img rel="preconnect" src="<?= $firstScrean['image_right']['url'] ?>" alt="<?= $firstScrean['image_right']['alt'] ?>" width="<?= $firstScrean['image_right']['width'] ?>" height="<?= $firstScrean['image_right']['height'] ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php $sliderFirst = $firstScrean['slider_first_screen'] ?>
        <?php if( $sliderFirst ) : ?>
        <div class="main-first__slider container"  >
            <?php foreach($sliderFirst as $item) : ?>
                <div class="main-first__slider__item">
                    <div class="main-first__slider__image">
                        <?php if ($item["mime_type"] == 'image/svg+xml'): ?>
                            <?= file_get_contents($item['url']); ?>
                        <?php elseif($item): ?>
                            <img src="<?= $item['url'] ?>" alt="<?= $item['alt'] ?>" width="<?= $item['width'] ?>" height="<?= $item['height'] ?>">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <?php endif; ?>
    </section>
    <?php if( have_rows('flexible_content_flex') ): ?>
        <?php while ( have_rows('flexible_content_flex') ) : the_row(); ?>
            <?php if( get_row_layout() == 'section_what_black_bg_flexrow' ): ////START  SECTION  ?>
                <?php $varBG = get_sub_field('variable_background');
                      $bottomInfo = get_sub_field('add_bottom_title_text_cb');
                      $addArrow = get_sub_field('add_arrow_next_section');
                      $image = get_sub_field('image');?>
            <section class="sc-second <?= $varBG ?> ">
                <div class="container-bg">
                    <?php if($image!='' || get_sub_field('description')!=''): ?>
                    <div class="container row sc-second__top <?= $bottomInfo ?>">
                        <div class="col-4 col-md-12 col sc-second__left" data-aos="fade-right" data-aos-duration="600">
                            <?php if ($image["mime_type"] == 'image/svg+xml'): ?>
                                <?= file_get_contents($image['url']); ?>
                            <?php elseif($image): ?>
                                <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" width="<?= $image['width'] ?>" height="<?= $image['height'] ?>">
                            <?php endif; ?>
                        </div>

                        <?php if(get_sub_field('description')): ?>
                            <div class="col-8 col-md-12 col sc-second__right" data-aos="fade-left" data-aos-duration="600">
                                <?php the_sub_field('description'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if($bottomInfo == 'yes_add_bottom' ): ?>
                        <div class="container row sc-second__bottom">
                            <div class="col-8 col-lg-10 col-md-12 col sc-second__bottom__wrapper">
                                <?php if(get_sub_field('title_bottom')): ?>
                                <h2 class="sc-second__bottom__title" data-aos="fade-up" data-aos-duration="700">
                                    <?php the_sub_field('title_bottom'); ?>
                                </h2>
                                <?php endif; ?>
                                <?php if(get_sub_field('description_bottom')): ?>
                                    <div class="sc-second__bottom__description" data-aos="fade-up" data-aos-duration="800">
                                        <?php the_sub_field('description_bottom'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="arrow-to-sc" data-aos="fade-zoom-in" data-aos-duration="800">
                                    <?= file_get_contents($arrow_bottom_svg) ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
            <?php endif;  ////END SECTION ?>
            <?php if( get_row_layout() == 'section_left_img_right_text_flexrow' ): ////START  SECTION  ?>
                <?php $idSection = get_sub_field('section_id_anchor_link');
                $varBG = get_sub_field('variable_background');
                $varCT = get_sub_field('variable_content');
                $fontSize = get_sub_field('title_size');
                $button = get_sub_field('button_learn_more'); ?>
            <section class="sc-image-text <?= $varBG; ?>" <?php if ($idSection): ?>id="<?= $idSection ?>"<?php endif; ?>>
                <div class="container-bg">
                    <div class="container row sc-image-text__container <?= $varCT ?>">
                        <?php
                        $image  = get_sub_field('image'); ?>
                        <div class="col-6 col-md-12 col sc-image-text__image"  data-aos="fade-up" data-aos-duration="700">
                            <?php if ($image["mime_type"] == 'image/svg+xml'): ?>
                                <?= file_get_contents($image['url']); ?>
                            <?php elseif($image): ?>
                                <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" width="<?= $image['width'] ?>" height="<?= $image['height'] ?>">
                            <?php endif; ?>
                        </div>
                        <?php if(get_sub_field('description')): ?>
                        <div class="col-6 col-md-12 col sc-image-text__text variable-color" >

                           <?php if(get_sub_field('title')): ?>
                               <h2 class="title-section <?= $fontSize ?>" data-aos="fade-up" data-aos-duration="800"><?php the_sub_field('title'); ?></h2>
                           <?php endif; ?>
                            <?php if(get_sub_field('description')): ?>
                                <div data-aos="fade-up" data-aos-duration="900" >
                                    <?php the_sub_field('description'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($button): ?>
                                <a href="<?= $button['url'] ?>" class="btn" data-aos="fade-up" data-aos-duration="950" target="<?= $button['target'] ?>"><?= $button['title'] ?></a>
                            <?php endif; ?>

                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php endif;  ////END SECTION ?>
            <?php if( get_row_layout() == 'section_subscribe_flexrow' ): ////START  SECTION  ?>
                <?php $idSection = get_sub_field('section_id_anchor_link');
                      $varBG = get_sub_field('variable_background') ?>
                <section class="sc-subscribe  <?= $varBG; ?>"  <?php if ($idSection): ?>id="<?= $idSection ?>"<?php endif; ?>>
                    <div class="container-bg">
                        <div class="container row sc-subscribe__container ">
                            <?php if(get_sub_field('description')!='' || get_sub_field('title')!='' ): ?>
                                <div class="col-7 col-lg-12 col sc-subscribe__text variable-color">
                                    <?php if(get_sub_field('title')): ?>
                                        <h2 class="title-section" data-aos="fade-left" data-aos-duration="700"><?php the_sub_field('title'); ?></h2>
                                    <?php endif; ?>

                                    <?php if(get_sub_field('description')): ?>
                                        <div data-aos="fade-left" data-aos-duration="800" >
                                            <?php the_sub_field('description'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php $insta = get_sub_field('shortcode_form') ?>
                            <?php if($insta): ?>
                                <div class="col-5 col-lg-12 col sc-subscribe__form variable-color" data-aos="fade-right" data-aos-duration="700">
                                    <?= do_shortcode($insta); ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </section>
            <?php endif;  ////END SECTION ?>
            <?php if( get_row_layout() == 'section_who_are_we_flexrow' ): ////START  SECTION  ?>
                <?php $idSection = get_sub_field('section_id_anchor_link');
                      $varBG = get_sub_field('variable_background'); ?>
                <section class="who-are <?= $varBG; ?>"  <?php if ($idSection): ?>id="<?= $idSection ?>"<?php endif; ?>>
                    <div class="container-bg">
                        <div class="container row who-are__container ">
                            <?php if(get_sub_field('description')!='' || get_sub_field('title')!='' ): ?>
                                <div class="col-8 col-md-12 col who-are__text variable-color">
                                    <?php if(get_sub_field('title')): ?>
                                        <h2 class="title-section" data-aos="fade-up" data-aos-duration="700"  data-aos-delay="200"><?php the_sub_field('title'); ?></h2>
                                    <?php endif; ?>
                                    <?php if(get_sub_field('description')): ?>
                                        <div data-aos="fade-up" data-aos-duration="900"  data-aos-delay="300">
                                            <?php the_sub_field('description'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if( $rows = get_sub_field('content_2_block_at_row')) : ?>
                            <div class="container row who-are__container ">
                                <?php $c=1; foreach($rows as $row) : ?>
                                    <?php $image  = $row['image']; ?>
                                   <div class="who-are__item col-6 col-md-12 col" data-aos="fade-up"  data-aos-duration="700" data-aos-delay="<?= $c ?>00" >
                                       <div class="who-are__bg-wrap">
                                           <div class="who-are__image col-4">
                                               <?php if ($image["mime_type"] == 'image/svg+xml'): ?>
                                                   <?= file_get_contents($image['url']); ?>
                                               <?php elseif($image): ?>
                                                   <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" width="<?= $image['width'] ?>" height="<?= $image['height'] ?>">
                                               <?php endif; ?>
                                           </div>
                                           <div class="who-are__description col-8">
                                                <?= $row['text'] ?>
                                           </div>
                                       </div>
                                   </div>
                                <?php $c++; endforeach;?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif;  ////END SECTION ?>

            <?php if( get_row_layout() == 'section_title_description_flexrow' ): ////START  SECTION  ?>
                <?php $idSection = get_sub_field('section_id_anchor_link');
                      $varBG = get_sub_field('variable_background');
                      $button = get_sub_field('button_learn_more') ?>
                <section class="sc-title-text <?= $varBG; ?>"  <?php if ($idSection): ?>id="<?= $idSection ?>"<?php endif; ?>>
                    <div class="container-bg">
                        <div class="container row sc-title-text__container">
                                <div class="col-12 col-md-12 col sc-image-text__text variable-color">
                                    <?php if(get_sub_field('title')): ?>
                                        <h2 class="title-section"  data-aos="fade-up"  data-aos-duration="700"><?php the_sub_field('title'); ?></h2>
                                    <?php endif; ?>
                                    <?php if(get_sub_field('description')): ?>
                                        <div data-aos="fade-up" data-aos-duration="800" >
                                            <?php the_sub_field('description'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($button): ?>
                                        <a href="<?= $button['url'] ?>" class="btn" data-aos="fade-up" data-aos-duration="900" target="<?= $button['target'] ?>"><?= $button['title'] ?></a>
                                    <?php endif; ?>
                                </div>
                        </div>
                    </div>
                </section>
            <?php endif;  ////END SECTION ?>

        <?php endwhile; ?>
    <?php endif; ?>
</main>
<?php get_footer() ?>