<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424231317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_8D93D6497E9E4C8C');
        // $this->addSql('ALTER TABLE photo CHANGE filename filename VARCHAR(255) DEFAULT NULL');
        // $this->addSql('ALTER TABLE user ADD photo_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6497E9E4C8C ON user (photo_id)');

        $this->addSql('ALTER TABLE competences ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE competences ADD CONSTRAINT FK_competence_user_id FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_competence_user_id ON competences (user_id)');

        $this->addSql('ALTER TABLE experiences ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE experiences ADD CONSTRAINT FK_experience_user_id FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_experience_user_id ON experiences (user_id)');

        $this->addSql('ALTER TABLE scolarite ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE scolarite ADD CONSTRAINT FK_scolarite_user_id FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_scolarite_user_id ON scolarite (user_id)');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo CHANGE filename filename VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497E9E4C8C');
        $this->addSql('DROP INDEX UNIQ_8D93D6497E9E4C8C ON user');
        $this->addSql('ALTER TABLE user DROP photo_id');

        $this->addSql('ALTER TABLE competences DROP FOREIGN KEY FK_competence_user_id');
        $this->addSql('ALTER TABLE experiences DROP FOREIGN KEY FK_experience_user_id');
        $this->addSql('ALTER TABLE scolarite DROP FOREIGN KEY FK_scolarite_user_id');
        $this->addSql('DROP INDEX IDX_competence_user_id ON competence');
        $this->addSql('DROP INDEX IDX_experience_user_id ON experience');
        $this->addSql('DROP INDEX IDX_scolarite_user_id ON scolarite');
        $this->addSql('ALTER TABLE competences DROP user_id');
        $this->addSql('ALTER TABLE experiences DROP user_id');
        $this->addSql('ALTER TABLE scolarite DROP user_id');

    }
}
