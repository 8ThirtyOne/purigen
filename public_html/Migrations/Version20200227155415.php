<?php

declare(strict_types=1);

namespace MyProject\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use models\Events;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200227155415 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $reg_enable = Events::REGISTRATION_ENABLE;
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql("ALTER TABLE events ADD is_opened_registration int(1) NOT NULL DEFAULT $reg_enable, ADD registration_header TEXT");
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE `events` DROP is_opened_registration, DROP registration_header');
    }
}
