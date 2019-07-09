<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190430044655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, nom_agent VARCHAR(255) NOT NULL, prenom_agent VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, adresse_agent VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locataire (id INT AUTO_INCREMENT NOT NULL, nom_locataire VARCHAR(255) NOT NULL, prenom_locataire VARCHAR(255) NOT NULL, nationalite VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, pieces_fournis VARCHAR(255) NOT NULL, type_locataire VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, locataire_id INT NOT NULL, date_location DATE NOT NULL, type_location VARCHAR(255) NOT NULL, montant_location INT NOT NULL, caution INT NOT NULL, etat_location VARCHAR(255) NOT NULL, INDEX IDX_5E9E89CBD8A38199 (locataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, locataire_id INT NOT NULL, location_id INT NOT NULL, date_de_paiement DATE NOT NULL, montant_paiement INT NOT NULL, INDEX IDX_B1DC7A1ED8A38199 (locataire_id), INDEX IDX_B1DC7A1E64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBD8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1ED8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBD8A38199');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1ED8A38199');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E64D218E');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE locataire');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE paiement');
    }
}
