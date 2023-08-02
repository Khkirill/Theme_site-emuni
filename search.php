<?php
get_header() ?>
<?php
$args = [
	'show_all'     => false,
	'end_size'     => 1,
	'mid_size'     => 1,
	'prev_next'    => true,
	'prev_text'    => __(
		'<svg width="16" height="24" viewBox="0 0 16 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1.33284 11.0635L12.0131 0.383412C12.2602 0.136194 12.5899 0 12.9415 0C13.2931 0 13.6229 0.136194 13.8699 0.383412L14.6564 1.16975C15.1682 1.68213 15.1682 2.51491 14.6564 3.02651L5.68793 11.995L14.6664 20.9735C14.9134 21.2207 15.0498 21.5503 15.0498 21.9017C15.0498 22.2535 14.9134 22.583 14.6664 22.8305L13.8799 23.6166C13.6326 23.8638 13.3031 24 12.9515 24C12.5999 24 12.2701 23.8638 12.0231 23.6166L1.33284 12.9267C1.08523 12.6787 0.949236 12.3476 0.950017 11.9956C0.949236 11.6422 1.08523 11.3113 1.33284 11.0635Z" fill="#333333"/>
                </svg>'
	),
	'next_text'    => __(
		'<svg width="16" height="24" viewBox="0 0 16 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.6672 11.0635L3.98685 0.383412C3.73983 0.136194 3.41008 0 3.05847 0C2.70686 0 2.37711 0.136194 2.13009 0.383412L1.34356 1.16975C0.831757 1.68213 0.831757 2.51491 1.34356 3.02651L10.3121 11.995L1.33361 20.9735C1.08658 21.2207 0.950195 21.5503 0.950195 21.9017C0.950195 22.2535 1.08658 22.583 1.33361 22.8305L2.12014 23.6166C2.36735 23.8638 2.69691 24 3.04852 24C3.40013 24 3.72988 23.8638 3.9769 23.6166L14.6672 12.9267C14.9148 12.6787 15.0508 12.3476 15.05 11.9956C15.0508 11.6422 14.9148 11.3113 14.6672 11.0635Z" fill="#333333"/>
                </svg>'
	),
	'add_args'     => false,
	'add_fragment' => '',
	'screen_reader_text' => __('Posts navigation'),
];
?>


<main class="search">
	<div class="container">
		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				<?php if (have_posts()) : ?>
				<div class="page-header">
					<h1 class="page-title">
						<?php printf(__('Search result: %s', 'shape'),  get_search_query()); ?>
					</h1>
				</div>
				<div class="container-sm">
					<?php while (have_posts()) : the_post(); ?>
					<div class="search__result">
						<p>
							<a class="link" href="<?= the_permalink() ?>"><?= get_the_title() ?></a>
						</p>
						<?php echo kama_excerpt(['maxchar' => 270], ''); ?>
					</div>
					<?php endwhile; ?>
					<div class="category-page__pagination">
						<?php the_posts_pagination($args); ?>
					</div>
					<?php else : ?>
					<div class="search__not-found">
						<h1>Nothing Found</h1>
						<h3>Sorry, but nothing matched your search terms. Please try again with some different keywords.</h3>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	</div>
</main>


<?php get_footer() ?>