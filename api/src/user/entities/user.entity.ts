import { $Enums, users as UserModel } from '@prisma/client';

export default class UserEntity implements UserModel {
  id: string;
  name: string;
  email: string;
  password: string;
  phoneNumber: string;
  type: $Enums.typeName;
  createdAt: Date;
  updatedAt: Date;
  deletedAt: Date;
}
