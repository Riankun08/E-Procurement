/* eslint-disable @typescript-eslint/no-unused-vars */
import { Injectable, InternalServerErrorException } from '@nestjs/common';
import { CreatePermissionDto } from './dto/create-permission.dto';
import { UpdatePermissionDto } from './dto/update-permission.dto';
import { PrismaService } from 'src/prisma/prisma.service';
import { GlobalService } from 'src/global/global.service';

@Injectable()
export class PermissionService {
  constructor(
    private prisma: PrismaService,
    private readonly globalService: GlobalService,
  ) {}

  async create(createPermissionDto: CreatePermissionDto) {
    try {
      const data = await this.prisma.permission.create({
        data: createPermissionDto,
      });
      return this.globalService.response('Successfully', data);
    } catch (error) {
      console.error('Something Wrong:', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }

  async findAll() {
    try {
      const datas = await this.prisma.permission.findMany({
        where: { deletedAt: null },
        include: {
          role: {
            where: {
              deletedAt: null,
            },
            include: {
              role: true,
            },
          },
        },
      });
      return this.globalService.response('Successfully', datas);
    } catch (error) {
      console.error('Something Wrong :', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }

  async findOne(id: string) {
    try {
      const datas = await this.prisma.permission.findUnique({
        where: { id, deletedAt: null },
        include: {
          role: {
            where: {
              deletedAt: null,
            },
            include: {
              role: true,
            },
          },
        },
      });
      if (!datas) {
        return this.globalService.response('Data Not Found!', {});
      }
      return this.globalService.response('Successfully', datas);
    } catch (error) {
      console.error('Something Wrong :', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }

  async update(id: string, updatePermissionDto: UpdatePermissionDto) {
    try {
      const validate = await this.prisma.permission.findUnique({
        where: { id, deletedAt: null },
      });
      if (!validate) {
        return this.globalService.response('Data Not Found!', {});
      }
      const datas = await this.prisma.permission.update({
        data: updatePermissionDto,
        where: { id },
      });
      return this.globalService.response('Successfully', datas);
    } catch (error) {
      console.error('Something Wrong :', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }

  async remove(id: string) {
    try {
      const validate = await this.prisma.permission.findUnique({
        where: { id, deletedAt: null },
      });
      if (!validate) {
        return this.globalService.response('Data Not Found!', {});
      }

      const validatePermission = await this.prisma.role_permissions.findFirst({
        where: {
          permissionId: validate.id,
        },
      });

      if (validatePermission) {
        await this.prisma.role_permissions.updateMany({
          where: {
            permissionId: validate.id,
          },
          data: { deletedAt: new Date() },
        });
      }

      const datas = await this.prisma.permission.update({
        where: { id },
        data: { deletedAt: new Date() },
      });
      return this.globalService.response('Successfully', datas);
    } catch (error) {
      console.error('Something Wrong :', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }
}
