
-- Chama/Merry-Go-Round Tables
CREATE TABLE `chama_groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `description` text,
  `contribution_amount` decimal(64,4) NOT NULL,
  `frequency` varchar(191) NOT NULL,
  `start_date` date NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending',
  `created_by_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `chama_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chama_group_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `payout_order` int NOT NULL DEFAULT '0',
  `status` varchar(191) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chama_members_chama_group_id_foreign` (`chama_group_id`),
  KEY `chama_members_client_id_foreign` (`client_id`),
  CONSTRAINT `chama_members_chama_group_id_foreign` FOREIGN KEY (`chama_group_id`) REFERENCES `chama_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chama_members_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `chama_contributions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chama_group_id` bigint unsigned NOT NULL,
  `chama_member_id` bigint unsigned NOT NULL,
  `amount` decimal(64,4) NOT NULL,
  `date` date NOT NULL,
  `notes` text,
  `created_by_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chama_contributions_chama_group_id_foreign` (`chama_group_id`),
  KEY `chama_contributions_chama_member_id_foreign` (`chama_member_id`),
  CONSTRAINT `chama_contributions_chama_group_id_foreign` FOREIGN KEY (`chama_group_id`) REFERENCES `chama_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chama_contributions_chama_member_id_foreign` FOREIGN KEY (`chama_member_id`) REFERENCES `chama_members` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `chama_payouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chama_group_id` bigint unsigned NOT NULL,
  `chama_member_id` bigint unsigned NOT NULL,
  `amount` decimal(64,4) NOT NULL,
  `date` date NOT NULL,
  `notes` text,
  `created_by_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chama_payouts_chama_group_id_foreign` (`chama_group_id`),
  KEY `chama_payouts_chama_member_id_foreign` (`chama_member_id`),
  CONSTRAINT `chama_payouts_chama_group_id_foreign` FOREIGN KEY (`chama_group_id`) REFERENCES `chama_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chama_payouts_chama_member_id_foreign` FOREIGN KEY (`chama_member_id`) REFERENCES `chama_members` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
