# Use a lightweight Node.js image
FROM node:18.18-alpine

WORKDIR /app

# Copy package.json and package-lock.json
COPY api/package*.json ./

# Install dependencies inside the Docker container
RUN npm install

# Copy the rest of the application code
COPY api .

# Generate Prisma client
RUN npx prisma generate

# Expose the application port
EXPOSE 9000

# Start the application
CMD ["npm", "run", "start:migrate:prod"]
