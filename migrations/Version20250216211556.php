<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250216211556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite_physique ADD idd VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE habitudes_user ADD CONSTRAINT FK_131F1725574B014 FOREIGN KEY (habitudes_id) REFERENCES habitudes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE habitudes_user ADD CONSTRAINT FK_131F172A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_de_sport_activite_physique ADD CONSTRAINT FK_5A1E0ABD264AE1D7 FOREIGN KEY (salle_de_sport_id) REFERENCES salle_de_sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_de_sport_activite_physique ADD CONSTRAINT FK_5A1E0ABD73E392B5 FOREIGN KEY (activite_physique_id) REFERENCES activite_physique (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite_physique DROP idd');
        $this->addSql('ALTER TABLE habitudes_user DROP FOREIGN KEY FK_131F1725574B014');
        $this->addSql('ALTER TABLE habitudes_user DROP FOREIGN KEY FK_131F172A76ED395');
        $this->addSql('ALTER TABLE salle_de_sport_activite_physique DROP FOREIGN KEY FK_5A1E0ABD264AE1D7');
        $this->addSql('ALTER TABLE salle_de_sport_activite_physique DROP FOREIGN KEY FK_5A1E0ABD73E392B5');
    }
}
