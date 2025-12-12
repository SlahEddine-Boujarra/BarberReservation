<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251207160606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE barber (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone INT NOT NULL, location VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, duration INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE service_barber (service_id INT NOT NULL, barber_id INT NOT NULL, INDEX IDX_428FAC92ED5CA9E6 (service_id), INDEX IDX_428FAC92BFF2FEF2 (barber_id), PRIMARY KEY (service_id, barber_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE service_barber ADD CONSTRAINT FK_428FAC92ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_barber ADD CONSTRAINT FK_428FAC92BFF2FEF2 FOREIGN KEY (barber_id) REFERENCES barber (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_barber DROP FOREIGN KEY FK_428FAC92ED5CA9E6');
        $this->addSql('ALTER TABLE service_barber DROP FOREIGN KEY FK_428FAC92BFF2FEF2');
        $this->addSql('DROP TABLE barber');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_barber');
    }
}
