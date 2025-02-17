<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250216211133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite_physique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, duree INT NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, intensite VARCHAR(255) NOT NULL, maladie VARCHAR(255) DEFAULT NULL, traitement_diabete VARCHAR(255) DEFAULT NULL, traitement_hypertension VARCHAR(255) DEFAULT NULL, traitement_maladie_chronique VARCHAR(255) DEFAULT NULL, salle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitudes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, categorie VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, statut TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitudes_user (habitudes_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_131F1725574B014 (habitudes_id), INDEX IDX_131F172A76ED395 (user_id), PRIMARY KEY(habitudes_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle_de_sport (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, equipements LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', horaires VARCHAR(255) NOT NULL, capacite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle_de_sport_activite_physique (salle_de_sport_id INT NOT NULL, activite_physique_id INT NOT NULL, INDEX IDX_5A1E0ABD264AE1D7 (salle_de_sport_id), INDEX IDX_5A1E0ABD73E392B5 (activite_physique_id), PRIMARY KEY(salle_de_sport_id, activite_physique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE habitudes_user ADD CONSTRAINT FK_131F1725574B014 FOREIGN KEY (habitudes_id) REFERENCES habitudes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE habitudes_user ADD CONSTRAINT FK_131F172A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_de_sport_activite_physique ADD CONSTRAINT FK_5A1E0ABD264AE1D7 FOREIGN KEY (salle_de_sport_id) REFERENCES salle_de_sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_de_sport_activite_physique ADD CONSTRAINT FK_5A1E0ABD73E392B5 FOREIGN KEY (activite_physique_id) REFERENCES activite_physique (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habitudes_user DROP FOREIGN KEY FK_131F1725574B014');
        $this->addSql('ALTER TABLE habitudes_user DROP FOREIGN KEY FK_131F172A76ED395');
        $this->addSql('ALTER TABLE salle_de_sport_activite_physique DROP FOREIGN KEY FK_5A1E0ABD264AE1D7');
        $this->addSql('ALTER TABLE salle_de_sport_activite_physique DROP FOREIGN KEY FK_5A1E0ABD73E392B5');
        $this->addSql('DROP TABLE activite_physique');
        $this->addSql('DROP TABLE habitudes');
        $this->addSql('DROP TABLE habitudes_user');
        $this->addSql('DROP TABLE salle_de_sport');
        $this->addSql('DROP TABLE salle_de_sport_activite_physique');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
