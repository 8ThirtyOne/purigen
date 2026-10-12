<?php

declare(strict_types=1);

namespace MyProject\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127110336 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('
        CREATE TABLE `core_labs` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `year` varchar(4) NOT NULL,
            `month` varchar(2) NOT NULL,
            `day` varchar(2) NOT NULL,
            `organization` varchar(255) NOT NULL,
            `department` varchar(255) NOT NULL,
            `contact_name` varchar(255),
            `title` varchar(255) NOT NULL,
            `phone` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `url` varchar(255),
            `logo_file` varchar(255),
            `created_at` INT(11) NOT NULL,
            `status` INT(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`)
        );
        ');

    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DROP TABLE `core_labs` ;');

    }
}
