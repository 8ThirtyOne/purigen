<?php

declare(strict_types=1);

namespace MyProject\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use models\Video;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200615085145 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $reg_disable = Video::REGISTRATION_DISABLE;
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql("ALTER TABLE video ADD slug varchar(255), ADD is_opened_registration int(1) NOT NULL DEFAULT $reg_disable,  ADD registration_header TEXT");
        $this->addSql('UPDATE video SET slug = replace(trim(lower(title)), \' \', \'-\');');
        $this->addSql('CREATE TABLE `registration_from_video` (
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
                      `video_id` bigint(20) DEFAULT NULL,
                      PRIMARY KEY (`pkid`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4;
                    '
        );

    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE `video` DROP `slug`, DROP is_opened_registration, DROP registration_header;');
        $this->addSql('DROP TABLE registration_from_video;');
    }
}
