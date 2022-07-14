<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713175755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE school_year DROP FOREIGN KEY FK_FAAAACDACB944F1A');
        $this->addSql('DROP INDEX IDX_FAAAACDACB944F1A ON school_year');
        $this->addSql('ALTER TABLE school_year DROP student_id');
        $this->addSql('ALTER TABLE student ADD school_year_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33D2EECC3F FOREIGN KEY (school_year_id) REFERENCES school_year (id)');
        $this->addSql('CREATE INDEX IDX_B723AF33D2EECC3F ON student (school_year_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE school_year ADD student_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE school_year ADD CONSTRAINT FK_FAAAACDACB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_FAAAACDACB944F1A ON school_year (student_id)');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33D2EECC3F');
        $this->addSql('DROP INDEX IDX_B723AF33D2EECC3F ON student');
        $this->addSql('ALTER TABLE student DROP school_year_id');
    }
}
