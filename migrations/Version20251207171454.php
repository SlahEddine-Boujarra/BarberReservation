<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251207171454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE barber ADD description VARCHAR(500) DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD user_id INT DEFAULT NULL, CHANGE phone phone VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE barber ADD CONSTRAINT FK_7C48A9A4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C48A9A4A76ED395 ON barber (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE barber DROP FOREIGN KEY FK_7C48A9A4A76ED395');
        $this->addSql('DROP INDEX UNIQ_7C48A9A4A76ED395 ON barber');
        $this->addSql('ALTER TABLE barber DROP description, DROP created_at, DROP user_id, CHANGE phone phone INT NOT NULL');
    }
}
