<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425203815 extends AbstractMigration
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
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY fk_recruteur_user');
        $this->addSql('ALTER TABLE demande CHANGE id_recruteur id_recruteur INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5ABE6DBAB FOREIGN KEY (id_recruteur) REFERENCES user (id)');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY fk_user_poste');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY poste_ibfk_1');
        $this->addSql('ALTER TABLE poste CHANGE id_demande id_demande INT DEFAULT NULL, CHANGE id_candidat id_candidat INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FAB3A6E58E4 FOREIGN KEY (id_candidat) REFERENCES user (id)');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FABF8097ED5 FOREIGN KEY (id_demande) REFERENCES demande (id_demande)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF346683F0033A2');
        $this->addSql('ALTER TABLE categories CHANGE id_service id_service INT NOT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT categories_ibfk_1 FOREIGN KEY (id_service) REFERENCES services (id_service) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5ABE6DBAB');
        $this->addSql('ALTER TABLE demande CHANGE id_recruteur id_recruteur INT NOT NULL');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT fk_recruteur_user FOREIGN KEY (id_recruteur) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FAB3A6E58E4');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FABF8097ED5');
        $this->addSql('ALTER TABLE poste CHANGE id_candidat id_candidat INT NOT NULL, CHANGE id_demande id_demande INT NOT NULL');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT fk_user_poste FOREIGN KEY (id_candidat) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT poste_ibfk_1 FOREIGN KEY (id_demande) REFERENCES demande (id_demande) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
