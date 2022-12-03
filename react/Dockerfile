FROM node:18.12.1

WORKDIR /app

COPY app/package.json .

RUN npm install

COPY ./app .

EXPOSE 3000

CMD ["npm", "start"]