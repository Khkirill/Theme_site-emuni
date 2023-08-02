<?php $globalGroup = get_field('themes_option','options'); ?>
<div class="social-icons-share ">
    <?php if ($globalGroup['title_section_share']): ?>
        <h3 class="social-icons-share__title"><?= $globalGroup['title_section_share'] ?></h3>
    <?php endif; ?>
    <?php
    $sb_url = urlencode(get_permalink());
    $sb_title = get_the_title();
    $sb_bloginfo = get_bloginfo('name');
    $sb_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(''));

    $twitterURL = 'https://twitter.com/intent/tweet?text=' . $sb_title . '&amp;url=' . $sb_url . '&amp;via=wpvkp';
    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $sb_url;
    $facebookMessangerURL = 'b-messenger://share/?link=' . $sb_url . '&amp;t=' . $sb_title;
    //            $whatsappURL = 'whatsapp://send?text=' . $sb_title . ' ' . $sb_url;
    $whatsappURL = 'https://wa.me/?text=' . $sb_title . ' ' . $sb_url;
    $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $sb_url . '&amp;title=' . $sb_title;
    $viberURL = 'viber://forward?text=' . $sb_url . '%0D%0A%0D%0A' . $sb_title;
    $telegramURL = 'https://telegram.me/share/url?url=' . $sb_url;
    $tumblrURL = 'http://tumblr.com/widgets/share/tool?canonicalUrl=' . $sb_url;
    $gplusURL = 'https://plus.google.com/share?url=' . $sb_title . '';
    $mailTo = 'mailto:?subject=' . $sb_title . '&body=' . $sb_bloginfo . '%20' . $sb_url;
    if (!empty($sb_thumb)) {
        $pinterestURL = 'https://pinterest.com/pin/create/button/?url=' . $sb_url . '&amp;media=' . $sb_thumb[0] . '&amp;description=' . $sb_title;
    } else {
        $pinterestURL = 'https://pinterest.com/pin/create/button/?url=' . $sb_url . '&amp;description=' . $sb_title;
    }
    $icon_facebook = get_stylesheet_directory() . '/app/images/social-icon/facebook-f.svg';
    $icon_twitter = get_stylesheet_directory() . '/app/images/social-icon/twitter.svg';
    $icon_pinterest = get_stylesheet_directory() . '/app/images/social-icon/pinterest-p.svg';
    $icon_viber = get_stylesheet_directory() . '/app/images/social-icon/viber.svg';
    $icon_whatsapp = get_stylesheet_directory() . '/app/images/social-icon/whatsapp.svg';
    $icon_tumblr = get_stylesheet_directory() . '/app/images/social-icon/tumblr.svg';
    $icon_telegram = get_stylesheet_directory() . '/app/images/social-icon/telegram-plane.svg';
    $icon_mailto = get_stylesheet_directory() . '/app/images/social-icon/google.svg';
    $icon_linkedin = get_stylesheet_directory() . '/app/images/social-icon/linkedin-in.svg';
    $icon_google_plus = get_stylesheet_directory() . '/app/images/social-icon/google.svg';?>
    <?php if ($globalGroup['select_share_icon']): ?>
    <div class="social-icons-share__list">
        <?php foreach ($globalGroup['select_share_icon'] as $row): ?>
            <?php if ($row == 'share_facebook'): ?>
                <div class="social-icons-share__item facebook-desc   d-none d-sm-inline">
                    <a rel="nofollow" href="<?php echo $facebookURL ?>" target="_blank">
                            <?= file_get_contents($icon_facebook); ?>
                        </a>
                </div>
                <div class="social-icons-share__item facebook-mess d-sm-none">
                    <a rel="nofollow" href="<?php echo $facebookMessangerURL ?>" target="_blank">
                            <?= file_get_contents($icon_facebook); ?>
                        </a>
                </div>
            <?php elseif ($row == 'share_twitter'): //// twitter ?>
                <div class="social-icons-share__item">
                    <a rel="nofollow" href="<?php echo $twitterURL ?>" target="_blank">
                        <?= file_get_contents($icon_twitter); ?>
                    </a>
                </div>
            <?php elseif ($row == 'share_telegram'): /// telegram?>
                <div class="social-icons-share__item">
                    <a rel="nofollow" href="<?php echo $telegramURL ?>" target="_blank">
                        <?= file_get_contents($icon_telegram); ?>
                    </a>
                </div>
            <?php elseif ($row == 'share_viber'): ?>
                <div class="social-icons-share__item">
                    <a rel="nofollow" href="<?php echo $viberURL ?>" target="_blank">
                            <?= file_get_contents($icon_viber); ?>
                        </a>
                </div>
            <?php elseif ($row == 'share_whatsapp'): // wtahsapp ?>
                <div class="social-icons-share__item">
                    <a rel="nofollow" href="<?php echo $whatsappURL ?>" target="_blank">
                        <?= file_get_contents($icon_whatsapp); ?>
                    </a>
                </div>
            <?php elseif ($row == 'share_linkedin'): /// linkedIn?>
                <div class="social-icons-share__item">
                    <a rel="nofollow" href="<?php echo $linkedInURL ?>" target="_blank">
                            <?= file_get_contents($icon_linkedin); ?>
                        </a>
                </div>
            <?php elseif ($row == 'share_pinterest'): /// pinterest ?>
                <div class="social-icons-share__item">
                    <a rel="nofollow" href="<?php echo $pinterestURL ?>" target="_blank">
                        <?= file_get_contents($icon_pinterest); ?>
                    </a>
                </div>

            <?php elseif ($row == 'share_google'): ?>
                <div class="social-icons-share__item">
                    <a rel="nofollow" href="<?php echo $gplusURL ?>" target="_blank">
                            <?= file_get_contents($icon_google_plus); ?>
                        </a>
                </div>
            <?php elseif ($row == 'share_mail'): ?>
                <div class="social-icons-share__item">
                    <a rel="nofollow" href="<?php echo $mailTo ?>" target="_blank">
                            <?= file_get_contents($icon_mailto); ?>
                        </a>
                </div>
            <?php elseif ($row == 'share_thumbl'): /// tumblr ?>
                <div class="social-icons-share__item">
                    <a rel="nofollow" href="<?php echo $tumblrURL ?>" target="_blank">
                            <?= file_get_contents($icon_tumblr); ?>
                        </a>
                </div>

            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>