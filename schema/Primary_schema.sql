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