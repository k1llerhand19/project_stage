<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230612091914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cartemere ADD capacitemaximaleramparslot INT NOT NULL, ADD capacitemaximaleram INT NOT NULL, DROP capacite_maximale_ram_par_slot, DROP capacite_maximale_ram, CHANGE type_memoire typememoire VARCHAR(25) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cartemere ADD capacite_maximale_ram_par_slot INT NOT NULL, ADD capacite_maximale_ram INT NOT NULL, DROP capacitemaximaleramparslot, DROP capacitemaximaleram, CHANGE typememoire type_memoire VARCHAR(25) NOT NULL');
    }
}
