<?php

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class AddRelationsToUserTable extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->getTable('user');
        
        // Ajouter la relation avec la table competences
        $table->addForeignKeyConstraint('competences', ['idComp'], ['id'], ['onDelete' => 'CASCADE'], 'user_competences');

        // Ajouter la relation avec la table experiences
        $table->addForeignKeyConstraint('experiences', ['idExp'], ['id'], ['onDelete' => 'CASCADE'], 'user_experiences');

        // Ajouter la relation avec la table scolarite
        $table->addForeignKeyConstraint('scolarite', ['idEtab'], ['id'], ['onDelete' => 'CASCADE'], 'user_scolarite');

        // Ajouter la relation one-to-one avec la table photo
        $table->addForeignKeyConstraint('photo', ['idPhoto'], ['id'], ['onDelete' => 'CASCADE'], 'user_photo');
        $table->addUniqueIndex(['idPhoto'], 'unique_user_photo');
    }


}
