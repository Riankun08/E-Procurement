import { Module } from '@nestjs/common';
import { ProvinciesService } from './provincies.service';
import { ProvinciesController } from './provincies.controller';
import { PrismaService } from 'src/prisma/prisma.service';
import { GlobalService } from 'src/global/global.service';

@Module({
  controllers: [ProvinciesController],
  providers: [ProvinciesService, PrismaService, GlobalService],
})
export class ProvinciesModule {}
