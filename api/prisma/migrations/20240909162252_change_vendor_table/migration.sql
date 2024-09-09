-- DropForeignKey
ALTER TABLE `vendors` DROP FOREIGN KEY `vendors_userId_fkey`;

-- AlterTable
ALTER TABLE `vendors` MODIFY `userId` VARCHAR(191) NULL,
    MODIFY `npwp` VARCHAR(191) NULL,
    MODIFY `npwp_name` VARCHAR(191) NULL,
    MODIFY `npwp_address` TEXT NULL;

-- AddForeignKey
ALTER TABLE `vendors` ADD CONSTRAINT `vendors_userId_fkey` FOREIGN KEY (`userId`) REFERENCES `users`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;
