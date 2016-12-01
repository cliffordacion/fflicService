#backend_users
CREATE TABLE `backend_users`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

ALTER TABLE
  `backend_users` ADD UNIQUE `backend_users_email_unique`(`email`);


#frontend_users
  CREATE TABLE `frontend_users`(
  `id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `course` VARCHAR(255) NOT NULL,
  `college` VARCHAR(255) NOT NULL,
  `mobileNumber` VARCHAR(255) NOT NULL,
  `id_image_front` VARCHAR(255) NOT NULL,
  `id_image_back` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

ALTER TABLE
  `frontend_users` ADD UNIQUE `frontend_users_id_unique`(`id`);
ALTER TABLE
  `frontend_users` ADD UNIQUE `frontend_users_email_unique`(`email`);

#frontend_password_resets
CREATE TABLE `frontend_password_resets`(
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE
  `frontend_password_resets` ADD INDEX `frontend_password_resets_email_index`(`email`);
ALTER TABLE
  `frontend_password_resets` ADD INDEX `frontend_password_resets_token_index`(`token`);


#backend_password_resets
CREATE TABLE `backend_password_resets`(
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE
  `backend_password_resets` ADD INDEX `backend_password_resets_email_index`(`email`);
ALTER TABLE
  `backend_password_resets` ADD INDEX `backend_password_resets_token_index`(`token`);


CREATE TABLE `transaction_requests_log`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `transaction_id` INT NOT NULL,
  `frontendUser_id` INT NOT NULL,
  `type` INT NOT NULL COMMENT "1 - Loan, 2 - Return",
  `accessionNumber1` VARCHAR(255) NOT NULL,
  `accessionNumber2` VARCHAR(255) NULL,
  `accessionNumber3` VARCHAR(255) NULL,
  `accessionNumber4` VARCHAR(255) NULL,
  `accessionNumber5` VARCHAR(255) NULL,
  `address` VARCHAR(255) NOT NULL,
  `bookingSpecifics` VARCHAR(255) NOT NULL,
  `latitude` DOUBLE(32, 16) NOT NULL,
  `longitude` DOUBLE(32, 16) NOT NULL,
  `status` INT NOT NULL DEFAULT '0' COMMENT "",
  `remarks` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) default CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `transaction_requests`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `frontendUser_id` INT NOT NULL,
  `type` INT NOT NULL COMMENT "1 - Loan, 2 - Return",
  `accessionNumber1` VARCHAR(255) NOT NULL,
  `accessionNumber2` VARCHAR(255) NULL,
  `accessionNumber3` VARCHAR(255) NULL,
  `accessionNumber4` VARCHAR(255) NULL,
  `accessionNumber5` VARCHAR(255) NULL,
  `address` VARCHAR(255) NOT NULL,
  `bookingSpecifics` VARCHAR(255) NOT NULL,
  `latitude` DOUBLE(32, 16) NOT NULL,
  `longitude` DOUBLE(32, 16) NOT NULL,
  `status` INT NOT NULL DEFAULT '0' COMMENT "",
  `remarks` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;


CREATE TRIGGER transaction_requests_insert AFTER
INSERT ON
  transaction_requests FOR EACH ROW
	INSERT INTO
	  	transaction_requests_log(
		    transaction_id,
		    frontendUser_id,
		    TYPE,
		    accessionNumber1,
		    accessionNumber2,
		    accessionNumber3,
		    accessionNumber4,
		    accessionNumber5,
		    address,
		    bookingSpecifics,
		    latitude,
		    longitude,
		  	STATUS,
		    remarks,
		    created_at,
		    updated_at
  		)
VALUES(
  NEW.id,
  NEW.frontendUser_id,
  NEW.type,
  NEW.accessionNumber1,
  NEW.accessionNumber2,
  NEW.accessionNumber3,
  NEW.accessionNumber4,
  NEW.accessionNumber5,
  NEW.address,
  NEW.bookingSpecifics,
  NEW.latitude,
  NEW.longitude,
  NEW.status,
  NEW.remarks,
  NEW.created_at,
  NEW.updated_at
);
CREATE TRIGGER transaction_requests_update AFTER
UPDATE ON
  transaction_requests FOR EACH ROW 
  	INSERT INTO
	  transaction_requests_log(
	    transaction_id,
	    frontendUser_id,
	    TYPE,
	    accessionNumber1,
	    accessionNumber2,
	    accessionNumber3,
	    accessionNumber4,
	    accessionNumber5,
	    address,
	    bookingSpecifics,
	    latitude,
	    longitude,
	    STATUS,
	    remarks,
	    created_at,
	    updated_at
  )
VALUES(
  NEW.id,
  NEW.frontendUser_id,
  NEW.type,
  NEW.accessionNumber1,
  NEW.accessionNumber2,
  NEW.accessionNumber3,
  NEW.accessionNumber4,
  NEW.accessionNumber5,
  NEW.address,
  NEW.bookingSpecifics,
  NEW.latitude,
  NEW.longitude,
  NEW.status,
  NEW.remarks,
  NEW.created_at,
  NEW.updated_at
);


### Insert Default Values here

#Frontend Users
INSERT INTO `frontend_users` (`id`, `name`, `email`, `course`, `college`, `mobileNumber`, `id_image_front`, `id_image_back`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'French Clifford dacion', 'cliffordzen_143@yahoo.co.uk', 'Library Science', 'School of library and information studies', '0987654321', 'id/cliff.jpg', 'id/cliff.jpg', '$2y$10$a2.bqgmtQnlElkrP87Qy6up0WjMRW3hcv4niWokcTFOQ7x5UJYOoC', NULL, '2016-06-21 00:28:47', '2016-06-21 00:28:47'),
(2, 'Salve Lyne De Vera', 'salve@yahoo.co.uk', 'BS Biology', 'College of Science', '0987654321', 'id/cliff.jpg', 'id/cliff.jpg', '$2y$10$a2.bqgmtQnlElkrP87Qy6up0WjMRW3hcv4niWokcTFOQ7x5UJYOoC', NULL, '2016-06-21 00:28:47', '2016-06-21 00:28:47'),
(3, 'Frank Kenneth Dacion', 'ken@yahoo.co.uk', 'Nursing', 'College of Health Studies', '0987654321', 'id/cliff.jpg', 'id/cliff.jpg', '$2y$10$a2.bqgmtQnlElkrP87Qy6up0WjMRW3hcv4niWokcTFOQ7x5UJYOoC', NULL, '2016-06-21 00:28:47', '2016-06-21 00:28:47');


#Backend Users
INSERT INTO `backend_users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'cliff', 'cliffordzen_143@yahoo.co.uk', '$2y$10$a2.bqgmtQnlElkrP87Qy6up0WjMRW3hcv4niWokcTFOQ7x5UJYOoC', NULL, '2016-06-21 00:28:47', '2016-06-21 00:28:47');


#Temporary transactions for testing
INSERT INTO `transaction_requests` (`id`, `frontendUser_id`, `type`, `accessionNumber1`, `accessionNumber2`, `accessionNumber3`, `accessionNumber4`, `accessionNumber5`, `address`, `bookingSpecifics`, `latitude`, `longitude`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'testing LG Choch', 'testing LG Choch1', 'testing LG Choch2', NULL, NULL, '15 Rd 5, Project 6, Quezon City, 1105 Metro Manila, Philippines', 'tabi tabi lang', 14.6607140000000000, 121.0326874000000100, 0, 'Loan Request', '2016-06-21 00:28:47', '2016-06-21 00:28:47'),
(2, 2, 1, 'testing LG Choch', 'testing LG Choch1', 'testing LG Choch2', NULL, NULL, '15 Rd 5, Project 6, Quezon City, 1105 Metro Manila, Philippines', 'tabi tabi lang', 14.6607140000000000, 121.0326874000000100, 0, 'Loan Request', '2016-06-21 00:28:47', '2016-06-21 00:28:47'),
(3, 3, 1, 'testing LG Choch', 'testing LG Choch1', 'testing LG Choch2', NULL, NULL, '15 Rd 5, Project 6, Quezon City, 1105 Metro Manila, Philippines', 'tabi tabi lang', 14.6607140000000000, 121.0326874000000100, 2, 'Loan Request', '2016-06-21 00:28:47', '2016-06-21 00:28:47');
