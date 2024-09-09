/* eslint-disable prefer-const */
/* eslint-disable prettier/prettier */
/* eslint-disable @typescript-eslint/no-unused-vars */
import {
  Controller,
  Post,
  Body,
  UseGuards,
  Request,
  UnauthorizedException,
} from '@nestjs/common';
import { AuthService } from './auth.service';
import { JwtService } from '@nestjs/jwt';
import { LoginDto } from './dto/login-auth.dto';
import { GlobalService } from 'src/global/global.service';
import { PrismaService } from 'src/prisma/prisma.service';

@Controller('auth')
export class AuthController {
  constructor(
    private prisma: PrismaService,
    private jwt: JwtService,
    private readonly authService: AuthService,
    private readonly globalService: GlobalService,
  ) {}

  @Post('register')
  async register(@Body() body: any) {
    return await this.authService.register(body);
  }

  // @UseGuards(LocalAuthGuard)
  @Post('login')
  async login(@Body() LoginDto: LoginDto) {
    try {
      const result = await this.authService.login(LoginDto);
      return result;
    } catch (error) {
      console.error('Login error:', error);
      throw new UnauthorizedException();
    }
  }

}
