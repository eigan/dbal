#!/bin/sh
./linux quiet mem=2G rootfstype=hostfs rw eth0=slirp,,/usr/bin/slirp-fullbolt init=$(pwd)/init_docker.sh WORKDIR=$(pwd) HOME=$HOME
