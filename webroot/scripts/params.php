<?php
    define('DB_HOST', 'www.minhazm.com');
    define('DB_USER', 'team1');
    define('DB_PASSWORD', 'team1');
    define('DB_DATABASE', 'feedme');
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