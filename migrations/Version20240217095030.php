<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240217095030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX base_url ON short_link');
        $this->addSql('ALTER TABLE short_link DROP qr_code');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE short_link ADD qr_code VARCHAR(16) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX base_url ON short_link (base_url, short_url, qr_code)');
    }
}
