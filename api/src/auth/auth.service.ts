/* eslint-disable prettier/prettier */
/* eslint-disable @typescript-eslint/no-unused-vars */
import {
  Injectable,
  NotFoundException,
  UnauthorizedException,
} from '@nestjs/common';
import { PrismaService } from 'src/prisma/prisma.service';
import { JwtService } from '@nestjs/jwt';
import { LoginDto } from './dto/login-auth.dto';
import * as bcrypt from 'bcrypt';
import { GlobalService } from 'src/global/global.service';

@Injectable()
export class AuthService {
  constructor(
    private prisma: PrismaService,
    private jwt: JwtService,
    private readonly globalService: GlobalService,
  ) {}

  async validateUser(loginDto: LoginDto) {
    const isUserValid = await this.prisma.users.findFirst({
      where: { email: loginDto.email },
    });

    if (!isUserValid) {
      throw new NotFoundException(`No user found for email: ${loginDto.email}`);
    }

    const isPasswordValid = await bcrypt.compare(
      loginDto.password,
      isUserValid.password,
    );

    if (loginDto.password.length < 6) {
      throw new UnauthorizedException('Password less than 6 characters');
    }

    if (!isPasswordValid) {
      throw new UnauthorizedException('Wrong Password');
    }

    const payload = { sub: isUserValid.id, name: isUserValid.email };

    return { token: this.jwt.sign(payload) };
  }
  
  async register(body: any) {
    const isEmailValid = await this.prisma.users.findFirst({
      where: {
        email: body.email,
        type: body.type,
      },
    });
    if (isEmailValid) {
      const response = {
        code: 204,
        message: 'Email already exist!',
      };
      return response;
    }
    if (body.password != body.password_confirmation) {
      const response = {
        code: 204,
        message: 'Password does not match with password confirmation!',
      };
      return response;
    }
    if (body.password.length == null) {
      const response = {
        code: 204,
        message: 'Password does not require for that length!',
      };
      return response;
    }
    if (body.password.length < 6) {
      const response = {
        code: 204,
        message: 'Password less than 6 characters!',
      };
      return response;
    }
    const hashPassword = await bcrypt.hash(body.password, 10);
    try {
      const user = await this.prisma.users.create({
        data: {
          name : body.name,
          email : body.email,
          type : body.type,
          password: hashPassword,
        },
      });
      console.log(user);
      if (body.type == 'vendor') {
        await this.prisma.vendors.create({
          data: {
            userId : user.id,
            name : body.name,
            phone : body.phone,
            citiesId : body.citiesId,
            provinceId : body.provinceId,
            address : body.address,
            npwp : body.npwp,
            npwp_name : body.npwp_name,
            npwp_address : body.npwp_address,
          },
        });
      } else if (body.type == 'buyer') {
        // buyer create data
      }
      const payload = { sub: user.id, email: user.email };
      const expiresInDays = 1000;
      const token = this.jwt.sign(payload, { expiresIn: `${expiresInDays}d` });
      const result = await this.prisma.users.findUnique({
        where: { id: user.id },
      })
      const response = {
        code: 200,
        message: 'Successfully',
        token,
        data: result,
      };
      return response;
    } catch (error) {
      console.error(
        'Terjadi kesalahan saat membuat user atau customer:',
        error,
      );
      throw error;
    }
  }

  async login(loginDto: LoginDto) {
    const user = await this.prisma.users.findFirst({
      where: { 
        email: loginDto.email,
        type: loginDto.type,
      },
    });
    if (!user) {
      return {
        code: 401,
        message: 'Unauthorized',
      };
    }
    const isPasswordValid = await bcrypt.compare(loginDto.password, user.password);
    if (isPasswordValid) {
      const payload = { sub: user.id, email: user.email };
      const expiresInDays = 1000;
      const token = this.jwt.sign(payload, { expiresIn: `${expiresInDays}d` });
      return {
        code: 200,
        message: 'Successfully',
        token: token,
        data: user,
      };
    } else {
      return {
        code: 401,
        message: 'Unauthorized',
      };
    }
  }
}
