<?php
    define('DB_HOST', 'HOST');
    define('DB_USER', 'USER');
    define('DB_PASSWORD', 'PASSWORD');
    define('DB_DATABASE', 'FEEDME');
	define('USER_TABLE', 'users');
	define('RES_REVIEWS', 'restaurant_review');
	define('RESTAURANT_TABLE', 'mstr_restaurant');
	define('RESTAURANT_VOTES', 'restaurantscores');
	define('REVIEW_VOTES', 'restaurantreviewscore');

	define('USERTYPE_NORMAL', 0);
	define('USERTYPE_MOD', 1);
	define('USERTYPE_ADMIN', 2);

	define('USER_FLAGS_LIMIT', 5);
	define('REVIEW_FLAGS_LIMIT', 3);

	define('UPVOTE', 1);
	define('DOWNVOTE', -1);
?>
