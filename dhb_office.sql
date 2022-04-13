-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 02, 2022 at 11:42 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhb_office`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `parent_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Printing', NULL, NULL, 'Y', NULL, NULL),
(2, 'Signs', NULL, NULL, 'Y', NULL, NULL),
(3, 'Larger Format', NULL, NULL, 'Y', NULL, NULL),
(4, 'Vehicle Graphics', NULL, NULL, 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `category_view`
-- (See below for the actual view)
--
CREATE TABLE `category_view` (
`id` bigint(20) unsigned
,`category_name` varchar(255)
,`description` varchar(255)
,`parent_id` int(11)
,`parent` varchar(255)
,`active` enum('Y','N')
);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_17_070334_create_records_table', 1),
(6, '2022_03_17_090739_create_two_factors_table', 1),
(7, '2022_03_19_063036_create_user_profiles_table', 1),
(8, '2022_03_22_050333_create_categories_table', 1),
(9, '2022_03_22_062844_create_printing_modules_table', 1),
(10, '2022_03_23_053432_create_orders_table', 1),
(11, '2022_03_23_060049_create_order_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'designer_name',
  `status` enum('1','2','3','4','5','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=>designing,2=>approved,3=>Printing,4=>Ready for Pickup,5=>pickedUp,0=>cancel',
  `due_date` date DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` decimal(18,4) DEFAULT NULL,
  `approved_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by_information` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ready_for_print` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `printed_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_print_instructions` text COLLATE utf8mb4_unicode_ci,
  `picked_by_information` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `email`, `address`, `user_id`, `status`, `due_date`, `payment_method`, `total_price`, `approved_by`, `approved_by_information`, `ready_for_print`, `printed_by`, `file`, `uploaded_by`, `file_print_instructions`, `picked_by_information`, `created_at`, `updated_at`) VALUES
(10, 'Harhukam Singh', '9815098150', 'dhbgraphics.test@gmail.com', 'Dummy 108, Gujral Nagar, Jalandhar', '2', '2', '2022-04-21', 'Credit Card', '120.0000', NULL, NULL, NULL, NULL, '10_4241.png', 'Admin(admin)', NULL, NULL, '2022-04-02 06:04:30', '2022-04-02 06:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `printing_modules` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_height` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_width` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(18,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `category_id`, `printing_modules`, `details`, `quantity`, `size_height`, `size_width`, `price`, `created_at`, `updated_at`) VALUES
(21, 10, 1, 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"4\";}', '', '2000', '30', '20', '120.0000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `printing_modules`
--

CREATE TABLE `printing_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `printing_modules`
--

INSERT INTO `printing_modules` (`id`, `module_name`, `parent_id`, `category_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'test', NULL, 1, 'Y', '2022-04-01 04:11:25', '2022-04-01 04:11:25'),
(2, 'test2', NULL, 2, 'Y', '2022-04-01 04:11:37', '2022-04-01 04:11:37'),
(3, 'tshhghdf', NULL, 1, 'Y', '2022-04-01 05:49:21', '2022-04-01 05:49:21'),
(4, 'fggffghfg', NULL, 1, 'Y', '2022-04-01 05:49:32', '2022-04-01 05:49:32'),
(5, 'aaaaaa', NULL, 2, 'Y', '2022-04-01 05:49:43', '2022-04-01 05:49:43'),
(6, 'bbbbbbb', NULL, 2, 'Y', '2022-04-01 05:49:53', '2022-04-01 05:49:53'),
(7, 'cccccc', NULL, 2, 'Y', '2022-04-01 05:50:08', '2022-04-01 05:50:08'),
(8, 'mmmmm', 5, 2, 'Y', '2022-04-01 05:50:28', '2022-04-01 05:50:28'),
(9, 'nnnnnnn', 5, 2, 'Y', '2022-04-01 05:50:43', '2022-04-01 05:50:43'),
(10, 'tttttt', 7, 2, 'Y', '2022-04-01 05:50:54', '2022-04-01 05:50:54'),
(11, 'rrrrrrr', 7, 2, 'Y', '2022-04-01 05:51:07', '2022-04-01 05:51:07');

-- --------------------------------------------------------

--
-- Stand-in structure for view `printing_module_view`
-- (See below for the actual view)
--
CREATE TABLE `printing_module_view` (
`id` bigint(20) unsigned
,`module_name` varchar(255)
,`parent_id` int(11)
,`category_id` bigint(20) unsigned
,`parent` varchar(255)
,`active` enum('Y','N')
);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `two_factor_user_codes`
--

CREATE TABLE `two_factor_user_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `two_factor_user_codes`
--

INSERT INTO `two_factor_user_codes` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(1, 1, '$2y$10$yBgmmO58TG/5l9tmS7U1b.vb4JiHr1x2ky.gTXfoRl/DvimU8DUhu', NULL, '2022-04-01 05:48:40'),
(2, 2, '$2y$10$aFw0lKEpNyUvmSnPl0ED3uJP7UNJxoq1Lybx/Dgnj9Ey/Acn0S0b2', '2022-04-01 05:01:46', '2022-04-01 05:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('A','M','D','U','P') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'U' COMMENT 'a=>admin,m=>manager,d=>designer,p=>print man , u=>user',
  `active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `two_factor` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `active`, `two_factor`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'dhbgraphics.user@gmail.com', '2022-04-01 05:48:57', '$2y$10$as3pJsmbl.Ls436IWiAa9eC23gQUGKpxchDby3kogN3Khf3BBc8QC', 'A', 'Y', 'N', NULL, NULL, '2022-04-01 05:48:57'),
(2, 'Gurjit Singh', 'gurjit', 'gurjit@dhbgraphics.com', '2022-04-01 05:01:59', '$2y$10$7KMd2EhX64DsV/sblcU0Ee/McnOWq/sUnJ0sFQQ1M9PGlPp6mU57q', 'D', 'Y', 'N', NULL, NULL, '2022-04-01 05:01:59'),
(3, 'Harpeet Singh', 'printman', 'happy@dhbgraphics.com', NULL, '$2y$10$gVCZbLLZv9bV76x8uj/8ZeVeTbIolSJ/DqjAzbuH4Ba61IF/2/UE.', 'P', 'Y', 'N', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `old_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure for view `category_view`
--
DROP TABLE IF EXISTS `category_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `category_view`  AS SELECT `a`.`id` AS `id`, `a`.`category_name` AS `category_name`, `a`.`description` AS `description`, `a`.`parent_id` AS `parent_id`, `b`.`category_name` AS `parent`, `a`.`active` AS `active` FROM (`categories` `a` left join `categories` `b` on((`a`.`parent_id` = `b`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `printing_module_view`
--
DROP TABLE IF EXISTS `printing_module_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `printing_module_view`  AS SELECT `a`.`id` AS `id`, `a`.`module_name` AS `module_name`, `a`.`parent_id` AS `parent_id`, `a`.`category_id` AS `category_id`, `b`.`module_name` AS `parent`, `a`.`active` AS `active` FROM (`printing_modules` `a` left join `printing_modules` `b` on((`a`.`parent_id` = `b`.`id`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `printing_modules`
--
ALTER TABLE `printing_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `printing_modules_category_id_foreign` (`category_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `two_factor_user_codes`
--
ALTER TABLE `two_factor_user_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `printing_modules`
--
ALTER TABLE `printing_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `two_factor_user_codes`
--
ALTER TABLE `two_factor_user_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `printing_modules`
--
ALTER TABLE `printing_modules`
  ADD CONSTRAINT `printing_modules_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
