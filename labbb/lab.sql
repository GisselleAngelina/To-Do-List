SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `progress` tinyint(1) NOT NULL,
  `done` tinyint(1) NOT NULL,
  `timecreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tasks` (`task_id`, `user_id`, `title`, `description`, `progress`, `done`, `timecreated`) VALUES
(1, 2,'Masak', 'Oseng-oseng', 3, 0, '2023-10-23 19:52:30'),
(2, 4,'Mandi', 'byur byur', 1, 0, '2023-10-23 19:53:05'),
(3, 2,'Jalan', 'klak klak', 2, 0, '2023-10-23 19:53:45'),
(4, 4,'Belajar', 'CJSBNCNANCK', 3, 0, '2023-10-23 19:54:01'),
(5, 2,'Rebahan', 'ZzzzZzzz', 1, 0, '2023-10-23 19:54:50');

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`user_id`, `username`, `password`, `datecreated`) VALUES
(2, '123', '$2y$10$tlubzV8vJnIoXZm2fK6YQuyQMm0Es6jpFBYNYywsfCLoJfO1pGAhi', '2023-10-23 17:16:53'),
(4, '234', '$2y$10$rTJoLu..xNMMH3qRphL28uIh9Ovwc3tlskrHsF6AESlPk.HewKfrC', '2023-10-23 17:22:34');
