CREATE TABLE `user` ( 
    `id` int(11) NOT NULL AUTO_INCREMENT, 
    `name` text COLLATE utf8_unicode_ci NOT NULL, 
    `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL, 
    `password` text COLLATE utf8_unicode_ci DEFAULT '', 
    `active` boolean DEFAULT false,
    PRIMARY KEY (`id`) 
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `user_post` ( 
    `id` int NOT NULL AUTO_INCREMENT, 
    `id_user` int NOT NULL, 
    `title` text NOT NULL, 
    `body` text NOT NULL, 
    `image` text NOT NULL DEFAULT '', 
    `edited` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  
    PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
