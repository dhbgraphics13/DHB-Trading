DROP TABLE IF EXISTS `category_view`;

CREATE  VIEW `category_view`  AS SELECT `a`.`id` AS `id`, `a`.`category_name` AS `category_name`, `a`.`description` AS `description`,`a`.`parent_id` AS `parent_id`, `b`.`category_name` AS `parent`, `a`.`active` AS `active` FROM (`categories` `a` left join `categories` `b` on(`a`.`parent_id` = `b`.`id`)) ;

