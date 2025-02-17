-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 17 fév. 2025 à 15:06
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `c2i`
--
CREATE DATABASE IF NOT EXISTS `c2i` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `c2i`;

-- --------------------------------------------------------

--
-- Structure de la table `categ_vessels`
--

DROP TABLE IF EXISTS `categ_vessels`;
CREATE TABLE IF NOT EXISTS `categ_vessels` (
  `cat` int NOT NULL AUTO_INCREMENT,
  `name_categ` varchar(50) NOT NULL,
  PRIMARY KEY (`cat`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `categ_vessels`
--

INSERT INTO `categ_vessels` (`cat`, `name_categ`) VALUES
(1, 'LNG'),
(2, 'LPG'),
(3, 'Chemical'),
(4, 'Oil / Chemical');

-- --------------------------------------------------------

--
-- Structure de la table `ports`
--

DROP TABLE IF EXISTS `ports`;
CREATE TABLE IF NOT EXISTS `ports` (
  `id_port` int NOT NULL AUTO_INCREMENT,
  `code_port` varchar(20) NOT NULL,
  `name_port` varchar(50) NOT NULL,
  `eu_uk_mrv` enum('EU','UK','non_mrv') NOT NULL,
  PRIMARY KEY (`id_port`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ports`
--

INSERT INTO `ports` (`id_port`, `code_port`, `name_port`, `eu_uk_mrv`) VALUES
(1, 'DZAZW', 'ARZEW', 'non_mrv'),
(2, 'DZORN', 'ORAN', 'non_mrv'),
(3, 'DZSKD', 'SKIKDA', 'non_mrv'),
(4, 'FRFOS', 'FOS', 'EU'),
(5, 'TRMAR', 'MARMARA', 'EU');

-- --------------------------------------------------------

--
-- Structure de la table `reports_arrival`
--

DROP TABLE IF EXISTS `reports_arrival`;
CREATE TABLE IF NOT EXISTS `reports_arrival` (
  `ra` int NOT NULL AUTO_INCREMENT,
  `usr` int NOT NULL,
  `vs` int NOT NULL,
  `id_trv` int NOT NULL,
  `arr_calltype` int NOT NULL,
  `arr_comp_dcs_voy_number` varchar(225) NOT NULL,
  `arr_arrival_port` int NOT NULL,
  `arr_eu_uk` enum('EU','UK','non_mrv_port') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'EU',
  `arr_fwe_date` date NOT NULL,
  `arr_fwe_local_time` varchar(5) NOT NULL DEFAULT '00:00',
  `arr_fwe_time_zone` varchar(5) NOT NULL,
  `arr_gps_trip` double NOT NULL,
  `arr_speed_log` double NOT NULL,
  `sosp_start_date` date NOT NULL,
  `sosp_local_time` varchar(5) NOT NULL DEFAULT '00:00',
  `sosp_time_zone` varchar(5) NOT NULL,
  `sosp_gps_trip` double NOT NULL,
  `sosp_speed_log` double NOT NULL,
  `sosp_lsfo` double NOT NULL,
  `sosp_ulsfo` double NOT NULL,
  `sosp_mgo` double NOT NULL,
  `sosp_lng_ctms` double NOT NULL,
  `weath_force` int NOT NULL,
  `weath_sea_state` double NOT NULL,
  `weath_hours_wind` int NOT NULL,
  `fg_boilers` double NOT NULL,
  `fg_dfde1` double NOT NULL,
  `fg_dfde2` double NOT NULL,
  `fg_dfde3` double NOT NULL,
  `fg_dfde4` double NOT NULL,
  `fg_gcu` double NOT NULL,
  `fg_vapour` double NOT NULL,
  `eosp_date` date NOT NULL,
  `oesp_local_time` varchar(5) NOT NULL DEFAULT '00:00',
  `oesp_time_zone` varchar(5) NOT NULL,
  `oesp_gps_trip` double NOT NULL,
  `oesp_speed_log` double NOT NULL,
  `oesp_lsfo` double NOT NULL,
  `oesp_ulsfo` double NOT NULL,
  `oesp_mgo` double NOT NULL,
  `oesp_lng_ctms` double NOT NULL,
  `fwe_lsfo` double NOT NULL,
  `fwe_ulsfo` double NOT NULL,
  `fwe_mgo` double NOT NULL,
  `fwe_lng_ctms` double NOT NULL,
  `fwe_lo` double NOT NULL,
  `propulsion_stbd` double NOT NULL,
  `propulsion_revo` double NOT NULL,
  `drift_total_distance` double NOT NULL,
  `drift_time_adrift` int NOT NULL,
  `anchor_date` date NOT NULL,
  `anchor_local_time` varchar(5) NOT NULL DEFAULT '00:00',
  `anchor_time_zone` varchar(5) NOT NULL,
  `anchor_gps_trip` double NOT NULL,
  `anchor_up_date` date NOT NULL,
  `anchor_up_local_time` varchar(5) NOT NULL DEFAULT '00:00',
  `anchor_up_time_zone` varchar(5) NOT NULL,
  `anchor_up_gps_trip` int NOT NULL,
  `total_percent` int NOT NULL,
  `report_status` enum('in_progress','completed','approuved') NOT NULL,
  PRIMARY KEY (`ra`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `reports_arrival`
--

INSERT INTO `reports_arrival` (`ra`, `usr`, `vs`, `id_trv`, `arr_calltype`, `arr_comp_dcs_voy_number`, `arr_arrival_port`, `arr_eu_uk`, `arr_fwe_date`, `arr_fwe_local_time`, `arr_fwe_time_zone`, `arr_gps_trip`, `arr_speed_log`, `sosp_start_date`, `sosp_local_time`, `sosp_time_zone`, `sosp_gps_trip`, `sosp_speed_log`, `sosp_lsfo`, `sosp_ulsfo`, `sosp_mgo`, `sosp_lng_ctms`, `weath_force`, `weath_sea_state`, `weath_hours_wind`, `fg_boilers`, `fg_dfde1`, `fg_dfde2`, `fg_dfde3`, `fg_dfde4`, `fg_gcu`, `fg_vapour`, `eosp_date`, `oesp_local_time`, `oesp_time_zone`, `oesp_gps_trip`, `oesp_speed_log`, `oesp_lsfo`, `oesp_ulsfo`, `oesp_mgo`, `oesp_lng_ctms`, `fwe_lsfo`, `fwe_ulsfo`, `fwe_mgo`, `fwe_lng_ctms`, `fwe_lo`, `propulsion_stbd`, `propulsion_revo`, `drift_total_distance`, `drift_time_adrift`, `anchor_date`, `anchor_local_time`, `anchor_time_zone`, `anchor_gps_trip`, `anchor_up_date`, `anchor_up_local_time`, `anchor_up_time_zone`, `anchor_up_gps_trip`, `total_percent`, `report_status`) VALUES
(1, 1, 2, 4, 2, '', 0, 'EU', '2024-03-19', '10:56', '+1', 123, 456, '2024-03-20', '12:37', '0', 1, 2, 3, 4444, 55555, 66666, 1, 1, 4, 11111, 22222, 3333, 4444, 5555, 66666, 77777777777, '2024-03-20', '12:14', '+1', 1111, 22, 33, 44, 55, 66, 4, 3, 8, 2, 1, 55, 66, 654, 852, '2024-03-20', '14:58', '+1', 52, '2024-03-21', '15:29', '+1', 53, 0, 'in_progress');

-- --------------------------------------------------------

--
-- Structure de la table `reports_bunkering`
--

DROP TABLE IF EXISTS `reports_bunkering`;
CREATE TABLE IF NOT EXISTS `reports_bunkering` (
  `rb` int NOT NULL AUTO_INCREMENT,
  `usr` int NOT NULL,
  `vs` int NOT NULL,
  `id_trv` int NOT NULL,
  `bunkdebunk_vessel_status` int NOT NULL,
  `bunkdebunk_id_port` int NOT NULL,
  `bunkdebunk_start_transfert_date` date NOT NULL,
  `bunkdebunk_start_transfert_time` varchar(5) NOT NULL DEFAULT '00:00',
  `bunkdebunk_start_transfert_time_zone` varchar(5) NOT NULL,
  `bunkdebunk_end_transfert_date` date NOT NULL,
  `bunkdebunk_end_transfert_time` varchar(5) NOT NULL DEFAULT '00:00',
  `bunkdebunk_end_transfert_timezone` varchar(5) NOT NULL,
  `comptrans_lsfo` double NOT NULL,
  `comptrans_ulsfo` double NOT NULL,
  `comptrans_mgo` double NOT NULL,
  `recidis_operation` enum('Bunkering','Debunkering') NOT NULL DEFAULT 'Bunkering',
  `recidis_lsfo` double NOT NULL,
  `recidis_ulsfo` double NOT NULL,
  `recidis_mgo` double NOT NULL,
  `total_percent` int NOT NULL,
  `report_status` enum('in_progress','submited','completed','approuved','rejected') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'in_progress',
  PRIMARY KEY (`rb`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `reports_bunkering`
--

INSERT INTO `reports_bunkering` (`rb`, `usr`, `vs`, `id_trv`, `bunkdebunk_vessel_status`, `bunkdebunk_id_port`, `bunkdebunk_start_transfert_date`, `bunkdebunk_start_transfert_time`, `bunkdebunk_start_transfert_time_zone`, `bunkdebunk_end_transfert_date`, `bunkdebunk_end_transfert_time`, `bunkdebunk_end_transfert_timezone`, `comptrans_lsfo`, `comptrans_ulsfo`, `comptrans_mgo`, `recidis_operation`, `recidis_lsfo`, `recidis_ulsfo`, `recidis_mgo`, `total_percent`, `report_status`) VALUES
(2, 1, 2, 4, 1, 1, '2024-02-02', '08:56', '+1', '2024-02-03', '12:03', '+1', 7, 8, 9, 'Bunkering', 77, 7532, 456, 0, 'in_progress');

-- --------------------------------------------------------

--
-- Structure de la table `reports_departure`
--

DROP TABLE IF EXISTS `reports_departure`;
CREATE TABLE IF NOT EXISTS `reports_departure` (
  `rd` int NOT NULL AUTO_INCREMENT,
  `usr` int NOT NULL,
  `vs` int NOT NULL,
  `id_trv` int NOT NULL,
  `depdata_type` int DEFAULT NULL,
  `depdata_eu_uk_mrv` int NOT NULL,
  `depdata_date` date NOT NULL,
  `depdata_local_time` varchar(5) NOT NULL DEFAULT '00:00',
  `depdata_time_zone` varchar(5) NOT NULL,
  `depdata_gps_trip` int NOT NULL,
  `depdata_speed_log_trip` int NOT NULL,
  `depdata_type_cargo1` int NOT NULL,
  `depdata_type_cargo2` int NOT NULL,
  `depdata_total_volume_lng` int NOT NULL,
  `depdata_total_cargo_onboard` int NOT NULL,
  `weath_wind_force` int NOT NULL,
  `weath_sea_state` int NOT NULL,
  `weath_bfrt` int NOT NULL,
  `fg_toboilers` double NOT NULL,
  `fg_dfde1` double NOT NULL,
  `fg_dfde2` double NOT NULL,
  `fg_dfde3` double NOT NULL,
  `fg_dfde4` double NOT NULL,
  `fg_gcu` double NOT NULL,
  `fg_vapour_mast` double NOT NULL,
  `lsfo` double NOT NULL,
  `ulsfo` double NOT NULL,
  `mgo` double NOT NULL,
  `lng_ctms` double NOT NULL,
  `lo` int NOT NULL,
  `propulsion_stbd` double NOT NULL,
  `propulsion_revo` double NOT NULL,
  `voyplan_eta` date NOT NULL,
  `voyplan_distancetogo` double NOT NULL,
  `total_percent` int NOT NULL,
  `report_status` enum('in_progress','completed','approuved') NOT NULL,
  PRIMARY KEY (`rd`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `reports_departure`
--

INSERT INTO `reports_departure` (`rd`, `usr`, `vs`, `id_trv`, `depdata_type`, `depdata_eu_uk_mrv`, `depdata_date`, `depdata_local_time`, `depdata_time_zone`, `depdata_gps_trip`, `depdata_speed_log_trip`, `depdata_type_cargo1`, `depdata_type_cargo2`, `depdata_total_volume_lng`, `depdata_total_cargo_onboard`, `weath_wind_force`, `weath_sea_state`, `weath_bfrt`, `fg_toboilers`, `fg_dfde1`, `fg_dfde2`, `fg_dfde3`, `fg_dfde4`, `fg_gcu`, `fg_vapour_mast`, `lsfo`, `ulsfo`, `mgo`, `lng_ctms`, `lo`, `propulsion_stbd`, `propulsion_revo`, `voyplan_eta`, `voyplan_distancetogo`, `total_percent`, `report_status`) VALUES
(1, 1, 2, 4, 2, 2, '2023-12-22', '14:05', '+1', 56329, 5552448, 2, 8, 5263523, 1112223, 5, 7, 7, 123, 456, 785, 196, 5, 588, 552, 123, 456, 789, 111, 555, 12399, 456852, '2024-01-30', 8529, 0, 'in_progress');

-- --------------------------------------------------------

--
-- Structure de la table `reports_noon`
--

DROP TABLE IF EXISTS `reports_noon`;
CREATE TABLE IF NOT EXISTS `reports_noon` (
  `nr` int NOT NULL AUTO_INCREMENT,
  `usr` int NOT NULL,
  `vs` int NOT NULL,
  `id_trv` int NOT NULL,
  `master` int NOT NULL,
  `date_redaction` datetime NOT NULL,
  `vessel_status` int NOT NULL,
  `voyage_ref` varchar(150) NOT NULL,
  `dcs_voy_dcs` varchar(50) NOT NULL,
  `port_destination` int NOT NULL,
  `date_noon` date NOT NULL,
  `local_time` varchar(5) NOT NULL DEFAULT '00:00',
  `time_zone` varchar(50) NOT NULL,
  `latitude` varchar(12) NOT NULL,
  `longitude` varchar(12) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `course` varchar(3) NOT NULL,
  `speed` double NOT NULL,
  `gps_trip` int NOT NULL,
  `distance` int NOT NULL,
  `speed_log` int NOT NULL,
  `sosp_date` date NOT NULL,
  `sosp_local_time` varchar(5) NOT NULL DEFAULT '00:00',
  `sosp_time_zone` varchar(50) NOT NULL,
  `sosp_gps_trip` int NOT NULL,
  `sosp_speed_log` int NOT NULL,
  `sosp_lsfo` double NOT NULL,
  `sosp_ulsfo` double NOT NULL,
  `sosp_mgo` double NOT NULL,
  `sosp_lng_ctms` double NOT NULL,
  `wind` int NOT NULL,
  `sea_state` int NOT NULL,
  `hours_wind` int NOT NULL,
  `tank1_temp_p` double NOT NULL,
  `tank1_temp_s` double NOT NULL,
  `tank2_temp_p` double NOT NULL,
  `tank2_temp_s` double NOT NULL,
  `tank3_temp_p` double NOT NULL,
  `tank3_temp_s` double NOT NULL,
  `tank4_temp_p` double NOT NULL,
  `tank4_temp_s` double NOT NULL,
  `tank1_pres_p` double NOT NULL,
  `tank1_pres_s` double NOT NULL,
  `tank2_pres_p` double NOT NULL,
  `tank2_pres_s` double NOT NULL,
  `tank3_pres_p` double NOT NULL,
  `tank3_pres_s` double NOT NULL,
  `tank4_pres_p` double NOT NULL,
  `tank4_pres_s` double NOT NULL,
  `eosp_date` date NOT NULL,
  `eosp_local_time` varchar(5) NOT NULL DEFAULT '00:00',
  `oesp_time_zone` varchar(50) NOT NULL,
  `oesp_gps_trip` int NOT NULL,
  `oesp_speed_log` int NOT NULL,
  `oesp_lsfo` double NOT NULL,
  `oesp_ulsfo` double NOT NULL,
  `oesp_mgo` double NOT NULL,
  `oesp_lng_ctms` double NOT NULL,
  `noon_lsfo` double NOT NULL,
  `noon_ulsfo` double NOT NULL,
  `noon_mgo` double NOT NULL,
  `noon_lng_ctms` double NOT NULL,
  `noon_lo` int NOT NULL,
  `propdata_rpm_at_noon` int NOT NULL,
  `propdata_prc_stbd` varchar(200) NOT NULL,
  `propdata_prc_port` varchar(200) NOT NULL,
  `eta_date` date NOT NULL,
  `eta_local_time` varchar(5) NOT NULL DEFAULT '00:00',
  `eta_time_zone` varchar(50) NOT NULL,
  `dad_port` int NOT NULL,
  `dad_da_date` date NOT NULL,
  `dad_local_time` varchar(5) NOT NULL DEFAULT '00:00',
  `dad_time_zone` varchar(50) NOT NULL,
  `dad_gps_trip` int NOT NULL,
  `aud_date` date NOT NULL,
  `aud_local_time` varchar(5) NOT NULL DEFAULT '00:00',
  `aud_time_zone` varchar(50) NOT NULL,
  `aud_gps_trip` int NOT NULL,
  `report_status` enum('in_progress','submited','rejected','approuved') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'in_progress',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `reports_noon`
--

INSERT INTO `reports_noon` (`nr`, `usr`, `vs`, `id_trv`, `master`, `date_redaction`, `vessel_status`, `voyage_ref`, `dcs_voy_dcs`, `port_destination`, `date_noon`, `local_time`, `time_zone`, `latitude`, `longitude`, `course`, `speed`, `gps_trip`, `distance`, `speed_log`, `sosp_date`, `sosp_local_time`, `sosp_time_zone`, `sosp_gps_trip`, `sosp_speed_log`, `sosp_lsfo`, `sosp_ulsfo`, `sosp_mgo`, `sosp_lng_ctms`, `wind`, `sea_state`, `hours_wind`, `tank1_temp_p`, `tank1_temp_s`, `tank2_temp_p`, `tank2_temp_s`, `tank3_temp_p`, `tank3_temp_s`, `tank4_temp_p`, `tank4_temp_s`, `tank1_pres_p`, `tank1_pres_s`, `tank2_pres_p`, `tank2_pres_s`, `tank3_pres_p`, `tank3_pres_s`, `tank4_pres_p`, `tank4_pres_s`, `eosp_date`, `eosp_local_time`, `oesp_time_zone`, `oesp_gps_trip`, `oesp_speed_log`, `oesp_lsfo`, `oesp_ulsfo`, `oesp_mgo`, `oesp_lng_ctms`, `noon_lsfo`, `noon_ulsfo`, `noon_mgo`, `noon_lng_ctms`, `noon_lo`, `propdata_rpm_at_noon`, `propdata_prc_stbd`, `propdata_prc_port`, `eta_date`, `eta_local_time`, `eta_time_zone`, `dad_port`, `dad_da_date`, `dad_local_time`, `dad_time_zone`, `dad_gps_trip`, `aud_date`, `aud_local_time`, `aud_time_zone`, `aud_gps_trip`, `report_status`) VALUES
(1, 1, 2, 4, 1, '2024-01-23 09:02:07', 2, '523365', '885632', 3, '2024-01-25', '13:56', '+4', '-0.3528', '+1.6587', '0', 0, 523, 0, 0, '2024-01-25', '14:41', '+2', 1, 2, 3, 4, 5, 6, 1, 3, 4, 11, 12, 21, 22, 31, 32, 417, 42, 110, 120, 210, 220, 310, 320, 410, 420, '2024-01-28', '17:08', '+6', 1, 2, 3, 4, 5, 6, 5, 4, 6, 2, 1, 99875, '8775', '668', '2024-01-31', '11:53', '+2', 0, '2024-01-30', '14:41', '+11', 55, '2024-01-29', '08:53', '+12', 997, 'in_progress');

-- --------------------------------------------------------

--
-- Structure de la table `ro`
--

DROP TABLE IF EXISTS `ro`;
CREATE TABLE IF NOT EXISTS `ro` (
  `id_ro` int NOT NULL AUTO_INCREMENT,
  `ro` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ro`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ro`
--

INSERT INTO `ro` (`id_ro`, `ro`) VALUES
(1, 'BV'),
(2, 'OTHER');

-- --------------------------------------------------------

--
-- Structure de la table `type_call`
--

DROP TABLE IF EXISTS `type_call`;
CREATE TABLE IF NOT EXISTS `type_call` (
  `tcl` int NOT NULL AUTO_INCREMENT,
  `type_tcl_name` varchar(150) NOT NULL,
  PRIMARY KEY (`tcl`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `type_call`
--

INSERT INTO `type_call` (`tcl`, `type_tcl_name`) VALUES
(1, 'Bunkering'),
(2, 'Cargo Operations Berth'),
(3, 'Cargo Operations STS'),
(4, 'Repairs/Drydock'),
(5, 'Shelter/Refuge'),
(6, 'Other');

-- --------------------------------------------------------

--
-- Structure de la table `type_cargo`
--

DROP TABLE IF EXISTS `type_cargo`;
CREATE TABLE IF NOT EXISTS `type_cargo` (
  `tc` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(150) NOT NULL,
  PRIMARY KEY (`tc`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `type_cargo`
--

INSERT INTO `type_cargo` (`tc`, `type_name`) VALUES
(1, 'Amonia'),
(2, 'Bitumen'),
(3, 'Butane'),
(4, 'Diesel Oil'),
(5, 'Fuel Oil'),
(6, 'Gasoline'),
(7, 'Kerosene'),
(8, 'Methane'),
(9, 'Propane'),
(10, 'Other');

-- --------------------------------------------------------

--
-- Structure de la table `vessels`
--

DROP TABLE IF EXISTS `vessels`;
CREATE TABLE IF NOT EXISTS `vessels` (
  `vs` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cat` int NOT NULL,
  `flag` int NOT NULL,
  `imo_number` varchar(225) NOT NULL,
  `class` varchar(100) NOT NULL,
  `capacity` varchar(100) NOT NULL,
  `prop_kw` varchar(100) NOT NULL,
  `lht` varchar(100) NOT NULL,
  `grt` varchar(50) NOT NULL,
  `nrt` varchar(50) NOT NULL,
  `dwt` varchar(50) NOT NULL,
  `crew` int NOT NULL,
  `showit` enum('0','1') NOT NULL DEFAULT '1',
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`vs`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `vessels`
--

INSERT INTO `vessels` (`vs`, `name`, `cat`, `flag`, `imo_number`, `class`, `capacity`, `prop_kw`, `lht`, `grt`, `nrt`, `dwt`, `crew`, `showit`, `deleted`) VALUES
(1, 'OUGARTA', 1, 1, '9761267', 'Lloyd\'s Register', '171 800', '27 780', '291.5', '112 867', '35 325', '94 575', 32, '1', '0'),
(2, 'TESSALA', 1, 1, '9761243', 'Lloyd\'s Register', '171 800', '27 780', '291.5', '112 867', '35 325', '94 575', 32, '1', '0'),
(3, 'LALLA FATMA N\'SOUMER', 1, 2, '9275347', 'Breau Veritas', '145 445', 'ST / 26 496', '289.5', '118 363', '35 508', '80 920', 31, '1', '0'),
(4, 'CHEIKH BOUAMAMA', 1, 2, '9324344', 'Bureau Veritas', '75 500', 'ST / 13 500', '220', '53 500', '16 050', '44 250', 28, '1', '0'),
(5, 'CHEIKH EL MOKRANI', 1, 2, '9324332', 'Bureau Veritas', '75 500', 'ST / 13 500', '220', '53 500', '16 050', '44 250', 28, '1', '0'),
(6, 'BERGA II', 2, 1, '9537032', 'Lloyd\'s Register', '35 000', 'DM / 9 960', '174.2', '23 059', '6 917', '22 450', 32, '1', '0'),
(7, 'RHOURD EL FARES', 2, 1, '9537044', 'Lloyd\'s Register', '35 500', 'DM / 9 960', '174.2', '23 059', '6 914', '22 450', 32, '1', '0'),
(8, 'RHOURD EL ADRA', 2, 1, '9320855', 'Bureau Veritas', '22 500', 'DM / 7 280', '156', '16 800', '5 100', '19 400', 30, '1', '0'),
(9, 'RHOURD EL HAMRA', 2, 1, '9337793', 'Bureau Veritas', '22 500', 'DM / 7 280', '156', '16 800', '5 100', '19 400', 30, '1', '0'),
(10, 'HASSI BERKINE', 2, 1, '9809045', 'Bureau Veritas', '13 000', 'DM / 4 920', '146.2', '12 293', '3 687', '9 500', 23, '1', '0'),
(11, 'HASSI TOUAREG', 2, 1, '9853577', 'Bureau Veritas', '13 000', 'DM / 4 920', '146.2', '12 293', '3 687', '9 500', 23, '1', '0'),
(12, 'AIN ZEFT', 3, 1, '9265380', 'Germanischer / Lloyd\'s Register', '4 577', 'DM / 2 880', '108.5', '4 243', '1 273', '4 999', 17, '1', '0'),
(13, 'RAS TOMB', 3, 1, '9265392', 'Germanischer / Lloyd\'s Register', '4 577', 'DM / 2 880', '108.5', '4 243', '1 273', '4 999', 17, '1', '0'),
(14, 'In Ecker', 4, 1, '9861483', 'Bureau Veritas', '46 500', 'DM / 8590', '183.06', '26 371', '10 176', '39 971', 24, '1', '0');

-- --------------------------------------------------------

--
-- Structure de la table `vessels_status`
--

DROP TABLE IF EXISTS `vessels_status`;
CREATE TABLE IF NOT EXISTS `vessels_status` (
  `vsst` int NOT NULL AUTO_INCREMENT,
  `vsst_title` varchar(150) NOT NULL,
  PRIMARY KEY (`vsst`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `vessels_status`
--

INSERT INTO `vessels_status` (`vsst`, `vsst_title`) VALUES
(1, 'At Anchor'),
(2, 'At Berth'),
(3, 'Ballast sea passage'),
(4, 'Channel transit'),
(5, 'Laden sea passage'),
(6, 'Waiting-adrift'),
(7, 'Waiting berth-laden'),
(8, 'Waiting berth-OnBallast');

-- --------------------------------------------------------

--
-- Structure de la table `voyages`
--

DROP TABLE IF EXISTS `voyages`;
CREATE TABLE IF NOT EXISTS `voyages` (
  `id_trv` int NOT NULL AUTO_INCREMENT,
  `usr` int NOT NULL,
  `vs` int NOT NULL,
  `num_trv` int NOT NULL,
  `dcs_number` int NOT NULL,
  `date_departure` date NOT NULL,
  `time_departure` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '00:00',
  `time_zone_departure` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `date_arrival` date NOT NULL,
  `time_arrival` time NOT NULL,
  `time_zone_arrival` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_port_depart` int NOT NULL,
  `id_port_arrival` int NOT NULL,
  `crg_op` enum('Y','N') NOT NULL DEFAULT 'N',
  `eu` enum('Y','N') NOT NULL DEFAULT 'N',
  `uk` enum('Y','N') NOT NULL DEFAULT 'N',
  `cii_rate_letter` enum('NONE','A','B','C','D','E') NOT NULL DEFAULT 'NONE',
  `cii_rate_score` double NOT NULL,
  `status` enum('in_progress','canceled','completed') NOT NULL DEFAULT 'in_progress',
  PRIMARY KEY (`id_trv`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `voyages`
--

INSERT INTO `voyages` (`id_trv`, `usr`, `vs`, `num_trv`, `dcs_number`, `date_departure`, `time_departure`, `time_zone_departure`, `date_arrival`, `time_arrival`, `time_zone_arrival`, `id_port_depart`, `id_port_arrival`, `crg_op`, `eu`, `uk`, `cii_rate_letter`, `cii_rate_score`, `status`) VALUES
(1, 1, 2, 120, 0, '0000-00-00', '00:00', '', '2023-11-08', '15:54:00', '3', 3, 2, 'N', 'N', 'N', 'C', 0, 'in_progress'),
(2, 1, 2, 123, 456, '2023-12-18', '11:30', '+2', '0000-00-00', '00:00:00', '', 3, 2, 'N', 'N', 'N', 'B', 0, 'in_progress'),
(3, 1, 2, 852, 654, '2023-12-19', '09:57', '+6', '0000-00-00', '00:00:00', '', 3, 2, 'N', 'N', 'N', 'D', 0, 'in_progress'),
(4, 1, 2, 55562, 4566325, '2023-12-20', '15:05', '+1', '0000-00-00', '00:00:00', '', 4, 1, 'N', 'N', 'N', 'A', 0, 'in_progress'),
(5, 0, 0, 0, 5, '0000-00-00', '1850', '100', '0000-00-00', '00:00:00', '', 0, 0, 'N', 'N', 'N', 'NONE', 0, 'in_progress'),
(6, 0, 0, 0, 5, '0000-00-00', '1850', '100', '0000-00-00', '00:00:00', '', 0, 0, 'N', 'N', 'N', 'NONE', 0, 'in_progress'),
(7, 0, 0, 0, 5, '2025-02-01', '1850', '100', '0000-00-00', '00:00:00', '', 0, 0, 'N', 'N', 'N', 'NONE', 0, 'in_progress');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
