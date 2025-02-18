<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250218133954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite_physique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, duree INT NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, intensite VARCHAR(255) NOT NULL, maladie VARCHAR(255) DEFAULT NULL, traitement_diabete VARCHAR(255) DEFAULT NULL, traitement_hypertension VARCHAR(255) DEFAULT NULL, traitement_maladie_chronique VARCHAR(255) DEFAULT NULL, salle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_event (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_medical (id INT AUTO_INCREMENT NOT NULL, dossier_med_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, date_upload DATE NOT NULL, fichier VARCHAR(255) NOT NULL, INDEX IDX_D3B4A186914F6D45 (dossier_med_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier_medical (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, typemaladie VARCHAR(255) NOT NULL, date_creation DATE NOT NULL, description VARCHAR(255) NOT NULL, dernier_suivi DATE NOT NULL, UNIQUE INDEX UNIQ_3581EE6279F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, categorie_event_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date DATE NOT NULL, heure TIME NOT NULL, localisation VARCHAR(255) NOT NULL, INDEX IDX_3BAE0AA74970A9E1 (categorie_event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitudes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, categorie VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, statut TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitudes_user (habitudes_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_131F1725574B014 (habitudes_id), INDEX IDX_131F172A76ED395 (user_id), PRIMARY KEY(habitudes_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parametre_sante (id INT AUTO_INCREMENT NOT NULL, dossier_med_id INT DEFAULT NULL, date_mesure DATE NOT NULL, valeur DOUBLE PRECISION NOT NULL, note INT NOT NULL, typeparametre VARCHAR(255) NOT NULL, INDEX IDX_6BCA5295914F6D45 (dossier_med_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, nom_patient VARCHAR(255) NOT NULL, nom_medecin VARCHAR(255) NOT NULL, date DATE DEFAULT NULL, heure TIME DEFAULT NULL, statut VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_65E8AA0A3256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle_de_sport (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, equipements LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', horaires VARCHAR(255) NOT NULL, capacite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle_de_sport_activite_physique (salle_de_sport_id INT NOT NULL, activite_physique_id INT NOT NULL, INDEX IDX_5A1E0ABD264AE1D7 (salle_de_sport_id), INDEX IDX_5A1E0ABD73E392B5 (activite_physique_id), PRIMARY KEY(salle_de_sport_id, activite_physique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traitement_medical (id INT AUTO_INCREMENT NOT NULL, dossier_med_id INT DEFAULT NULL, nom_medicament VARCHAR(255) NOT NULL, dosage VARCHAR(255) NOT NULL, frequence VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, INDEX IDX_C58701F6914F6D45 (dossier_med_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', is_verified TINYINT(1) NOT NULL, telephone VARCHAR(15) DEFAULT NULL, age INT DEFAULT NULL, description VARCHAR(500) DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, date_naissance DATE DEFAULT NULL, status VARCHAR(100) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, profile_picture VARCHAR(255) DEFAULT NULL, specialite VARCHAR(255) DEFAULT NULL, diplome VARCHAR(255) DEFAULT NULL, experience INT DEFAULT NULL, adresse_cabinet VARCHAR(255) DEFAULT NULL, horaire_consultation VARCHAR(500) DEFAULT NULL, numero_professionnel VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document_medical ADD CONSTRAINT FK_D3B4A186914F6D45 FOREIGN KEY (dossier_med_id) REFERENCES dossier_medical (id)');
        $this->addSql('ALTER TABLE dossier_medical ADD CONSTRAINT FK_3581EE6279F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74970A9E1 FOREIGN KEY (categorie_event_id) REFERENCES categorie_event (id)');
        $this->addSql('ALTER TABLE habitudes_user ADD CONSTRAINT FK_131F1725574B014 FOREIGN KEY (habitudes_id) REFERENCES habitudes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE habitudes_user ADD CONSTRAINT FK_131F172A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parametre_sante ADD CONSTRAINT FK_6BCA5295914F6D45 FOREIGN KEY (dossier_med_id) REFERENCES dossier_medical (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A3256915B FOREIGN KEY (relation_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE salle_de_sport_activite_physique ADD CONSTRAINT FK_5A1E0ABD264AE1D7 FOREIGN KEY (salle_de_sport_id) REFERENCES salle_de_sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_de_sport_activite_physique ADD CONSTRAINT FK_5A1E0ABD73E392B5 FOREIGN KEY (activite_physique_id) REFERENCES activite_physique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE traitement_medical ADD CONSTRAINT FK_C58701F6914F6D45 FOREIGN KEY (dossier_med_id) REFERENCES dossier_medical (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document_medical DROP FOREIGN KEY FK_D3B4A186914F6D45');
        $this->addSql('ALTER TABLE dossier_medical DROP FOREIGN KEY FK_3581EE6279F37AE5');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74970A9E1');
        $this->addSql('ALTER TABLE habitudes_user DROP FOREIGN KEY FK_131F1725574B014');
        $this->addSql('ALTER TABLE habitudes_user DROP FOREIGN KEY FK_131F172A76ED395');
        $this->addSql('ALTER TABLE parametre_sante DROP FOREIGN KEY FK_6BCA5295914F6D45');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A3256915B');
        $this->addSql('ALTER TABLE salle_de_sport_activite_physique DROP FOREIGN KEY FK_5A1E0ABD264AE1D7');
        $this->addSql('ALTER TABLE salle_de_sport_activite_physique DROP FOREIGN KEY FK_5A1E0ABD73E392B5');
        $this->addSql('ALTER TABLE traitement_medical DROP FOREIGN KEY FK_C58701F6914F6D45');
        $this->addSql('DROP TABLE activite_physique');
        $this->addSql('DROP TABLE categorie_event');
        $this->addSql('DROP TABLE document_medical');
        $this->addSql('DROP TABLE dossier_medical');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE habitudes');
        $this->addSql('DROP TABLE habitudes_user');
        $this->addSql('DROP TABLE parametre_sante');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE salle_de_sport');
        $this->addSql('DROP TABLE salle_de_sport_activite_physique');
        $this->addSql('DROP TABLE traitement_medical');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
