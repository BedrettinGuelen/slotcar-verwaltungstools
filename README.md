# Slotcar-Verwaltungstools

- clone this repository
- run `cp .env.example .env`
- install `nodejs` and `npm` for Windows (`winget install -e --id OpenJS.NodeJS`)
- run `make start`
- install required dependencies via `make install`
- create database `make create-database`
- run migrations to update to latest scheme `make migrate`
- run fixtures `make fixtures`
- the project is now up&running!
  - Webapp `http://localhost:8889`
