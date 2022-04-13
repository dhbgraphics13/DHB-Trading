DROP TABLE IF EXISTS `printing_module_view`;

CREATE  VIEW `printing_module_view`  AS SELECT
                                        `a`.`id` AS `id`,
                                        `a`.`module_name` AS `module_name`,
                                        `a`.`parent_id` AS `parent_id`,
                                        `a`.`category_id` AS `category_id`,
                                        `b`.`module_name` AS `parent`,
                                        `a`.`active` AS `active`
                                        FROM (`printing_modules` `a` left join `printing_modules` `b` on(`a`.`parent_id` = `b`.`id`)) ;

