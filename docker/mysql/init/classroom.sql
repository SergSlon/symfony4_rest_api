# CREATE TABLE `classroom` (
#     `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
#     `name` CHAR(255) NULL DEFAULT '',
#     `creation_date` DATETIME NOT NULL DEFAULT NOW(),
#     `active` BOOLEAN NOT NULL DEFAULT 0,
#     PRIMARY KEY (`id`)
# )
#     COLLATE = 'utf8mb4_unicode_ci'
# ;

# INSERT INTO `classroom` (`id`, `name`) VALUES
#     (NULL, 'Classroom1'),
#     (NULL, 'Classroom2'),
#     (NULL, 'Classroom3'),
#     (NULL, 'Classroom4')
# ;
