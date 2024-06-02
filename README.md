# Slotcar Management Tools

## Prerequisites:

Before proceeding, make sure you have the following installed:

- **make**: If you are using Unix or a similar operating system, `make` is usually already installed. If not, install it via your operating system's package manager.
  ### Windows
  - `winget install -e --id GnuWin32.Make`
  ### Linux
  - `sudo apt-get install make`
- **Node.js and npm for Windows**: Install Node.js and npm on your Windows system. You can do this using the Windows Package Manager (winget). To do this, run the following command in the command prompt as an administrator:
- `winget install -e --id OpenJS.NodeJS`

## Instructions:

- clone this repository
- run `cp .env.example .env`
- start Docker
- run `make start`
- install required dependencies via `make install`
- create database `make create-database`
- run migrations to update to latest scheme `make migrate`
- run fixtures `make fixtures`
- the project is now up&running!
  - Webapp `http://localhost:8889`
