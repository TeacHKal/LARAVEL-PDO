<?php
/**
 * Created by PhpStorm.
 * User: teach
 * Date: 11/30/2017
 * Time: 11:38 PM
 */

namespace App\Classes;

use App\Classes\PDOhelper;
use App\Classes\Response;



class CustomerCreateTable
{

    public static function createCustomerTable()
    {
        $pdo = PDOhelper::instance()->getPDOObject();

        $sql = "
        CREATE TABLE `customers` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`amount_changed_at` TIMESTAMP NULL DEFAULT NULL,
	`gender` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`first_name` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`last_name` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`country` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`email` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`amount` DOUBLE(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
	`bonus_amount` DOUBLE(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
	`deposit_amount` DOUBLE(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
	`withdrawal_amount` DOUBLE(10,2) NOT NULL DEFAULT '0.00',
	`no_of_deposits` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`no_of_withdrawals` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`bonus_pct` FLOAT NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;

        ";

        try {
            $pdo->query($sql);
        }catch(Exception $e){
            return Response::response(false, "Table is NOT created. Error: {$e->getMessage()}");
        }
        return Response::response(true, "Table is  created.");
    }


}