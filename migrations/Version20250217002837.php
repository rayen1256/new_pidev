<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250217002837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       // $this->addSql('ALTER TABLE user ADD telephone VARCHAR(15) DEFAULT NULL, ADD age INT DEFAULT NULL, ADD description VARCHAR(500) DEFAULT NULL, ADD etat VARCHAR(255) DEFAULT NULL, ADD date_naissance DATE DEFAULT NULL, ADD status VARCHAR(100) DEFAULT NULL, ADD latitude DOUBLE PRECISION DEFAULT NULL, ADD longitude DOUBLE PRECISION DEFAULT NULL, ADD profile_picture VARCHAR(255) DEFAULT NULL, ADD specialite VARCHAR(255) DEFAULT NULL, ADD diplome VARCHAR(255) DEFAULT NULL, ADD experience INT DEFAULT NULL, ADD adresse_cabinet VARCHAR(255) DEFAULT NULL, ADD horaire_consultation VARCHAR(500) DEFAULT NULL, ADD numero_professionnel VARCHAR(255) DEFAULT NULL, DROP localisation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD localisation VARCHAR(255) NOT NULL, DROP telephone, DROP age, DROP description, DROP etat, DROP date_naissance, DROP status, DROP latitude, DROP longitude, DROP profile_picture, DROP specialite, DROP diplome, DROP experience, DROP adresse_cabinet, DROP horaire_consultation, DROP numero_professionnel');
    }
}
