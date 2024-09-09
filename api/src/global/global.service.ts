/* eslint-disable @typescript-eslint/no-var-requires */
/* eslint-disable prettier/prettier */ /* eslint-disable @typescript-eslint/no-unused-vars */
import { Injectable } from '@nestjs/common';
import { PrismaService } from 'src/prisma/prisma.service';
import * as nodemailer from 'nodemailer';
import * as ejs from 'ejs';
import * as path from 'path';
import * as AWS from "aws-sdk";
import { S3 } from 'aws-sdk';
import axios from 'axios';
import UploadResponse from './s3.types';
import { format } from 'date-fns';
import { id } from 'date-fns/locale';
import slugify from 'slugify';
import * as fs from 'fs-extra';

@Injectable()
export class GlobalService {
  private transporter;
  private s3: AWS.S3;
  private AWS_S3_BUCKET: string;
  

  constructor(private prisma: PrismaService) { 
    this.s3 = new S3({
      endpoint: 's3.ap-southeast-3.amazonaws.com', // Specify the custom endpoint
      accessKeyId: 'AKIAVNG3V7JKP2TDVNF3',
      secretAccessKey: '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',
    });
    this.AWS_S3_BUCKET = 'hijaudigital/static-file/uploads';
  }

  async response(message: string, datas: object, extra?: any) {
    let response: object = {
      code: 200,
      message: message,
      data: datas
    };

    if(extra?.pagination) {
      response = {
        ...response,
        pagination: extra.pagination
      }
    }

    if(extra?.info) {
      response = {
        ...response,
        info: extra.info
      }
    }

    return response;
  }

  async formatDateToIndonesianLong(date: string) {
    // const options = {
    //   weekday: 'long',
    //   day: 'numeric',
    //   month: 'long',
    //   year: 'numeric',
    // };
    const yourDate = new Date(date);
    const formattedDate = format(yourDate, 'eeee, dd MMMM yyyy', { locale: id });
    return formattedDate;
  }

  async sendMail(to: string, subject: string, templateName: string, data: object) {
    const templatePath = path.join(__dirname, '../../../src/global/templates', `${templateName}.ejs`);
    console.log('Template Path:', templatePath);
    const html = await ejs.renderFile(templatePath, data);

    const mailOptions = {
      from: 'noreply@menuku.app',
      to,
      subject,
      html,
    };

    return new Promise((resolve, reject) => {
      this.transporter.sendMail(mailOptions, (error: any, info: unknown) => {
        if (error) {
          reject(error);
        } else {
          resolve(info);
        }
      });
    });
  }

  async uploadFile(file: any) {
    const uniqueName = await this.makeid(20);
    const mimetype = file.fileType ? file.fileType.mime : 'application/octet-stream';
    console.log(file);
    const s3Response = await this.s3_upload(file.buffer, this.AWS_S3_BUCKET, uniqueName+'.'+file.fileType.ext, mimetype);
    return s3Response;
  }

  async uploadFileBase64(filePath: string) {
    try {
      // Read the file from the local folder
      const buffer = await fs.readFile(filePath);
  
      // Extract the file name and extension from the file path
      const fileName = path.basename(filePath);
      const fileExtension = path.extname(filePath);
  
      // Generate a unique name for the uploaded file
      const uniqueName = await this.makeid(20);
  
      // Determine the mimetype based on file extension (you may want to refine this logic)
      let mimetype;
      if (fileExtension === '.png') {
        mimetype = 'image/png';
      } else if (fileExtension === '.jpg' || fileExtension === '.jpeg') {
        mimetype = 'image/jpeg';
      } else {
        mimetype = 'application/octet-stream'; // Default mimetype if extension is unknown
      }
  
      // Upload the file to the S3 bucket
      const s3Response = await this.s3_upload(buffer, this.AWS_S3_BUCKET, `${uniqueName}${fileExtension}`, mimetype);
  
      return s3Response;
    } catch (error) {
      throw new Error(`Failed to upload file: ${error.message}`);
    }
  }

  async deleteFile(filePath: string) {
    try {
      // Check if the file exists
      const fileExists = await fs.pathExists(filePath);
      if (fileExists) {
        // Delete the file
        await fs.unlink(filePath);
      } else {
        throw new Error(`File not found at ${filePath}`);
      }
    } catch (error) {
      throw new Error(`Failed to delete file: ${error.message}`);
    }
  }

  async makeid(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
      counter += 1;
    }
    return result;
  }

  async s3_upload(file: any, bucket: string, name: any, mimetype: any): Promise<UploadResponse> {
    const spacesEndpoint = new AWS.Endpoint('https://sgp1.digitaloceanspaces.com');
    const s3 = new AWS.S3({
      endpoint: spacesEndpoint,
      accessKeyId: 'DO00PPCVPYZTX84W2KN2',
      secretAccessKey: 'wqn85vHFbmxxwDqoy0AJ54UtQnI3GXgRGwk6S/us1s0',
    });

    // Upload file to DigitalOcean Space
    const uploadParams = {
      Bucket: 'myrootsy',
      Key: String(name),
      Body: file,
      ACL: 'public-read', // Specify the appropriate ACL as per your requirements
      ContentType: mimetype,
    };

    const result = await s3.upload(uploadParams).promise();
    return result; // Return the URL of the uploaded file

    // const params = {
    //   Bucket: bucket,
    //   Key: String(name),
    //   Body: file,
    //   ACL: 'public-read',
    //   ContentType: mimetype,
    //   ContentDisposition: 'inline',
    //   CreateBucketConfiguration: {
    //     LocationConstraint: 'ap-southeast-3', // Set your region as 'ap-southeast-3'
    //   },
    // };
    // try {
    //   const s3Response = await this.s3.upload(params).promise();
    //   console.log(s3Response);
    //   return s3Response;
    // } catch (e) {
    //   console.error(e);
    // }
  }

  async whatsappQisqus(data: any, customHeaders: any) {
    const url = 'https://multichannel.qiscus.com/whatsapp/v1/gfteg-hh7urzdmnar2qyi/4764/messages';
    const config = {
      headers: customHeaders,
    };
    try {
      const response = await axios.post(url, data, config);
      return response.data;
    } catch (error) {
      throw error;
    }
  }

  slugable(text: string) {
    return slugify(text, {
      lower: true,
      trim: true,
      strict: true,
    });
  }

  async encryptSaldo(saldo: any) {
    const CryptoJS = require('crypto-js');

    // Encrypt
    const ciphertext = CryptoJS.AES.encrypt(
      saldo,
      'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI2YjNjMjUyOS1iN2YzLTQyMDEtOTMwOC0wMzc5MTJlYmNlNzgiLCJlbWFpbCI6InVkaW5AZ21haWwuY29tIiwiaWF0IjoxNjk3MTkyNzEwLCJleHAiOjE2OTcxOTYzMTB9',
    ).toString();
    return ciphertext;
  }

  async decryptSaldo(saldo: any) {
    if (saldo != '0') {
      const CryptoJS = require('crypto-js');
  
       // Decrypt
       const bytes = CryptoJS.AES.decrypt(saldo, 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI2YjNjMjUyOS1iN2YzLTQyMDEtOTMwOC0wMzc5MTJlYmNlNzgiLCJlbWFpbCI6InVkaW5AZ21haWwuY29tIiwiaWF0IjoxNjk3MTkyNzEwLCJleHAiOjE2OTcxOTYzMTB9');
       const originalText = bytes.toString(CryptoJS.enc.Utf8);
  
      return originalText;
    } else {
      return saldo;
    }
  }
}
