<?php
get_header(); ?>

<section class="section about">
    <h1>Projects Archive</h1>

    <?php if (have_posts()) : ?>
        <div class="projects-list">
            <?php while (have_posts()) : the_post(); ?>
                <div class="project-item">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="project-thumbnail">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('medium');
                        } ?>
                    </div>
                    <div class="project-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <div class="prev"><?php previous_posts_link('« Previous'); ?></div>
            <div class="next"><?php next_posts_link('Next »'); ?></div>
        </div>
    <?php else : ?>
        <p>No projects found.</p>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
