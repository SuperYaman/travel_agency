<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210820111703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ville_depart (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location_de_voitures ADD ville_depart_id INT NOT NULL, ADD ville_arrivee_id INT NOT NULL');
        $this->addSql('ALTER TABLE location_de_voitures ADD CONSTRAINT FK_E9001DF3497832A6 FOREIGN KEY (ville_depart_id) REFERENCES villes (id)');
        $this->addSql('ALTER TABLE location_de_voitures ADD CONSTRAINT FK_E9001DF334AC9A4B FOREIGN KEY (ville_arrivee_id) REFERENCES villes (id)');
        $this->addSql('CREATE INDEX IDX_E9001DF3497832A6 ON location_de_voitures (ville_depart_id)');
        $this->addSql('CREATE INDEX IDX_E9001DF334AC9A4B ON location_de_voitures (ville_arrivee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ville_depart');
        $this->addSql('ALTER TABLE location_de_voitures DROP FOREIGN KEY FK_E9001DF3497832A6');
        $this->addSql('ALTER TABLE location_de_voitures DROP FOREIGN KEY FK_E9001DF334AC9A4B');
        $this->addSql('DROP INDEX IDX_E9001DF3497832A6 ON location_de_voitures');
        $this->addSql('DROP INDEX IDX_E9001DF334AC9A4B ON location_de_voitures');
        $this->addSql('ALTER TABLE location_de_voitures DROP ville_depart_id, DROP ville_arrivee_id');
    }
}
