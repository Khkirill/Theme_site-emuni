<?php
$td = get_template_directory_uri();
$globalGroup = get_field('themes_option','options');
$bgFirst = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
$test = get_the_post_thumbnail(get_the_ID());
$author_name = get_the_author();
$author_id = get_the_author_meta('ID');

$youtube_link = get_user_meta($author_id, 'youtube', true);
$instagram_link = get_user_meta($author_id, 'instagram', true);
$twitter_link = get_user_meta($author_id, 'twitter', true);

// Получение имени автора текущей статьи

// Получение ID автора текущей статьи

// Получение ссылки на страницу автора
$author_link = get_author_posts_url($author_id);
get_header();
?>

<main class="article-page">
    <section class="first-screen">
        <div class="container row">
            <div class="col-7 col-md-12 col first-screen__info">
                <?php the_title('<h1 class="first-screen__info__title"  data-aos="fade-up"  data-aos-duration="800">', '</h1>', true); ?>
                <div class="first-screen__breadcrumbs" data-aos="fade-up"  data-aos-duration="900">
                    <?php if ( function_exists( 'dimox_breadcrumbs' ) ) dimox_breadcrumbs(); ?>
                </div>
                <time class="first-screen__info__date"  data-aos="fade-up"  data-aos-duration="1000"  datetime="<?php the_time('d.m.y') ?>"
                      pubdate="<?php the_time('d.m.y') ?>"><?php the_time('F j, Y') ?></time>
            </div>
            <div class="col-5 col-md-12 col first-screen__image">
                <?php if ($bgFirst[0]): ?>
                    <img src="<?= $bgFirst[0] ?>" width="<?= $bgFirst[1] ?>" height="<?= $bgFirst[2] ?>">
                <?php endif; ?>
            </div>
        </div>
    </section>

	<section class="article-page__content">
        <div class="container">
            <div class="article-page__content-container col col-12">
                <?= the_content() ?>
            </div>
        </div>
		<section class="author-block">
        <div class="container">
            <div class="author-block__content">
				<div class="author-block-main-link">
					<h2>About the Author</h2>
					<div class="author-block__avatar-links">
						<div>
						<p><?php echo get_the_author_meta('display_name'); ?></p>	
						<div class="author-block__link">
							<?php
								$author_id = get_post_field('post_author', get_the_ID());
								$instagram_link = get_field('instagram_link', 'user_' . $author_id);
								$twitter_link = get_field('twitter_link', 'user_' . $author_id);
								$facebook_link = get_field('facebook_link', 'user_' . $author_id);
								$youtube_link = get_field('youtube_link', 'user_' . $author_id);

								if ($facebook_link) {
									$url = esc_url($instagram_link);
									echo '<a href="' . $url . '">';
									echo '<img src="' . esc_url(get_template_directory_uri() . '/app/images/icon-instagram.svg') . '" alt="Facebook">';
									echo '</a>';
								}


								if ($facebook_link) {
									$url = esc_url($instagram_link);
									echo '<a href="' . $url . '">';
									echo '<img src="' . esc_url(get_template_directory_uri() . '/app/images/icon-twitter.svg') . '" alt="Facebook">';
									echo '</a>';
								}


								if ($facebook_link) {
									$url = esc_url($facebook_link);
									echo '<a href="' . $url . '">';
									echo '<img src="' . esc_url(get_template_directory_uri() . '/app/images/icon-facebook.svg') . '" alt="Facebook">';
									echo '</a>';
								}

								if ($facebook_link) {
									$url = esc_url($youtube_link);
									echo '<a href="' . $url . '">';
									echo '<img src="' . esc_url(get_template_directory_uri() . '/app/images/icon-youtube.svg') . '" alt="Facebook">';
									echo '</a>';
								} 
							?>
							
					</div>
						</div>
						<div class="author-block__avatar">
						<?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
					</div>
				</div>	
			</div>
					
                <div class="author-block__info">
                    <p class="author-block__description"><?php echo get_the_author_meta('description'); ?></p>
					<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">See all Authors Articles</a>

                </div>
            </div>
           
        </div>
    </section>
	</section>

    <?php $globalGroup['add_section_share'] ?>
    <?php if ($globalGroup['add_section_share'] == true): ?>
        <!--<section class="article-page__soc-item-wrapper">
            <div class="container-bg">
                <div class=" container col col-12">
                    <?php get_template_part( 'parts/social', 'icons-share' ); ?>
                </div>
            </div>
        </section>-->
    <?php endif; ?>

    

    <nav class="nav-post container">
        <?php
        /// prev post
        $prev_post = get_previous_post();
        $id = $prev_post->ID ;
        $permalink = get_permalink( $id );
        $prev_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), "thumbnail" );
       /// next post
        $next_post = get_next_post();
        $nid = $next_post->ID ;
        $next_permalink = get_permalink($nid);
        $next_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $nid ), "thumbnail" );
        $iconArrowLeft = get_stylesheet_directory() . '/app/images/chevron-left-solid.svg';
        $iconArrowRight= get_stylesheet_directory() . '/app/images/chevron-right-solid.svg';
        ?>

        <span class="nav-post__previous nav-post__block col col-6 col-sm-12">
            <?php if ($prev_post): ?>
                <a href="<?php echo $permalink; ?>" class="nav-post__link" >
                <span class="nav-post__image">
                   <?= file_get_contents($iconArrowLeft); ?>
                </span>
                <span class="nav-post__title">
                         <span><?php _e( 'Previous', 'finance' );?></span>
                <h2><?php echo $prev_post->post_title; ?></h2>
                </span>
            </a>
            <?php endif; ?>
       </span>

        <span class="nav-post__next nav-post__block  col col-6 col-sm-12">
            <?php if ($next_post): ?>
                <a href="<?php echo $next_permalink; ?>" class="nav-post__link">
                 <span class="nav-post__image">
                   <?= file_get_contents($iconArrowRight); ?>
                </span>
                 <span class="nav-post__title">
                  <span><?php _e( 'Next', 'finance' );?></span>
                <h2><?php echo $next_post->post_title; ?></h2>
                </span>
            </a>
            <?php endif; ?>
      </span>
    </nav>
<!--	--><?php //comments_template(); ?>
	
	

</main>

<?php get_footer(); ?>