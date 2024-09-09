import { Module } from '@nestjs/common';
import { CitiesService } from './cities.service';
import { CitiesController } from './cities.controller';
import { PrismaService } from 'src/prisma/prisma.service';
import { GlobalService } from 'src/global/global.service';

@Module({
  controllers: [CitiesController],
  providers: [CitiesService, PrismaService, GlobalService],
})
export class CitiesModule {}
