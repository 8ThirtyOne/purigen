<?php

declare(strict_types=1);

namespace MyProject\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200122094234 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Change fields in event table';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE `events` CHANGE COLUMN `subtitle` `description` TEXT NULL DEFAULT NULL ;');
        $this->addSql('ALTER TABLE events ADD add_info TEXT, ADD map_url varchar(255)  DEFAULT NULL, ADD subtitle varchar(255) DEFAULT NULL, ADD more_info_url varchar(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `events` DROP COLUMN `body`;');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE `events` DROP subtitle, DROP add_info, DROP map_url,  DROP more_info_url');
        $this->addSql('ALTER TABLE `events` CHANGE COLUMN `description` `subtitle` TEXT NULL DEFAULT NULL ;');
        $this->addSql('ALTER TABLE `events` ADD body TEXT ;');

    }
}
