<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230612095427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boitier ADD formatboitier VARCHAR(20) NOT NULL, ADD formatalimentation VARCHAR(20) NOT NULL, DROP format_boitier, DROP format_alimentation');
        $this->addSql('ALTER TABLE cartemere ADD nbrcpusupporte INT NOT NULL, ADD capacitemaximalramparslot INT NOT NULL, ADD capacitemaximalram INT NOT NULL, DROP nbrcpusuppote, DROP capacitemaximaleramparslot, DROP capacitemaximaleram');
        $this->addSql('ALTER TABLE cpu ADD nbrcore INT NOT NULL, ADD nbrthreads INT NOT NULL, DROP nbr_core, DROP nbr_threads, CHANGE support_processeur supportcpu VARCHAR(25) NOT NULL, CHANGE frequence_cpu frequencecpu DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE gpu ADD chipsetgraphique VARCHAR(50) NOT NULL, ADD typememoire VARCHAR(25) NOT NULL, DROP chipset_graphique, DROP type_memoire, CHANGE taille_memoire taillememoire INT NOT NULL');
        $this->addSql('ALTER TABLE hdd CHANGE vitesse_rotation vitesserotation INT NOT NULL');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB8441D4D9');
        $this->addSql('DROP INDEX IDX_8712E8DB8441D4D9 ON ordinateur');
        $this->addSql('ALTER TABLE ordinateur CHANGE alimentation_id alim_id INT NOT NULL');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DBBF571CE FOREIGN KEY (alim_id) REFERENCES alimentation (id)');
        $this->addSql('CREATE INDEX IDX_8712E8DBBF571CE ON ordinateur (alim_id)');
        $this->addSql('ALTER TABLE ram ADD frequencememoire INT NOT NULL, ADD capaciteparbarrette INT NOT NULL, DROP frequence_memoire, DROP capacite_par_barrette, CHANGE type_memoire typememoire VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE refroidisseur ADD supportcpu VARCHAR(50) NOT NULL, ADD vitesserotationminimum INT NOT NULL, ADD vitesserotationmaximum INT NOT NULL, DROP support_processeur, DROP vitesse_rotation_minimum, DROP vitesse_rotation_maximum');
        $this->addSql('ALTER TABLE ssd ADD vitesselecture INT NOT NULL, ADD vitesseecriture INT NOT NULL, DROP vitesse_lecture, DROP vitesse_ecriture');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cpu ADD nbr_core INT NOT NULL, ADD nbr_threads INT NOT NULL, DROP nbrcore, DROP nbrthreads, CHANGE supportcpu support_processeur VARCHAR(25) NOT NULL, CHANGE frequencecpu frequence_cpu DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE cartemere ADD nbrcpusuppote INT NOT NULL, ADD capacitemaximaleramparslot INT NOT NULL, ADD capacitemaximaleram INT NOT NULL, DROP nbrcpusupporte, DROP capacitemaximalramparslot, DROP capacitemaximalram');
        $this->addSql('ALTER TABLE ram ADD frequence_memoire INT NOT NULL, ADD capacite_par_barrette INT NOT NULL, DROP frequencememoire, DROP capaciteparbarrette, CHANGE typememoire type_memoire VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE gpu ADD type_memoire VARCHAR(25) NOT NULL, DROP chipsetgraphique, CHANGE typememoire chipset_graphique VARCHAR(25) NOT NULL, CHANGE taillememoire taille_memoire INT NOT NULL');
        $this->addSql('ALTER TABLE hdd CHANGE vitesserotation vitesse_rotation INT NOT NULL');
        $this->addSql('ALTER TABLE boitier ADD format_boitier VARCHAR(20) NOT NULL, ADD format_alimentation VARCHAR(20) NOT NULL, DROP formatboitier, DROP formatalimentation');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DBBF571CE');
        $this->addSql('DROP INDEX IDX_8712E8DBBF571CE ON ordinateur');
        $this->addSql('ALTER TABLE ordinateur CHANGE alim_id alimentation_id INT NOT NULL');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB8441D4D9 FOREIGN KEY (alimentation_id) REFERENCES alimentation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8712E8DB8441D4D9 ON ordinateur (alimentation_id)');
        $this->addSql('ALTER TABLE ssd ADD vitesse_lecture INT NOT NULL, ADD vitesse_ecriture INT NOT NULL, DROP vitesselecture, DROP vitesseecriture');
        $this->addSql('ALTER TABLE refroidisseur ADD support_processeur VARCHAR(20) NOT NULL, ADD vitesse_rotation_minimum INT NOT NULL, ADD vitesse_rotation_maximum INT NOT NULL, DROP supportcpu, DROP vitesserotationminimum, DROP vitesserotationmaximum');
    }
}
