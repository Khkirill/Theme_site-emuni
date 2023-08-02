<?php
/*
Template Name: Author
*/
get_header();

// Получение имени автора из URL
$author_slug = get_query_var('author_name');
$author = get_user_by('slug', $author_slug);

// Проверка наличия автора
if (!$author) {
    // Если автор не найден, выводим сообщение об ошибке или перенаправляем на другую страницу
    echo 'Автор не найден.';
} else {
    $author_id = $author->ID;

    // Получение информации об авторе
    $first_name = get_the_author_meta('first_name', $author_id);
    $last_name = get_the_author_meta('last_name', $author_id);
    $description = get_the_author_meta('description', $author_id);

    // Вывод информации об авторе
    ?>
    <section class="author-section">
        <div class="author-avatar">
            <?php echo get_avatar($author_id, 250); ?>
        </div>
        <div class="author-info">
            <h1 class="author-name"><?php echo $first_name . ' ' . $last_name; ?></h1>
            <div class="author-bio">
                <?php echo wpautop($description); ?>
            </div>
        </div>
    </section>

    <?php
    // Вывод последних 3 статей автора
    $args = array(
    'author' => $author_id,
    'posts_per_page' => -1,
    'order' => 'DESC',
    'orderby' => 'date'
);
$author_posts = new WP_Query($args);

if ($author_posts->have_posts()) {
    echo '<div class="author__latest-posts">';
    echo '<h2>Latest publications</h2>';
    
    $post_count = 0;
    $block_count = 1;
    
    while ($author_posts->have_posts()) {
        $author_posts->the_post();
        
        if ($post_count % 3 === 0) {
            if ($block_count > 1) {
                echo '</div>'; // Закрыть предыдущий блок
            }
            
            echo '<div class="author__first-posts">'; // Новый блок
        }
        
        echo '<div class="author__first-post">
            <a href="' . get_permalink() . '">
 				<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'large') . '" alt="' . get_the_title() . '">
			</a>
            <h2 class="author__latest-posts-h">' . get_the_title() . '</h2>
            <a class="author__button-read" href="' . get_permalink() . '">Read more</a>
        </div>';
        
        $post_count++;
        $block_count++;
    }
    
    echo '</div>'; // Закрыть последний блок
    echo '</div>';
    
    wp_reset_postdata();
} else {
    echo 'Статей автора не найдено.';
}
    
    
}

get_footer();
?>