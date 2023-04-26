<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331150726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment_like (id INT AUTO_INCREMENT NOT NULL, comment_id INT DEFAULT NULL, user_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_8A55E25FF8697D13 (comment_id), INDEX IDX_8A55E25FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credit (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, montant DOUBLE PRECISION NOT NULL, status VARCHAR(255) NOT NULL, payement_date INT NOT NULL, createdat DATE NOT NULL, INDEX IDX_1CC16EFEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payement_credit (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, credit_id INT NOT NULL, montantpaye DOUBLE PRECISION NOT NULL, dateremboursement DATE NOT NULL, INDEX IDX_25665D34A76ED395 (user_id), UNIQUE INDEX UNIQ_25665D34CE062FF9 (credit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products_category (id INT AUTO_INCREMENT NOT NULL, products_id INT NOT NULL, categoryname VARCHAR(255) NOT NULL, type TINYINT(1) NOT NULL, INDEX IDX_134D09726C8A81A9 (products_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, reported_post_id INT NOT NULL, username_id INT NOT NULL, reason VARCHAR(255) NOT NULL, details VARCHAR(255) DEFAULT NULL, hide_post TINYINT(1) DEFAULT NULL, INDEX IDX_C42F7784EC0086D7 (reported_post_id), INDEX IDX_C42F7784ED766068 (username_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment_like ADD CONSTRAINT FK_8A55E25FF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE comment_like ADD CONSTRAINT FK_8A55E25FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE credit ADD CONSTRAINT FK_1CC16EFEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE payement_credit ADD CONSTRAINT FK_25665D34A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE payement_credit ADD CONSTRAINT FK_25665D34CE062FF9 FOREIGN KEY (credit_id) REFERENCES credit (id)');
        $this->addSql('ALTER TABLE products_category ADD CONSTRAINT FK_134D09726C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784EC0086D7 FOREIGN KEY (reported_post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784ED766068 FOREIGN KEY (username_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E852811DF69572F');
        $this->addSql('ALTER TABLE demande_credit DROP FOREIGN KEY FK_5E852811ED766068');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735687CCB12E');
        $this->addSql('DROP TABLE demande_credit');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE produit');
        $this->addSql('ALTER TABLE comment CHANGE createdatcomment createdatcomment DATETIME NOT NULL');
        $this->addSql('ALTER TABLE post ADD visible TINYINT(1) NOT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD updatedat DATETIME DEFAULT NULL, ADD video VARCHAR(255) DEFAULT NULL, ADD quote VARCHAR(255) DEFAULT NULL, CHANGE createdat createdat DATETIME NOT NULL');
        $this->addSql('ALTER TABLE products ADD products_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AE89BFF79 FOREIGN KEY (products_category_id) REFERENCES products_category (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AE89BFF79 ON products (products_category_id)');
        $this->addSql('ALTER TABLE user DROP email, CHANGE username username VARCHAR(180) NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AE89BFF79');
        $this->addSql('CREATE TABLE demande_credit (id INT AUTO_INCREMENT NOT NULL, username_id INT NOT NULL, points_id INT DEFAULT NULL, date_remboursement DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, etat TINYINT(1) NOT NULL, duration_credit VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_5E852811ED766068 (username_id), UNIQUE INDEX UNIQ_5E852811DF69572F (points_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, categoryname_id INT DEFAULT NULL, namecateg VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, typecategory VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_CDFC735687CCB12E (categoryname_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nomproduit VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prixproduit DOUBLE PRECISION NOT NULL, dateproduit DATE NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E852811DF69572F FOREIGN KEY (points_id) REFERENCES wallet (id)');
        $this->addSql('ALTER TABLE demande_credit ADD CONSTRAINT FK_5E852811ED766068 FOREIGN KEY (username_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735687CCB12E FOREIGN KEY (categoryname_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE comment_like DROP FOREIGN KEY FK_8A55E25FF8697D13');
        $this->addSql('ALTER TABLE comment_like DROP FOREIGN KEY FK_8A55E25FA76ED395');
        $this->addSql('ALTER TABLE credit DROP FOREIGN KEY FK_1CC16EFEA76ED395');
        $this->addSql('ALTER TABLE payement_credit DROP FOREIGN KEY FK_25665D34A76ED395');
        $this->addSql('ALTER TABLE payement_credit DROP FOREIGN KEY FK_25665D34CE062FF9');
        $this->addSql('ALTER TABLE products_category DROP FOREIGN KEY FK_134D09726C8A81A9');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784EC0086D7');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784ED766068');
        $this->addSql('DROP TABLE comment_like');
        $this->addSql('DROP TABLE credit');
        $this->addSql('DROP TABLE payement_credit');
        $this->addSql('DROP TABLE products_category');
        $this->addSql('DROP TABLE report');
        $this->addSql('ALTER TABLE comment CHANGE createdatcomment createdatcomment DATE NOT NULL');
        $this->addSql('ALTER TABLE post DROP visible, DROP image, DROP updatedat, DROP video, DROP quote, CHANGE createdat createdat DATE NOT NULL');
        $this->addSql('DROP INDEX IDX_B3BA5A5AE89BFF79 ON products');
        $this->addSql('ALTER TABLE products DROP products_category_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user ADD email VARCHAR(255) NOT NULL, CHANGE username username VARCHAR(255) NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }
}
