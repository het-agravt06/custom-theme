<?php get_header(); ?>

<main>

    <h1>Welcome to My First Custom Theme</h1>

    <?php

    if (have_posts()) :

            the_title('<h2>', '</h2>');

    else :

        echo "<p>No Posts Found</p>";

    endif;

    ?>

</main>

<?php get_footer(); ?>