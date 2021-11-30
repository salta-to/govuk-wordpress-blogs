<article <?php post_class() ?>>
  <header>
    <h2 class="govuk-heading-m"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
    <?php get_template_part('templates/entry-meta') ?>
    <?php gds_post_thumbnail() ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt() ?>
  </div>
  <?php get_template_part('templates/entry-footer') ?>
</article>
