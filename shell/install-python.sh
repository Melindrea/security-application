#!/usr/bin/env bash

curl http://python-distribute.org/distribute_setup.py | sudo python
curl https://raw.github.com/pypa/pip/master/contrib/get-pip.py | sudo python

sudo pip install virtualenv
sudo pip install virtualenvwrapper

echo 'WORKON_HOME=~/.virtualenvs' >> ~/.bashrc
echo 'source /usr/local/bin/virtualenvwrapper.sh' >> ~/.bashrc
