<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328134753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY categories_ibfk_1');
        $this->addSql('ALTER TABLE categories CHANGE id_service id_service INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF346683F0033A2 FOREIGN KEY (id_service) REFERENCES services (id_service)');
        $this->addSql('ALTER TABLE commentair CHANGE id_com id_com INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY fk_comm_user');
        $this->addSql('ALTER TABLE commentaire CHANGE id_reclamation id_reclamation INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCD672A9F3 FOREIGN KEY (id_reclamation) REFERENCES reclamation (id_reclamation)');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY fk_recruteur_user');
        $this->addSql('ALTER TABLE demande CHANGE id_recruteur id_recruteur INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5ABE6DBAB FOREIGN KEY (id_recruteur) REFERENCES user (id)');
        $this->addSql('ALTER TABLE photo_publications CHANGE id_ph id_ph INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY fk_user_poste');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY poste_ibfk_1');
        $this->addSql('ALTER TABLE poste CHANGE id_demande id_demande INT DEFAULT NULL, CHANGE id_candidat id_candidat INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FAB3A6E58E4 FOREIGN KEY (id_candidat) REFERENCES user (id)');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FABF8097ED5 FOREIGN KEY (id_demande) REFERENCES demande (id_demande)');
        $this->addSql('ALTER TABLE pub_like_tracks CHANGE id_pub id_pub INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE publication CHANGE id_pub id_pub INT AUTO_INCREMENT NOT NULL, CHANGE `select` `select` INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY fk_rec_user');
        $this->addSql('ALTER TABLE reclamation CHANGE id_u id_u INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640435F8C041 FOREIGN KEY (id_u) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tag CHANGE id_tag id_tag INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE tag_publication CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('DROP INDEX email ON user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF346683F0033A2');
        $this->addSql('ALTER TABLE categories CHANGE id_service id_service INT NOT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT categories_ibfk_1 FOREIGN KEY (id_service) REFERENCES services (id_service) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentair CHANGE id_com id_com INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCD672A9F3');
        $this->addSql('ALTER TABLE commentaire CHANGE id_reclamation id_reclamation INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT fk_comm_user FOREIGN KEY (id_reclamation) REFERENCES reclamation (id_reclamation) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5ABE6DBAB');
        $this->addSql('ALTER TABLE demande CHANGE id_recruteur id_recruteur INT NOT NULL');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT fk_recruteur_user FOREIGN KEY (id_recruteur) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photo_publications CHANGE id_ph id_ph INT NOT NULL');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FAB3A6E58E4');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FABF8097ED5');
        $this->addSql('ALTER TABLE poste CHANGE id_candidat id_candidat INT NOT NULL, CHANGE id_demande id_demande INT NOT NULL');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT fk_user_poste FOREIGN KEY (id_candidat) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT poste_ibfk_1 FOREIGN KEY (id_demande) REFERENCES demande (id_demande) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE publication CHANGE id_pub id_pub INT NOT NULL, CHANGE `select` `select` INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE pub_like_tracks CHANGE id_pub id_pub INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640435F8C041');
        $this->addSql('ALTER TABLE reclamation CHANGE id_u id_u INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT fk_rec_user FOREIGN KEY (id_u) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag CHANGE id_tag id_tag INT NOT NULL');
        $this->addSql('ALTER TABLE tag_publication CHANGE id id INT NOT NULL');
        $this->addSql('DROP INDEX uniq_8d93d649e7927c74 ON user');
        $this->addSql('CREATE UNIQUE INDEX email ON user (email)');
    }
}
