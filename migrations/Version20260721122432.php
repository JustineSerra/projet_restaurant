<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260721122432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id_avis INT AUTO_INCREMENT NOT NULL, note INT NOT NULL, commentaire VARCHAR(300) NOT NULL, date_creation DATETIME NOT NULL, is_approuve TINYINT NOT NULL, id_user INT NOT NULL, INDEX IDX_8F91ABF06B3CA4B (id_user), PRIMARY KEY (id_avis)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE categorie (id_categorie INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(50) NOT NULL, PRIMARY KEY (id_categorie)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE formule (id_formule INT AUTO_INCREMENT NOT NULL, nom_formule VARCHAR(50) NOT NULL, prix_formule NUMERIC(15, 2) NOT NULL, description_formule LONGTEXT NOT NULL, PRIMARY KEY (id_formule)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE formule_plat (id_formule INT NOT NULL, id_plat INT NOT NULL, INDEX IDX_6BA65CA2BEC135E8 (id_formule), INDEX IDX_6BA65CA2AB18BE05 (id_plat), PRIMARY KEY (id_formule, id_plat)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE reservation (id_reservation INT AUTO_INCREMENT NOT NULL, date_heure DATETIME NOT NULL, nb_personnes INT NOT NULL, commentaire VARCHAR(150) NOT NULL, statut VARCHAR(20) NOT NULL, id_user INT NOT NULL, id_table INT NOT NULL, INDEX IDX_42C849556B3CA4B (id_user), INDEX IDX_42C8495518ACCE76 (id_table), PRIMARY KEY (id_reservation)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, nom_role VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `table` (id_table INT AUTO_INCREMENT NOT NULL, numero_table VARCHAR(20) NOT NULL, capacite_table INT NOT NULL, PRIMARY KEY (id_table)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id_user INT AUTO_INCREMENT NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, telephone VARCHAR(20) NOT NULL, role_id INT NOT NULL, INDEX IDX_1D1C63B3D60322AC (role_id), PRIMARY KEY (id_user)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF06B3CA4B FOREIGN KEY (id_user) REFERENCES utilisateur (id_user)');
        $this->addSql('ALTER TABLE formule_plat ADD CONSTRAINT FK_6BA65CA2BEC135E8 FOREIGN KEY (id_formule) REFERENCES formule (id_formule)');
        $this->addSql('ALTER TABLE formule_plat ADD CONSTRAINT FK_6BA65CA2AB18BE05 FOREIGN KEY (id_plat) REFERENCES plat (id_plat)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556B3CA4B FOREIGN KEY (id_user) REFERENCES utilisateur (id_user)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495518ACCE76 FOREIGN KEY (id_table) REFERENCES `table` (id_table)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE plat ADD id_categorie INT NOT NULL');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207C9486A13 FOREIGN KEY (id_categorie) REFERENCES categorie (id_categorie)');
        $this->addSql('CREATE INDEX IDX_2038A207C9486A13 ON plat (id_categorie)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF06B3CA4B');
        $this->addSql('ALTER TABLE formule_plat DROP FOREIGN KEY FK_6BA65CA2BEC135E8');
        $this->addSql('ALTER TABLE formule_plat DROP FOREIGN KEY FK_6BA65CA2AB18BE05');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556B3CA4B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495518ACCE76');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3D60322AC');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE formule');
        $this->addSql('DROP TABLE formule_plat');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE `table`');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A207C9486A13');
        $this->addSql('DROP INDEX IDX_2038A207C9486A13 ON plat');
        $this->addSql('ALTER TABLE plat DROP id_categorie');
    }
}
