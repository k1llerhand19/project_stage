<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609095246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boitier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, marque VARCHAR(25) NOT NULL, modele VARCHAR(25) NOT NULL, format_boitier VARCHAR(20) NOT NULL, format_alimentation VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cartemere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, marque VARCHAR(25) NOT NULL, modele VARCHAR(25) NOT NULL, support_cpu VARCHAR(25) NOT NULL, nbr_cpu_suppote INT NOT NULL, chipset VARCHAR(25) NOT NULL, type_memoire VARCHAR(25) NOT NULL, capacite_maximale_ram_par_slot INT NOT NULL, capacite_maximale_ram INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cpu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, marque VARCHAR(25) NOT NULL, modele VARCHAR(25) NOT NULL, support_processeur VARCHAR(25) NOT NULL, frequence_cpu DOUBLE PRECISION NOT NULL, nbr_core INT NOT NULL, nbr_threads INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gpu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, marque VARCHAR(25) NOT NULL, modele VARCHAR(25) NOT NULL, chipset_graphique VARCHAR(25) NOT NULL, taille_memoire INT NOT NULL, type_memoire VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hdd (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, marque VARCHAR(25) NOT NULL, modele VARCHAR(25) NOT NULL, capacite INT NOT NULL, vitesse_rotation INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordinateur (id INT AUTO_INCREMENT NOT NULL, alimentation_id INT NOT NULL, boitier_id INT NOT NULL, cartemere_id INT NOT NULL, gpu_id INT NOT NULL, hdd_id INT NOT NULL, cpu_id INT NOT NULL, ram_id INT NOT NULL, refroidisseur_id INT NOT NULL, ssd_id INT NOT NULL, nom VARCHAR(50) NOT NULL, marque VARCHAR(25) NOT NULL, modele VARCHAR(25) NOT NULL, INDEX IDX_8712E8DB8441D4D9 (alimentation_id), INDEX IDX_8712E8DB44DE6F7C (boitier_id), INDEX IDX_8712E8DBD60943BC (cartemere_id), INDEX IDX_8712E8DB98003202 (gpu_id), INDEX IDX_8712E8DB1493816F (hdd_id), INDEX IDX_8712E8DB3917014 (cpu_id), INDEX IDX_8712E8DB3366068 (ram_id), INDEX IDX_8712E8DBFC823A80 (refroidisseur_id), INDEX IDX_8712E8DBAF4238A5 (ssd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ram (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, marque VARCHAR(25) NOT NULL, modele VARCHAR(25) NOT NULL, type_memoire VARCHAR(20) NOT NULL, frequence_memoire INT NOT NULL, capacite_par_barrette INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refroidisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, marque VARCHAR(25) NOT NULL, modele VARCHAR(25) NOT NULL, support_processeur VARCHAR(20) NOT NULL, vitesse_rotation_minimum INT NOT NULL, vitesse_rotation_maximum INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB8441D4D9 FOREIGN KEY (alimentation_id) REFERENCES alimentation (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB44DE6F7C FOREIGN KEY (boitier_id) REFERENCES boitier (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DBD60943BC FOREIGN KEY (cartemere_id) REFERENCES cartemere (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB98003202 FOREIGN KEY (gpu_id) REFERENCES gpu (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB1493816F FOREIGN KEY (hdd_id) REFERENCES hdd (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB3917014 FOREIGN KEY (cpu_id) REFERENCES cpu (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB3366068 FOREIGN KEY (ram_id) REFERENCES ram (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DBFC823A80 FOREIGN KEY (refroidisseur_id) REFERENCES refroidisseur (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DBAF4238A5 FOREIGN KEY (ssd_id) REFERENCES ssd (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB8441D4D9');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB44DE6F7C');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DBD60943BC');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB98003202');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB1493816F');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB3917014');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB3366068');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DBFC823A80');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DBAF4238A5');
        $this->addSql('DROP TABLE boitier');
        $this->addSql('DROP TABLE cartemere');
        $this->addSql('DROP TABLE cpu');
        $this->addSql('DROP TABLE gpu');
        $this->addSql('DROP TABLE hdd');
        $this->addSql('DROP TABLE ordinateur');
        $this->addSql('DROP TABLE ram');
        $this->addSql('DROP TABLE refroidisseur');
    }
}
