<?php
/**
 * Blog for PrestaShop module by PrestaHome Team.
 *
 * @author    PrestaHome Team <support@prestahome.com>
 * @copyright Copyright (c) 2011-2021 PrestaHome Team - www.PrestaHome.com
 * @license   You only can use module, nothing more!
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_1_3_1_1($object)
{
    Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.'simpleblog_post` DROP COLUMN logged');

    $sql = array();

    $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'simpleblog_post_type` (
        `id_simpleblog_post_type` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255),
        `slug` VARCHAR(255),
        `description` TEXT,
        PRIMARY KEY (`id_simpleblog_post_type`)
    ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8mb4';

    /*
        
        DB

    **/
    foreach ($sql as $s) {
        if (!Db::getInstance()->Execute($s)) {
            return false;
        }
    }

    return true;
}
