import {
  IsNotEmpty,
  IsOptional,
  IsString,
  Length,
} from '@nestjs/class-validator';
import { OmitType } from '@nestjs/mapped-types';
import { $Enums } from '@prisma/client';
import UserEntity from 'src/user/entities/user.entity';

export class LoginDto extends OmitType(UserEntity, []) {
  @IsString()
  @IsNotEmpty()
  type: $Enums.typeName;

  @IsString()
  @IsNotEmpty()
  email: string;

  @IsOptional()
  @IsNotEmpty()
  @Length(6)
  password: string;

  @IsOptional()
  subscription_details?: any;
}
