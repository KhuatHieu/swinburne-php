<?php

return "
CREATE TABLE `eoi` (
  `eoi_number` int NOT NULL AUTO_INCREMENT,
  `status` char(255) NOT NULL DEFAULT 'new',
  `job_ref_number` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `suburb` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `skills_critical_thinking` tinyint(1) NOT NULL DEFAULT '0',
  `skills_problem_solving` tinyint(1) NOT NULL DEFAULT '0',
  `skills_leadership` tinyint(1) NOT NULL DEFAULT '0',
  `skills_adaptability` tinyint(1) NOT NULL DEFAULT '0',
  `skills_creativity` tinyint(1) NOT NULL DEFAULT '0',
  `skills_time_management` tinyint(1) NOT NULL DEFAULT '0',
  `skills_other` text,
  PRIMARY KEY (`eoi_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
";