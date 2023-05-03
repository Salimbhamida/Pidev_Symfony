<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230417221502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCD672A9F3');
        $this->addSql('DROP INDEX fk_67f068bcd672a9f3 ON commentaire');
        $this->addSql('CREATE INDEX fk_comm_user ON commentaire (id_reclamation)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCD672A9F3 FOREIGN KEY (id_reclamation) REFERENCES reclamation (id_reclamation)');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5ABE6DBAB');
        $this->addSql('DROP INDEX fk_2694d7a5abe6dbab ON demande');
        $this->addSql('CREATE INDEX fk_recruteur_user ON demande (id_recruteur)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5ABE6DBAB FOREIGN KEY (id_recruteur) REFERENCES user (id)');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FAB3A6E58E4');
        $this->addSql('DROP INDEX fk_7c890fab3a6e58e4 ON poste');
        $this->addSql('CREATE INDEX fk_user_poste ON poste (id_candidat)');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FAB3A6E58E4 FOREIGN KEY (id_candidat) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640435F8C041');
        $this->addSql('DROP INDEX fk_ce60640435f8c041 ON reclamation');
        $this->addSql('CREATE INDEX fk_rec_user ON reclamation (id_u)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640435F8C041 FOREIGN KEY (id_u) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCD672A9F3');
        $this->addSql('DROP INDEX fk_comm_user ON commentaire');
        $this->addSql('CREATE INDEX FK_67F068BCD672A9F3 ON commentaire (id_reclamation)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCD672A9F3 FOREIGN KEY (id_reclamation) REFERENCES reclamation (id_reclamation)');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5ABE6DBAB');
        $this->addSql('DROP INDEX fk_recruteur_user ON demande');
        $this->addSql('CREATE INDEX FK_2694D7A5ABE6DBAB ON demande (id_recruteur)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5ABE6DBAB FOREIGN KEY (id_recruteur) REFERENCES user (id)');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FAB3A6E58E4');
        $this->addSql('DROP INDEX fk_user_poste ON poste');
        $this->addSql('CREATE INDEX FK_7C890FAB3A6E58E4 ON poste (id_candidat)');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FAB3A6E58E4 FOREIGN KEY (id_candidat) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640435F8C041');
        $this->addSql('DROP INDEX fk_rec_user ON reclamation');
        $this->addSql('CREATE INDEX FK_CE60640435F8C041 ON reclamation (id_u)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640435F8C041 FOREIGN KEY (id_u) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
