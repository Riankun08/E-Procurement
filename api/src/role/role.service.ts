/* eslint-disable prettier/prettier */
/* eslint-disable @typescript-eslint/no-unused-vars */
import { Injectable, InternalServerErrorException } from '@nestjs/common';
import { CreateRoleDto } from './dto/create-role.dto';
import { UpdateRoleDto } from './dto/update-role.dto';
import { PrismaService } from 'src/prisma/prisma.service';
import { GlobalService } from 'src/global/global.service';

@Injectable()
export class RoleService {
  constructor(
    private prisma: PrismaService,
    private readonly globalService: GlobalService,
  ) {}

  async create(createRoleDto: CreateRoleDto) {
    try {
      const data = await this.prisma.role.create({
        data: createRoleDto,
      });
      return this.globalService.response('Successfully', data);
    } catch (error) {
      console.error('Something Wrong:', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }

  async findAll() {
    try {
      const datas = await this.prisma.role.findMany({
        where: { deletedAt: null },
        include: {
          permission: {
            where: {
              deletedAt: null
            },
            include: {
              permission: true
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
      const datas = await this.prisma.role.findUnique({
        where: { id, deletedAt: null },
        include: {
          permission: {
            where: {
              deletedAt: null
            },
            include: {
              permission: true,
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

  async update(id: string, updateRoleDto: UpdateRoleDto) {
    try {
      const validate = await this.prisma.role.findUnique({
        where: { id, deletedAt: null },
      });
      if (!validate) {
        return this.globalService.response('Data Not Found!', {});
      }
      const datas = await this.prisma.role.update({
        data: updateRoleDto,
        where: { id },
      });
      return this.globalService.response('Successfully', datas);
    } catch (error) {
      console.error('Something Wrong :', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }

  async addPermission(request: any) {
    try {
      const validate = await this.prisma.role.findUnique({
        where: { id: request.roleId },
      });
      if (!validate) {
        return this.globalService.response('Data Not Found!', {});
      }
      for (let index = 0; index < request.permissionId.length; index++) {
        const validatePermission = await this.prisma.permission.findUnique({
          where: { id: request.permissionId[index] },
        });
        if (validatePermission) {
          const validateExist = await this.prisma.role_permissions.findFirst({
            where: { 
              roleId: request.roleId,
              permissionId: request.permissionId[index],
            },
          });
          if (!validateExist) {
            await this.prisma.role_permissions.create({
              data: {
                roleId: request.roleId,
                permissionId: request.permissionId[index],
              },
            });
          }
        } 
      }
      const result = await this.prisma.role.findUnique({
        where: { id: request.roleId },
        include: {
          permission: {
            include: {
              permission: true,
            },
          },
        }
      });
      return this.globalService.response('Successfully', result);
    } catch (error) {
      console.error('Something Wrong :', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }

  async remove(id: string) {
    try {
      const validate = await this.prisma.role.findUnique({
        where: { id },
      });
      if (!validate) {
        return this.globalService.response('Data Not Found!', {});
      }

      const validateRole = await this.prisma.role_permissions.findFirst({
        where: {
          roleId: validate.id,
        },
      });

      if (validateRole) {
        await this.prisma.role_permissions.updateMany({
          where: {
            roleId: id,
          },
          data: { deletedAt: new Date() },
        });
      }

      const datas = await this.prisma.role.update({ where: { id }, data: {deletedAt: new Date()} });
      return this.globalService.response('Successfully', datas);
    } catch (error) {
      console.error('Something Wrong :', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }
}
