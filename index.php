<<<<<<< HEAD
<?php
// Silence is golden.
=======
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
>>>>>>> bc70b830b4ba2d7dc6ea73380045b3f6ee93e45f
