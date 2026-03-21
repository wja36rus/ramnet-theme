<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo RAMNET_THEME_URI;?>/favicon/favicon.svg" type="image/svg+xml" sizes="any" />
    <?php wp_head(); ?>
</head>
<link href="
https://cdn.jsdelivr.net/npm/flexslider@2.7.2/flexslider.min.css
" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/flexslider@2.7.2/2.6.2/jquery.flexslider.js"></script>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php get_template_part( 'template-parts/header/site-header' ); ?>