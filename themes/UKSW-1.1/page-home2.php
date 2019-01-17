<?php
/*
	Template name: Home Page New Hope
*/

const activityCategories = [
    [
        'name' => 'Wspólnoty',
        'slug'  => 'wspolnoty',
        'color' => '#f76a0c',
        'href' => 'wspolnoty'
    ],
    [
        'name' => 'Diakonie',
        'slug'  => 'diakonie',
        'color' => '#004e89',
        'href' => 'diakonie'
    ],
    [
        'name' => 'Pogłębienie',
        'slug'  => 'poglebienie',
        'color' => '#C01D2E',
        'href' => 'poglebienie'
    ],
];

$sentences = include_once 'classes/sentences.php';

// losowanie cytatu z PŚ
if (count((array)$sentences) > 1) {
    $sentence = $sentences[rand(0, count((array)$sentences)-1)];
}

require_once get_template_directory() . '/classes/custompost.php';
require_once get_template_directory() . '/classes/activity.php';
$activities = cpt\Activity::getInstance()->findAll();

get_header();

?>
        <div class="row backstage-pattern">
            <div class="col-md-6">
                <section class="welcome-screen">
                    <?php do_shortcode('[eoc-simple]'); ?>
                    <div class="logo"><img src="<?php echo get_template_directory_uri() . '/assets/imgs/jmn.jpg'; ?>" alt=""></div>
                    <?php if ($sentence): ?>
                        <div class="sentence">
                            <?php echo $sentence; ?>
                        </div>
                    <?php endif; ?>
                </section>
            </div>
        </div><!-- row -->

        <div class="row backstage-pattern">
            <div class="col-md-12">
                <section class="row-content">
                    <ul>
                        <li><h2>Wiadomości</h2></li>
                    </ul>

                    <div class="news-container">

                        <div class="news-item">
                            <a href="">
                                <div class="title">
                                    <div class="date">
                                        <i class="fa fa-calendar" aria-hidden="true"></i> 2018-12-15
                                    </div>
                                        Opłatek u J.E. ks. kard. Kazimierza Nycza
                                </div>
                            </a>
                        </div>


                        <div class="news-item">
                            <a href="">
                                <div class="title">
                                    <div class="date">
                                        <i class="fa fa-calendar" aria-hidden="true"></i> 2018-12-15
                                    </div>
                                    Gramy z WOŚP :)
                                </div>
                            </a>
                        </div>

                        <div class="news-item">
                            News 3
                        </div>

                        <div class="news-item">
                            News 4
                        </div>
                    </div>

                </section>
            </div>
        </div>

        <div class="row backstage-pattern">
            <div class="col-md-12">

                <section class="row-content">
                    <ul class="nav nav-pills nav-justified">
                        <?php
                            foreach (activityCategories as $id => $activity) {
                                echo '<li' . ($id === 0 ? ' class="active"' : ''). '><a data-toggle="tab" href="#' . $activity['href'] .'" style="color: '. $activity['color'] . '">'. $activity['name'] . '</a></li>';
                            }
                        ?>
                    </ul>


                    <div class="tab-content">

                        <?php foreach (activityCategories as $id => $category): ?>

                            <div id="<?php echo $category['href']; ?>" class="tab-pane fade <?php echo ($id === 0 ? 'active in' : ''); ?>">
                                <div class="tab-container">
                                    <?php foreach ($activities as $activity): ?>
                                        <?php if (in_array($category['slug'], $activity['category'])): ?>
                                            <?php $id = $activity['id']; ?>

                                            <div class="tile">
                                                <a href="<?php echo get_permalink($id); ?>">

                                                    <?php echo get_the_post_thumbnail($id, 'post-thumbnail'); ?>
                                                    <div class="title" style="background-color: <?php echo $category['color']; ?>">
                                                        <?php echo get_the_title($id); ?>
                                                    </div>
                                                </a>
                                            </div>

                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>
                </section>

            </div>
        </div>


    </div><!-- container -->

<?php get_footer(); ?>
