import { Injectable, InternalServerErrorException } from '@nestjs/common';
import { GlobalService } from 'src/global/global.service';
import { PrismaService } from 'src/prisma/prisma.service';

@Injectable()
export class CitiesService {
  constructor(
    private prisma: PrismaService,
    private readonly globalService: GlobalService,
  ) {}

  async findAll(request: any) {
    try {
      let result;
      result = await this.prisma.cities.findMany();
      if (request.provinceId) {
        result = await this.prisma.cities.findMany({
          where: {
            provinceId: parseInt(request.provinceId),
          },
        });
      }
      return this.globalService.response('Successfully', result);
    } catch (error) {
      console.error('Something Wrong:', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }
}
