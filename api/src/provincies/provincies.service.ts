/* eslint-disable @typescript-eslint/no-unused-vars */
import { Injectable, InternalServerErrorException } from '@nestjs/common';
import { GlobalService } from 'src/global/global.service';
import { PrismaService } from 'src/prisma/prisma.service';

@Injectable()
export class ProvinciesService {
  constructor(
    private prisma: PrismaService,
    private readonly globalService: GlobalService,
  ) {}

  async findAll(request: any) {
    try {
      const result = await this.prisma.provincies.findMany();
      return this.globalService.response('Successfully', result);
    } catch (error) {
      console.error('Something Wrong:', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }
}
