import { PartialType } from '@nestjs/swagger';
import { CreateProvincyDto } from './create-provincy.dto';

export class UpdateProvincyDto extends PartialType(CreateProvincyDto) {}
