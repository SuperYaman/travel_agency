<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210820104510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, total INT NOT NULL, date DATE NOT NULL, INDEX IDX_6EEAA67D9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE location_de_voitures ADD ville_depart_id INT NOT NULL, ADD ville_arrivee_id INT NOT NULL, DROP prixencharge, DROP restitution');
        $this->addSql('ALTER TABLE location_de_voitures ADD CONSTRAINT FK_E9001DF3497832A6 FOREIGN KEY (ville_depart_id) REFERENCES villes (id)');
        $this->addSql('ALTER TABLE location_de_voitures ADD CONSTRAINT FK_E9001DF334AC9A4B FOREIGN KEY (ville_arrivee_id) REFERENCES villes (id)');
        $this->addSql('CREATE INDEX IDX_E9001DF3497832A6 ON location_de_voitures (ville_depart_id)');
        $this->addSql('CREATE INDEX IDX_E9001DF334AC9A4B ON location_de_voitures (ville_arrivee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande');
        $this->addSql('ALTER TABLE location_de_voitures DROP FOREIGN KEY FK_E9001DF3497832A6');
        $this->addSql('ALTER TABLE location_de_voitures DROP FOREIGN KEY FK_E9001DF334AC9A4B');
        $this->addSql('DROP INDEX IDX_E9001DF3497832A6 ON location_de_voitures');
        $this->addSql('DROP INDEX IDX_E9001DF334AC9A4B ON location_de_voitures');
        $this->addSql('ALTER TABLE location_de_voitures ADD prixencharge VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD restitution VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP ville_depart_id, DROP ville_arrivee_id');
    }
}
