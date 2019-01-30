<?php wp_head(); ?>
<html>
<head>
  <?php do_action('wp_head') ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
  $background_image_id = get_option( 'background_image' );
  $background_image = wp_get_attachment_url( $background_image_id );
?>

<body class="mm-site-build-status main-background-image" style="background-image: url(<?php echo $background_image; ?>)">
<header>

</header>
