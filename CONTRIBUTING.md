# Basic Workflow

Fork >> Setup Development >> Edit >> Send GitHub pull request

### Getting Started (Vagrant Setup)

1. Install Git
2. Install VirtualBox: https://www.virtualbox.org/wiki/Downloads
3. Install Vagrant: http://www.vagrantup.com/ (version 1.2.2+ or later)
4. Open a terminal
5. Clone the project: `git clone https://github.com/borivojevic/rescuetime-api-php.git`
6. Enter the project directory: `cd rescuetime-api-php`

### Using Vagrant

When you're ready to start working, boot the VM:

```
vagrant up
```

The first time you do this Vagrant will have to download and install VM image which can take ~15 minutes or more depending on internet connection speed.

When machine boots up ssh into it by typing:

```
vagrant ssh
```

**On Windows**: Use : ssh vagrant@127.0.0.1 -p 2222


### Making Changes

The application code is found in vagrant home directory at /home/vagrant

### Testing