-- DropForeignKey
ALTER TABLE `vendors` DROP FOREIGN KEY `vendors_citiesId_fkey`;

-- DropForeignKey
ALTER TABLE `vendors` DROP FOREIGN KEY `vendors_provinceId_fkey`;

-- AlterTable
ALTER TABLE `vendors` MODIFY `citiesId` INTEGER NULL,
    MODIFY `provinceId` INTEGER NULL;

-- AddForeignKey
ALTER TABLE `vendors` ADD CONSTRAINT `vendors_citiesId_fkey` FOREIGN KEY (`citiesId`) REFERENCES `cities`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `vendors` ADD CONSTRAINT `vendors_provinceId_fkey` FOREIGN KEY (`provinceId`) REFERENCES `provincies`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;
