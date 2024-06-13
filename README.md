# Slotcar Management Tools

## Prerequisites:

Before proceeding, make sure you have the following installed:

- **make**: If you are using Unix or a similar operating system, `make` is usually already installed. If not, install it via your operating system's package manager.
- **Docker**: Install Docker Desktop from [here](https://www.docker.com/products/docker-desktop).

  ### Linux

  - `sudo apt-get install make`

## Instructions:

- clone this repository or download the zip file and extract it
- start Docker

- Check if the Node.js is installed in the environment
  `node -v ` should print example `v20.xx.xx`
- Check if the NPM is installed in the environment
  `npm -v ` should print example `10.xx.xx`

- if not installed, or the version of **_node_** is under `v20.xx.xx`, follow the steps below:

  - installs nvm (Node Version Manager)
    `curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash`

  * download and install Node.js (you may need to restart the terminal)
    `nvm install --lts`

- navigate to the project directory
- install required dependencies via `make install`
- create database `make create-database`
- run migrations to update to latest scheme `make migrate`
- run fixtures `make fixtures`
- run `make start`
- the project is now up&running!
  - Webapp `http://localhost:8889`
