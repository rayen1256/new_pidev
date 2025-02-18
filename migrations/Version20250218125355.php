<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250218125355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite_physique DROP idd');
        $this->addSql('ALTER TABLE rendez_vous ADD relation_medecin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0AEEE3C09D FOREIGN KEY (relation_medecin_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_65E8AA0AEEE3C09D ON rendez_vous (relation_medecin_id)');
        $this->addSql('ALTER TABLE user DROP localisation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite_physique ADD idd VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0AEEE3C09D');
        $this->addSql('DROP INDEX IDX_65E8AA0AEEE3C09D ON rendez_vous');
        $this->addSql('ALTER TABLE rendez_vous DROP relation_medecin_id');
        $this->addSql('ALTER TABLE user ADD localisation VARCHAR(255) NOT NULL');
    }
}
