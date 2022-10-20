CREATE TABLE `land` (
  `land_id` INT(30) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `land_title` VARCHAR(200) NOT NULL,
  `land_dimension` VARCHAR(200) NOT NULL,
  `land_description` VARCHAR(255) NOT NULL,
  `code` TEXT NOT NULL,
  `land_type` TINYINT(1) NOT NULL DEFAULT 2 COMMENT '1 = Parcelle, 2 = Bassin',
  `avatar` TEXT NOT NULL DEFAULT 'no-image-available.png',
  `date_created` DATETIME NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `activites` (
  `id_act` INT(5) NOT NULL,
  `nom_act` VARCHAR(255) NOT NULL,
);

INSERT INTO `activites` (`id_act`, `nom_act`) VALUES
(1, 'Amenagement'),
(2, 'Désherbage'),
(3, 'Irrigation'),
(4, 'Fertilisation'),
(5, 'Récolte');



create table tache (
	id_tache INT,
	nom VARCHAR(50),
	id_act INT
);
insert into tache (id_tache, nom, id_act) values (1, 'CHANEL PARFUMS BEAUTE', 3);
insert into tache (id_tache, nom, id_act) values (2, '3M ESPE Dental Products', 2);
insert into tache (id_tache, nom, id_act) values (3, 'Akorn - Strides LLC', 3);
insert into tache (id_tache, nom, id_act) values (4, 'Mylan Pharmaceuticals Inc.', 5);
insert into tache (id_tache, nom, id_act) values (5, 'Nelco Laboratories, Inc.', 5);
insert into tache (id_tache, nom, id_act) values (6, 'Rebel Distributors Corp', 5);
insert into tache (id_tache, nom, id_act) values (7, 'Apotheca Company', 4);
insert into tache (id_tache, nom, id_act) values (8, 'bryant ranch prepack', 2);
insert into tache (id_tache, nom, id_act) values (9, 'Gurwitch Products', 5);
insert into tache (id_tache, nom, id_act) values (10, 'Stat Rx USA', 4);
insert into tache (id_tache, nom, id_act) values (11, 'Nelco Laboratories, Inc.', 5);
insert into tache (id_tache, nom, id_act) values (12, 'Ranbaxy Pharmaceuticals Inc.', 5);
insert into tache (id_tache, nom, id_act) values (13, 'Bath & Body Works, Inc.', 1);
insert into tache (id_tache, nom, id_act) values (14, 'Macoven Pharmaceuticals', 5);
insert into tache (id_tache, nom, id_act) values (15, 'B. Braun Medical Inc.', 3);
insert into tache (id_tache, nom, id_act) values (16, 'CareFusion 213 LLC', 5);
insert into tache (id_tache, nom, id_act) values (17, 'US Pharmaceutical Corporation', 5);
insert into tache (id_tache, nom, id_act) values (18, 'Jubilant DraxImage Inc.', 3);
insert into tache (id_tache, nom, id_act) values (19, 'Enemeez Inc. DBA Summit Pharmaceuticals', 5);
insert into tache (id_tache, nom, id_act) values (20, 'AvKARE, Inc.', 2);
insert into tache (id_tache, nom, id_act) values (21, 'Roerig', 5);
insert into tache (id_tache, nom, id_act) values (22, 'Guna spa', 1);
insert into tache (id_tache, nom, id_act) values (23, 'Deseret Biologicals, Inc.', 2);
insert into tache (id_tache, nom, id_act) values (24, 'USPharmaCo', 2);
insert into tache (id_tache, nom, id_act) values (25, 'Ningbo Pulisi Daily Chemical Products Co.,Ltd.', 3);
insert into tache (id_tache, nom, id_act) values (26, 'TYA Pharmaceuticals', 1);
insert into tache (id_tache, nom, id_act) values (27, 'Cardinal Health', 1);
insert into tache (id_tache, nom, id_act) values (28, 'Pure Source', 4);
insert into tache (id_tache, nom, id_act) values (29, 'Physicians Total Care, Inc.', 2);
insert into tache (id_tache, nom, id_act) values (30, 'NATURE REPUBLIC CO., LTD.', 1);
insert into tache (id_tache, nom, id_act) values (31, 'Eon Labs, Inc.', 3);
insert into tache (id_tache, nom, id_act) values (32, 'Aurobindo Pharma Limited', 3);
insert into tache (id_tache, nom, id_act) values (33, 'Amsino International, Inc.', 3);
insert into tache (id_tache, nom, id_act) values (34, 'Herbion Pakistan (Pvt.) Ltd.', 3);
insert into tache (id_tache, nom, id_act) values (35, 'McNeil Consumer Pharmaceuticals Co.', 2);
insert into tache (id_tache, nom, id_act) values (36, 'Nelco Laboratories, Inc.', 4);
insert into tache (id_tache, nom, id_act) values (37, 'Rebel Distributors Corp.', 4);
insert into tache (id_tache, nom, id_act) values (38, 'SAM''S WEST INC.', 3);
insert into tache (id_tache, nom, id_act) values (39, 'Trigen Laboratories, LLC', 3);
insert into tache (id_tache, nom, id_act) values (40, 'STAT Rx USA LLC', 3);
insert into tache (id_tache, nom, id_act) values (41, 'Bryant Ranch Prepack', 4);
insert into tache (id_tache, nom, id_act) values (42, 'ProPhase Labs, Inc.', 2);
insert into tache (id_tache, nom, id_act) values (43, 'Perrigo New York Inc', 3);
insert into tache (id_tache, nom, id_act) values (44, 'REMEDYREPACK INC.', 4);
insert into tache (id_tache, nom, id_act) values (45, 'Wockhardt Limited', 5);
insert into tache (id_tache, nom, id_act) values (46, 'Mylan Institutional LLC', 2);
insert into tache (id_tache, nom, id_act) values (47, 'Precision Dose Inc.', 3);
insert into tache (id_tache, nom, id_act) values (48, 'Nash-Finch Company', 4);
insert into tache (id_tache, nom, id_act) values (49, 'Certus Medical, Inc.', 4);
insert into tache (id_tache, nom, id_act) values (50, 'Precision Dose Inc.', 3);
insert into tache (id_tache, nom, id_act) values (51, 'Heritage Pharmaceuticals Inc.', 1);
insert into tache (id_tache, nom, id_act) values (52, 'Deb USA, Inc.', 5);
insert into tache (id_tache, nom, id_act) values (53, 'Sun Pharma Global FZE', 2);
insert into tache (id_tache, nom, id_act) values (54, 'Aurobindo Pharma Limited', 1);
insert into tache (id_tache, nom, id_act) values (55, 'Insight Pharmaceuticals', 4);
insert into tache (id_tache, nom, id_act) values (56, 'WOCKHARDT USA LLC.', 3);
insert into tache (id_tache, nom, id_act) values (57, 'Ducere Pharma LLC', 1);
insert into tache (id_tache, nom, id_act) values (58, 'Topco Associates LLC', 1);
insert into tache (id_tache, nom, id_act) values (59, 'REMEDYREPACK INC.', 3);
insert into tache (id_tache, nom, id_act) values (60, 'Mylan Institutional Inc.', 1);
insert into tache (id_tache, nom, id_act) values (61, 'NOEVIR USA INC', 3);
insert into tache (id_tache, nom, id_act) values (62, 'Uriel Pharmacy Inc.', 1);
insert into tache (id_tache, nom, id_act) values (63, 'Cardinal Health', 1);
insert into tache (id_tache, nom, id_act) values (64, 'Aphena Pharma Solutions - Tennessee, Inc.', 1);
insert into tache (id_tache, nom, id_act) values (65, 'Dispensing Solutions, Inc.', 4);
insert into tache (id_tache, nom, id_act) values (66, 'Precision Nuclear LLC', 4);
insert into tache (id_tache, nom, id_act) values (67, 'Healthy Accents (DZA Brands, LLC)', 1);
insert into tache (id_tache, nom, id_act) values (68, 'REMEDYREPACK INC.', 1);
insert into tache (id_tache, nom, id_act) values (69, 'SJ Creations, Inc.', 1);
insert into tache (id_tache, nom, id_act) values (70, 'Watson Laboratories, Inc.', 5);
insert into tache (id_tache, nom, id_act) values (71, 'P.S.W. INC.', 1);
insert into tache (id_tache, nom, id_act) values (72, 'Jubilant HollisterStier LLC', 1);
insert into tache (id_tache, nom, id_act) values (73, 'Cadila Pharmaceuticals Limited', 4);
insert into tache (id_tache, nom, id_act) values (74, 'ESTEE LAUDER INC', 1);
insert into tache (id_tache, nom, id_act) values (75, 'Lake Erie Medical DBA Quality Care Products LLC', 5);
insert into tache (id_tache, nom, id_act) values (76, 'Publix', 5);
insert into tache (id_tache, nom, id_act) values (77, 'Bryant Ranch Prepack', 1);
insert into tache (id_tache, nom, id_act) values (78, 'Prest-O-Sales & Service Inc', 5);
insert into tache (id_tache, nom, id_act) values (79, 'Physicians Total Care, Inc.', 1);
insert into tache (id_tache, nom, id_act) values (80, 'Pharmacia and Upjohn Company', 5);
insert into tache (id_tache, nom, id_act) values (81, 'ScripsAmerica', 5);
insert into tache (id_tache, nom, id_act) values (82, 'Lehigh Valley Respiratory Care, Lancaster', 4);
insert into tache (id_tache, nom, id_act) values (83, 'Hospira, Inc.', 5);
insert into tache (id_tache, nom, id_act) values (84, 'Time-Cap Labs, Inc', 4);
insert into tache (id_tache, nom, id_act) values (85, 'Wakefern Food Corp', 1);
insert into tache (id_tache, nom, id_act) values (86, 'Geri-Care Pharmaceuticals, Corp', 1);
insert into tache (id_tache, nom, id_act) values (87, 'HyVee Inc', 1);
insert into tache (id_tache, nom, id_act) values (88, 'China Ningbo Shangge Cosmetic Technology Corp.', 2);
insert into tache (id_tache, nom, id_act) values (89, 'Apotheca Company', 4);
insert into tache (id_tache, nom, id_act) values (90, 'SHISEIDO CO., LTD.', 3);
insert into tache (id_tache, nom, id_act) values (91, 'Amneal Pharmaceuticals of New York, LLC', 3);
insert into tache (id_tache, nom, id_act) values (92, 'Best Choice (Valu Merchandisers Company)', 3);
insert into tache (id_tache, nom, id_act) values (93, 'TYA Pharmaceuticals', 1);
insert into tache (id_tache, nom, id_act) values (94, 'St Marys Medical Park Pharmacy', 3);
insert into tache (id_tache, nom, id_act) values (95, 'Winthrop U.S.', 2);
insert into tache (id_tache, nom, id_act) values (96, 'Inel Cosmetics Co., Ltd', 5);
insert into tache (id_tache, nom, id_act) values (97, 'Nash Finch', 4);
insert into tache (id_tache, nom, id_act) values (98, 'Nova Homeopathic Therapeutics, Inc.', 1);
insert into tache (id_tache, nom, id_act) values (99, 'Chain Drug Marketing Association', 1);
insert into tache (id_tache, nom, id_act) values (100, 'ARMY AND AIR FORCE EXCHANGE SERVICE', 2);