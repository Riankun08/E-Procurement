import { Controller, Get, Query } from '@nestjs/common';
import { ProvinciesService } from './provincies.service';

@Controller('provincies')
export class ProvinciesController {
  constructor(private readonly provinciesService: ProvinciesService) {}

  @Get()
  findAll(@Query() request) {
    return this.provinciesService.findAll(request);
  }
}
