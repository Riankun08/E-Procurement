/* eslint-disable @typescript-eslint/no-unused-vars */
import { PrismaClient } from '@prisma/client';
import * as bcrypt from 'bcrypt';
import * as fs from 'fs';
import * as path from 'path';

const prisma = new PrismaClient();

async function main() {
  // Path to the JSON file
  const cities = path.join(__dirname, 'cities.json');
  const provincies = path.join(__dirname, 'provincies.json');

  // Read and parse JSON file
  try {
    const provinciesFile = fs.readFileSync(provincies, 'utf-8');
    const provinciesData = JSON.parse(provinciesFile);

    // Process each item in the JSON array
    for (const item of provinciesData) {
      const validateExist = await prisma.provincies.findFirst({
        where: {
          name: item.name,
        },
      });
      if (!validateExist) {
        await prisma.provincies.create({
          data: {
            id: item.id,
            code: item.code,
            name: item.name,
          },
        });
      }
    }

    const citiesFile = fs.readFileSync(cities, 'utf-8');
    const citiesData = JSON.parse(citiesFile);

    // Process each item in the JSON array
    for (const item of citiesData) {
      const validateExist = await prisma.cities.findFirst({
        where: {
          name: item.name,
        },
      });
      if (!validateExist) {
        await prisma.cities.create({
          data: {
            id: item.id,
            code: item.code,
            name: item.name,
            provinceId: item.province_id,
          },
        });
      }
    }
  } catch (error) {
    console.error('Error reading or parsing JSON file:', error);
  }
}

main()
  .then(async () => {
    await prisma.$disconnect();
  })
  .catch(async (e) => {
    console.error(e);
    await prisma.$disconnect();
    process.exit(1);
  });
