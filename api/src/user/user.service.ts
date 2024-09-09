/* eslint-disable @typescript-eslint/no-unused-vars */
import {
  Injectable,
  InternalServerErrorException,
  UnauthorizedException,
} from '@nestjs/common';
import * as bcrypt from 'bcrypt';
import { CreateUserDto } from './dto/create-user.dto';
import { UpdateUserDto } from './dto/update-user.dto';
import { PrismaService } from 'src/prisma/prisma.service';
import { GlobalService } from 'src/global/global.service';

@Injectable()
export class UserService {
  constructor(
    private prisma: PrismaService,
    private readonly globalService: GlobalService,
  ) {}

  async create(request: any) {
    try {
      const validateRole = await this.prisma.role.findFirst({
        where: {
          id: request.roleId,
        },
      });
      if (!validateRole) {
        return this.globalService.response('Role Not Found!', {});
      }
      const isEmailValid = await this.prisma.users.findFirst({
        where: {
          email: request.email,
        },
      });
      if (isEmailValid) {
        return new UnauthorizedException('email already exist');
      }

      const hashPassword = await bcrypt.hash(request.password, 10);
      request.password = hashPassword;

      const data = await this.prisma.users.create({
        data: {
          name: request.name,
          email: request.email,
          password: hashPassword,
          type: request.type,
        },
      });
      const result = await this.prisma.users.findFirst({
        where: { id: data.id },
        include: {},
      });
      return this.globalService.response('Successfully', result);
    } catch (error) {
      console.error('Something Wrong:', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }

  async findAll(request: any) {
    try {
      const whereConditions = {
        deletedAt: null,
      };
      if (request.type) {
        whereConditions['type'] = {
          in: request.type,
        };
      } else {
        whereConditions['type'] = {
          not: null,
        };
      }
      if (request.schoolId) {
        whereConditions['staff'] = {
          schoolId: request.schoolId,
        };
      }
      const datas = await this.prisma.users.findMany({
        where: whereConditions,
      });
      return this.globalService.response('Successfully', datas);
    } catch (error) {
      console.error('Something Wrong :', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }

  async findOne(id: string) {
    try {
      const datas = await this.prisma.users.findUnique({
        where: { id, deletedAt: null },
      });
      return this.globalService.response('Successfully', datas);
    } catch (error) {
      console.error('Something Wrong :', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }

  async update(id: string, updateUserDto: UpdateUserDto) {
    try {
      const validateRole = await this.prisma.role.findFirst({
        where: {
          id: updateUserDto.roleId,
        },
      });
      if (!validateRole) {
        return this.globalService.response('Role Not Found!', {});
      }
      const isEmailValid = await this.prisma.users.findFirst({
        where: {
          email: updateUserDto.email,
          NOT: {
            id: id,
          },
        },
      });
      if (isEmailValid) {
        return new UnauthorizedException('email already exist');
      }
      const validate = await this.prisma.users.findUnique({
        where: { id },
      });
      if (!validate) {
        return this.globalService.response('Data Not Found!', {});
      }
      if (updateUserDto.password) {
        const hashPassword = await bcrypt.hash(updateUserDto.password, 10);
        updateUserDto.password = hashPassword;
      }
      delete updateUserDto.schoolId;
      const datas = await this.prisma.users.update({
        data: updateUserDto,
        where: { id },
        include: {},
      });
      return this.globalService.response('Successfully', datas);
    } catch (error) {
      console.error('Something Wrong :', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }

  async remove(id: string) {
    try {
      const validate = await this.prisma.users.findUnique({
        where: { id, deletedAt: null },
      });
      if (!validate) {
        return this.globalService.response('Data Not Found!', {});
      }
      const datas = await this.prisma.users.delete({
        where: { id },
      });
      return this.globalService.response('Successfully', datas);
    } catch (error) {
      console.error('Something Wrong :', error);
      throw new InternalServerErrorException('Something Wrong!');
    }
  }
}
