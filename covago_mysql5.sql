
-- --------------------------------------------------------
-- Table: `users`
-- Contains all user-related information (existing table, unchanged)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(191) NOT NULL UNIQUE,
  `phoneNumber` INT(11) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `profile_photo` TEXT DEFAULT NULL, -- Optional profile photo URL
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Account creation timestamp
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Last updated timestamp
  PRIMARY KEY (`id`),
  UNIQUE KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: `journey`
-- Stores details about journeys published by users (existing table, unchanged)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `journey` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `immat` TEXT NOT NULL, -- Vehicle registration
  `marque` TEXT NOT NULL, -- Vehicle brand
  `model` TEXT NOT NULL, -- Vehicle model
  `couleur` TEXT NOT NULL, -- Vehicle color
  `nbPlaces` INT(11) NOT NULL, -- Available seats
  `dateTravel` DATE NOT NULL, -- Travel date
  `lieuDep` TEXT NOT NULL, -- Departure location
  `lieuArriv` TEXT NOT NULL, -- Arrival location
  `photo_1` TEXT DEFAULT NULL, -- Vehicle photo 1
  `photo_2` TEXT DEFAULT NULL, -- Vehicle photo 2
  `photo_3` TEXT DEFAULT NULL, -- Vehicle photo 3
  `postDate` DATE DEFAULT NULL, -- Post date
  `heureDep` TIME NOT NULL, -- Departure time
  `emailChauffeur` VARCHAR(255) NOT NULL, -- Linked to `users.email`
  PRIMARY KEY (`id`),
  KEY `emailChauffeur` (`emailChauffeur`) -- Foreign key for users
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: `bookings`
-- Tracks seat reservations for journeys (new table)
-- --------------------------------------------------------

CREATE TABLE `bookings` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `journey_id` INT(11) NOT NULL,
  `seats_booked` INT(11) NOT NULL,
  `booking_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`journey_id`) REFERENCES `journey`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: `comments`
-- Stores comments on journeys or user profiles (existing table, unchanged)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `comments` (
  `texte` TEXT NOT NULL, -- Comment text
  `dateComment` DATE NOT NULL -- Comment date
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: `ratings`
-- Tracks ratings given to users or journeys (new table)
-- --------------------------------------------------------

CREATE TABLE `ratings` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `journey_id` INT(11) DEFAULT NULL,
  `rating` INT(1) NOT NULL CHECK (`rating` BETWEEN 1 AND 5),
  `review` TEXT DEFAULT NULL,
  `rating_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`journey_id`) REFERENCES `journey`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: `notifications`
-- Tracks notifications sent to users (new table)
-- --------------------------------------------------------

CREATE TABLE `notifications` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `message` TEXT NOT NULL,
  `is_read` BOOLEAN DEFAULT FALSE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Insert Sample Data for Testing
-- --------------------------------------------------------

-- Users
INSERT INTO `users` (`email`, `phoneNumber`, `password`) VALUES
('user1@example.com', 123456789, 'password1'),
('driver1@example.com', 987654321, 'password2');

-- Journeys
INSERT INTO `journey` (`immat`, `marque`, `model`, `couleur`, `nbPlaces`, `dateTravel`, `lieuDep`, `lieuArriv`, `photo_1`, `emailChauffeur`, `heureDep`) VALUES
('AB123CD', 'Toyota', 'Corolla', 'Blue', 3, '2024-12-20', 'Yaoundé', 'Douala', 'car1.jpg', 'driver1@example.com', '08:00:00');

-- Bookings
INSERT INTO `bookings` (`user_id`, `journey_id`, `seats_booked`) VALUES
(1, 1, 2);

-- Comments
INSERT INTO `comments` (`texte`, `dateComment`) VALUES
('Great service!', '2024-12-10');

-- Ratings
INSERT INTO `ratings` (`user_id`, `journey_id`, `rating`, `review`) VALUES
(1, 1, 5, 'Very comfortable journey.');

-- Notifications
INSERT INTO `notifications` (`user_id`, `message`) VALUES
(1, 'Enfin un service qui, m’éviteras les sabots de la commune du rond-point deido.');
