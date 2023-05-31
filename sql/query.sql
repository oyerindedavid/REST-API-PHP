CREATE TABLE `store`.`products` (`id` VARCHAR(11) NOT NULL , 
    `name` VARCHAR(255) NOT NULL , 
    `price` FLOAT NOT NULL , 
    `category_id` INT(11) NOT NULL , 
    `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `last_modified` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;