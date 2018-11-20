<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181120170626 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, dep_code VARCHAR(255) NOT NULL, dep_nom VARCHAR(255) NOT NULL, dep_chefvente VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, reg_code VARCHAR(255) NOT NULL, reg_nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, region_id INT NOT NULL, sec_code VARCHAR(255) NOT NULL, sec_libelle VARCHAR(255) NOT NULL, INDEX IDX_8045251F98260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travailler (id INT AUTO_INCREMENT NOT NULL, tra_reg_id INT NOT NULL, tra_vis_id INT NOT NULL, tra_date DATE NOT NULL, tra_role VARCHAR(255) NOT NULL, INDEX IDX_90B2DF3D236818D3 (tra_reg_id), INDEX IDX_90B2DF3DA272770C (tra_vis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiteur (id INT AUTO_INCREMENT NOT NULL, vis_dep_id INT NOT NULL, vis_sec_id INT DEFAULT NULL, vis_matricule VARCHAR(255) NOT NULL, vis_nom VARCHAR(255) NOT NULL, vis_adresse VARCHAR(255) NOT NULL, vis_cp VARCHAR(255) NOT NULL, vis_ville VARCHAR(255) NOT NULL, vis_dateembauche DATE NOT NULL, INDEX IDX_4EA587B82FD7ACB4 (vis_dep_id), INDEX IDX_4EA587B873A866E6 (vis_sec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE secteur ADD CONSTRAINT FK_8045251F98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE travailler ADD CONSTRAINT FK_90B2DF3D236818D3 FOREIGN KEY (tra_reg_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE travailler ADD CONSTRAINT FK_90B2DF3DA272770C FOREIGN KEY (tra_vis_id) REFERENCES visiteur (id)');
        $this->addSql('ALTER TABLE visiteur ADD CONSTRAINT FK_4EA587B82FD7ACB4 FOREIGN KEY (vis_dep_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE visiteur ADD CONSTRAINT FK_4EA587B873A866E6 FOREIGN KEY (vis_sec_id) REFERENCES secteur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visiteur DROP FOREIGN KEY FK_4EA587B82FD7ACB4');
        $this->addSql('ALTER TABLE secteur DROP FOREIGN KEY FK_8045251F98260155');
        $this->addSql('ALTER TABLE travailler DROP FOREIGN KEY FK_90B2DF3D236818D3');
        $this->addSql('ALTER TABLE visiteur DROP FOREIGN KEY FK_4EA587B873A866E6');
        $this->addSql('ALTER TABLE travailler DROP FOREIGN KEY FK_90B2DF3DA272770C');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE travailler');
        $this->addSql('DROP TABLE visiteur');
    }
}
