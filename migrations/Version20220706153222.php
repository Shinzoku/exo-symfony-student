<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706153222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE teacher_school_year (teacher_id INT NOT NULL, school_year_id INT NOT NULL, INDEX IDX_2CF6109041807E1D (teacher_id), INDEX IDX_2CF61090D2EECC3F (school_year_id), PRIMARY KEY(teacher_id, school_year_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher_tag (teacher_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_B1A33B741807E1D (teacher_id), INDEX IDX_B1A33B7BAD26311 (tag_id), PRIMARY KEY(teacher_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE teacher_school_year ADD CONSTRAINT FK_2CF6109041807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teacher_school_year ADD CONSTRAINT FK_2CF61090D2EECC3F FOREIGN KEY (school_year_id) REFERENCES school_year (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teacher_tag ADD CONSTRAINT FK_B1A33B741807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teacher_tag ADD CONSTRAINT FK_B1A33B7BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE teacher_school_year');
        $this->addSql('DROP TABLE teacher_tag');
    }
}
