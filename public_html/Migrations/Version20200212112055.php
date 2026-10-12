<?php

declare(strict_types=1);

namespace MyProject\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212112055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('CREATE TABLE `registration_events` (
                      `pkid` bigint(20) NOT NULL AUTO_INCREMENT,
                      `firstname` varchar(20) NOT NULL,
                      `lastname` varchar(20) NOT NULL,
                      `email` varchar(50) NOT NULL,
                      `phone` varchar(50) NOT NULL,
                      `organization` varchar(100) DEFAULT NULL,
                      `job_title` varchar(100) DEFAULT NULL,
                      `country` varchar(50) DEFAULT NULL,
                      `state` varchar(50) DEFAULT NULL,
                      `main_application` varchar(100) DEFAULT NULL,
                      `isreceive` int(11) DEFAULT 0,
                      `note` text DEFAULT NULL,
                      `regdate` datetime DEFAULT current_timestamp(),
                      `event_id` bigint(20) DEFAULT NULL,
                      PRIMARY KEY (`pkid`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4;
                    ALTER TABLE `registration_events` 
                    ADD INDEX `fk_registration_events_1_idx` (`event_id` ASC) VISIBLE;
                    ALTER TABLE `registration_events` 
                    ADD CONSTRAINT `fk_registration_events_1`
                      FOREIGN KEY (`event_id`)
                      REFERENCES `events` (`pkid`)
                      ON DELETE NO ACTION
                      ON UPDATE NO ACTION;
                    '
        );

    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DROP TABLE registration_event;');
    }
}
