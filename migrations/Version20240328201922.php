<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240328201922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE body_design (ulid VARCHAR(255) NOT NULL, design VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chassis (ulid VARCHAR(255) NOT NULL, chassis VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lighting (ulid VARCHAR(255) NOT NULL, power_conducter VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manufacturer (ulid VARCHAR(255) NOT NULL, manufacturer VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_car (ulid VARCHAR(255) NOT NULL, original_car_ulid VARCHAR(255) NOT NULL, manufacturer_ulid VARCHAR(255) NOT NULL, power_conducter_ulid VARCHAR(255) DEFAULT NULL, lighting_ulid VARCHAR(255) DEFAULT NULL, chassis_ulid VARCHAR(255) DEFAULT NULL, body_design_ulid VARCHAR(255) DEFAULT NULL, remark_ulid VARCHAR(255) DEFAULT NULL, scale NUMERIC(10, 2) NOT NULL, manufactured_from DATETIME NOT NULL, manufactured_to DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_22FE8C622ABD3BE4 (original_car_ulid), INDEX IDX_22FE8C6247C3F996 (manufacturer_ulid), INDEX IDX_22FE8C62A6F04B09 (power_conducter_ulid), INDEX IDX_22FE8C626005DACD (lighting_ulid), INDEX IDX_22FE8C62D1CD30C1 (chassis_ulid), INDEX IDX_22FE8C62563AEBFC (body_design_ulid), INDEX IDX_22FE8C62B2122F8 (remark_ulid), PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE original_cars (ulid VARCHAR(255) NOT NULL, brand_ulid VARCHAR(255) DEFAULT NULL, model VARCHAR(100) NOT NULL, performance_ps SMALLINT NOT NULL, performance_kw SMALLINT NOT NULL, manufactured_from DATETIME NOT NULL, manufactured_to DATETIME NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_9FB27622E5EFC2E6 (brand_ulid), PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE power_conducter (ulid VARCHAR(255) NOT NULL, power_conducter VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE remarks (ulid VARCHAR(255) NOT NULL, remark VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE model_car ADD CONSTRAINT FK_22FE8C622ABD3BE4 FOREIGN KEY (original_car_ulid) REFERENCES original_cars (ulid)');
        $this->addSql('ALTER TABLE model_car ADD CONSTRAINT FK_22FE8C6247C3F996 FOREIGN KEY (manufacturer_ulid) REFERENCES model_car (ulid)');
        $this->addSql('ALTER TABLE model_car ADD CONSTRAINT FK_22FE8C62A6F04B09 FOREIGN KEY (power_conducter_ulid) REFERENCES power_conducter (ulid)');
        $this->addSql('ALTER TABLE model_car ADD CONSTRAINT FK_22FE8C626005DACD FOREIGN KEY (lighting_ulid) REFERENCES lighting (ulid)');
        $this->addSql('ALTER TABLE model_car ADD CONSTRAINT FK_22FE8C62D1CD30C1 FOREIGN KEY (chassis_ulid) REFERENCES chassis (ulid)');
        $this->addSql('ALTER TABLE model_car ADD CONSTRAINT FK_22FE8C62563AEBFC FOREIGN KEY (body_design_ulid) REFERENCES body_design (ulid)');
        $this->addSql('ALTER TABLE model_car ADD CONSTRAINT FK_22FE8C62B2122F8 FOREIGN KEY (remark_ulid) REFERENCES remarks (ulid)');
        $this->addSql('ALTER TABLE original_cars ADD CONSTRAINT FK_9FB27622E5EFC2E6 FOREIGN KEY (brand_ulid) REFERENCES brand (ulid) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE original_car DROP FOREIGN KEY FK_2F8F713E5EFC2E6');
        $this->addSql('DROP TABLE original_car');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE original_car (ulid VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, brand_ulid VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, model VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, manufactured_from DATETIME NOT NULL, manufactured_to DATETIME NOT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, performance_ps SMALLINT NOT NULL, performance_kw SMALLINT NOT NULL, INDEX IDX_2F8F713E5EFC2E6 (brand_ulid), PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE original_car ADD CONSTRAINT FK_2F8F713E5EFC2E6 FOREIGN KEY (brand_ulid) REFERENCES brand (ulid) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_car DROP FOREIGN KEY FK_22FE8C622ABD3BE4');
        $this->addSql('ALTER TABLE model_car DROP FOREIGN KEY FK_22FE8C6247C3F996');
        $this->addSql('ALTER TABLE model_car DROP FOREIGN KEY FK_22FE8C62A6F04B09');
        $this->addSql('ALTER TABLE model_car DROP FOREIGN KEY FK_22FE8C626005DACD');
        $this->addSql('ALTER TABLE model_car DROP FOREIGN KEY FK_22FE8C62D1CD30C1');
        $this->addSql('ALTER TABLE model_car DROP FOREIGN KEY FK_22FE8C62563AEBFC');
        $this->addSql('ALTER TABLE model_car DROP FOREIGN KEY FK_22FE8C62B2122F8');
        $this->addSql('ALTER TABLE original_cars DROP FOREIGN KEY FK_9FB27622E5EFC2E6');
        $this->addSql('DROP TABLE body_design');
        $this->addSql('DROP TABLE chassis');
        $this->addSql('DROP TABLE lighting');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP TABLE model_car');
        $this->addSql('DROP TABLE original_cars');
        $this->addSql('DROP TABLE power_conducter');
        $this->addSql('DROP TABLE remarks');
    }
}
