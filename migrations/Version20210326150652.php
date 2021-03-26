<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326150652 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, salle_id INT DEFAULT NULL, commentaire VARCHAR(10000) NOT NULL, INDEX IDX_8F91ABF019EB6921 (client_id), INDEX IDX_8F91ABF0DC304035 (salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, photo LONGBLOB DEFAULT NULL, adresse VARCHAR(255) NOT NULL, date_naissance DATETIME NOT NULL, mail VARCHAR(255) NOT NULL, telportable VARCHAR(10) NOT NULL, login VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE obstacle (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, photo LONGBLOB NOT NULL, type_obstacle VARCHAR(255) NOT NULL, echec INT NOT NULL, temps_passage TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE obstacle_position_obstacle (obstacle_id INT NOT NULL, position_obstacle_id INT NOT NULL, INDEX IDX_ACCEBF3AF616DCDF (obstacle_id), INDEX IDX_ACCEBF3A1B80BED3 (position_obstacle_id), PRIMARY KEY(obstacle_id, position_obstacle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, salle_id INT DEFAULT NULL, jour DATETIME NOT NULL, nb_joueurs INT NOT NULL, nb_obstacles INT NOT NULL, reussite TINYINT(1) NOT NULL, INDEX IDX_59B1F3D19EB6921 (client_id), INDEX IDX_59B1F3DDC304035 (salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie_position_obstacle (partie_id INT NOT NULL, position_obstacle_id INT NOT NULL, INDEX IDX_A6267ED1E075F7A4 (partie_id), INDEX IDX_A6267ED11B80BED3 (position_obstacle_id), PRIMARY KEY(partie_id, position_obstacle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_client (id INT AUTO_INCREMENT NOT NULL, partie_id INT DEFAULT NULL, photo LONGBLOB NOT NULL, INDEX IDX_92FB737DE075F7A4 (partie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position_obstacle (id INT AUTO_INCREMENT NOT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, theme_id INT DEFAULT NULL, ville VARCHAR(255) NOT NULL, INDEX IDX_4E977E5C59027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE themes (id INT AUTO_INCREMENT NOT NULL, themes VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE obstacle_position_obstacle ADD CONSTRAINT FK_ACCEBF3AF616DCDF FOREIGN KEY (obstacle_id) REFERENCES obstacle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE obstacle_position_obstacle ADD CONSTRAINT FK_ACCEBF3A1B80BED3 FOREIGN KEY (position_obstacle_id) REFERENCES position_obstacle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3DDC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE partie_position_obstacle ADD CONSTRAINT FK_A6267ED1E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie_position_obstacle ADD CONSTRAINT FK_A6267ED11B80BED3 FOREIGN KEY (position_obstacle_id) REFERENCES position_obstacle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photo_client ADD CONSTRAINT FK_92FB737DE075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5C59027487 FOREIGN KEY (theme_id) REFERENCES themes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF019EB6921');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D19EB6921');
        $this->addSql('ALTER TABLE obstacle_position_obstacle DROP FOREIGN KEY FK_ACCEBF3AF616DCDF');
        $this->addSql('ALTER TABLE partie_position_obstacle DROP FOREIGN KEY FK_A6267ED1E075F7A4');
        $this->addSql('ALTER TABLE photo_client DROP FOREIGN KEY FK_92FB737DE075F7A4');
        $this->addSql('ALTER TABLE obstacle_position_obstacle DROP FOREIGN KEY FK_ACCEBF3A1B80BED3');
        $this->addSql('ALTER TABLE partie_position_obstacle DROP FOREIGN KEY FK_A6267ED11B80BED3');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0DC304035');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3DDC304035');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5C59027487');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE obstacle');
        $this->addSql('DROP TABLE obstacle_position_obstacle');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE partie_position_obstacle');
        $this->addSql('DROP TABLE photo_client');
        $this->addSql('DROP TABLE position_obstacle');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE themes');
    }
}
