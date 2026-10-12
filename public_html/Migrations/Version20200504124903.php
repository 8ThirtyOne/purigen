<?php

declare(strict_types=1);

namespace MyProject\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504124903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('
        CREATE TABLE `blog` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `year` varchar(4) NOT NULL,
            `month` varchar(2) NOT NULL,
            `day` varchar(2) NOT NULL,
            `type` INT(1) NOT NULL,
            `source` varchar(255) NOT NULL,
            `slug` varchar(255),
            `title` varchar(255) NOT NULL,
            `sub_title` TEXT NOT NULL,
            `body` TEXT NOT NULL,
            `tags` varchar(255),
            `author` varchar(255),
            `thumbnail1` varchar(255),
            `thumbnail2` varchar(255),
            `file_name` varchar(255),
            `org_file_name` varchar(255),
            `created_at` INT(11) NOT NULL,
            `status` INT(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`)
        );
        ');

    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DROP TABLE `blog` ;');

    }
}
