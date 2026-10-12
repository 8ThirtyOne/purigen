<?php

declare(strict_types=1);

namespace MyProject\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201009130632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'add CTA button title for events';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE events ADD ctabutton1 varchar (100) NOT NULL DEFAULT "more info"');
        $this->addSql('ALTER TABLE events ADD ctabutton2 varchar (100) NOT NULL DEFAULT "more info"');



    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE `events` DROP COLUMN `ctabutton1`;');
        $this->addSql('ALTER TABLE `events` DROP COLUMN `ctabutton2`;');

    }
}
