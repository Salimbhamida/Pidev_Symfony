<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230410084636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, reported_post_id INT NOT NULL, username_id INT NOT NULL, reason VARCHAR(255) NOT NULL, details VARCHAR(255) DEFAULT NULL, hide_post TINYINT(1) DEFAULT NULL, INDEX IDX_C42F7784EC0086D7 (reported_post_id), INDEX IDX_C42F7784ED766068 (username_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784EC0086D7 FOREIGN KEY (reported_post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784ED766068 FOREIGN KEY (username_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AE89BFF79');
        $this->addSql('ALTER TABLE products_category DROP FOREIGN KEY FK_134D09726C8A81A9');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE products_category');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, products_category_id INT NOT NULL, availabilitydate DATE NOT NULL, product_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, product_picture VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, product_adress VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, still_available TINYINT(1) NOT NULL, INDEX FK_B3BA5A5AE89BFF79 (products_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE products_category (id INT AUTO_INCREMENT NOT NULL, products_id INT NOT NULL, categoryname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type TINYINT(1) NOT NULL, INDEX FK_134D09726C8A81A9 (products_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AE89BFF79 FOREIGN KEY (products_category_id) REFERENCES products_category (id)');
        $this->addSql('ALTER TABLE products_category ADD CONSTRAINT FK_134D09726C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784EC0086D7');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784ED766068');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
