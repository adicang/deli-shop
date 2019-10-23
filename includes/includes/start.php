<?php
    require '../vendor/autoload.php';

    define('SITE_URL','http://talisraelba.mtacloud.co.il/');

    $paypal = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AVlSicfHRU5IJFlIqeX6cKedZ0yQOuuKioq-5jN94bwLXwx-6EuUsDqtsNyXm_PIVq0upd8bA2fDy1wF',
            'EHastL5MfWDjQbriY6llF7-J48W3QNkT66qRkVqlsYPR3euLWyUWzKzK5u3MeAv4K4PDh2sgcJvm7g2V'
        )
    );
?>