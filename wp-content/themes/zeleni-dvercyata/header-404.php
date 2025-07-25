<?php
  get_header();
?>

<div class="error-404 not-found">
  <header class="page-header">
    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can’t be found.', 'zeleni-dvercyata' ); ?></h1>
  </header><!-- .page-header -->

  <div class="page-content">
    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'zeleni-dvercyata' ); ?></p>

    <?php
      get_search_form();
    ?>
  </div><!-- .page-content -->
</div><!-- .error-404 -->
