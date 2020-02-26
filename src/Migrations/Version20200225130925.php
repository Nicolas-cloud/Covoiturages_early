<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200225130925 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE stage_tuteur DROP FOREIGN KEY FK_CAC883732298D193');
        $this->addSql('ALTER TABLE Stage DROP FOREIGN KEY FK_3BDBC6DBCF5E72D');
        $this->addSql('ALTER TABLE stage_tuteur DROP FOREIGN KEY FK_CAC8837386EC68D8');
        $this->addSql('CREATE TABLE Trajet (id INT AUTO_INCREMENT NOT NULL, ville_depart VARCHAR(255) NOT NULL, ville_arrivee VARCHAR(255) NOT NULL, heure_depart TIME NOT NULL, heure_arrivee TIME NOT NULL, nb_places INT NOT NULL, prix DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, date_creation DATE NOT NULL, date_modification DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, age INT NOT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, fumeur TINYINT(1) NOT NULL, voiture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passager (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, id_trajet_id INT NOT NULL, INDEX IDX_BFF42EE9C6EE5C49 (id_utilisateur_id), INDEX IDX_BFF42EE98D271404 (id_trajet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE passager ADD CONSTRAINT FK_BFF42EE9C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE passager ADD CONSTRAINT FK_BFF42EE98D271404 FOREIGN KEY (id_trajet_id) REFERENCES Trajet (id)');
        $this->addSql('DROP TABLE Stage');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE stage_tuteur');
        $this->addSql('DROP TABLE tuteur');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE passager DROP FOREIGN KEY FK_BFF42EE98D271404');
        $this->addSql('ALTER TABLE passager DROP FOREIGN KEY FK_BFF42EE9C6EE5C49');
        $this->addSql('CREATE TABLE Stage (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, poste VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, actif TINYINT(1) NOT NULL, date_creation DATE NOT NULL, date_expiration DATE NOT NULL, date_modification DATE NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, societe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_3BDBC6DBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE stage_tuteur (stage_id INT NOT NULL, tuteur_id INT NOT NULL, INDEX IDX_CAC883732298D193 (stage_id), INDEX IDX_CAC8837386EC68D8 (tuteur_id), PRIMARY KEY(stage_id, tuteur_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tuteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE Stage ADD CONSTRAINT FK_3BDBC6DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE stage_tuteur ADD CONSTRAINT FK_CAC883732298D193 FOREIGN KEY (stage_id) REFERENCES Stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage_tuteur ADD CONSTRAINT FK_CAC8837386EC68D8 FOREIGN KEY (tuteur_id) REFERENCES tuteur (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE Trajet');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE passager');
    }
}
