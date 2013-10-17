#!/usr/bin/env bash

git clone git://github.com/creationix/nvm.git ~/.nvm

echo '[[ -s "$HOME/.nvm/nvm.sh" ]] && source "$HOME/.nvm/nvm.sh"' >> $HOME/.bashrc
echo 'PATH=$PATH:$HOME/.nvm # Add NVM to PATH for scripting' >> $HOME/.bashrc

. $HOME/.nvm/nvm.sh

nvm install v0.10.20 #or whatever is the latest stable at your reading
nvm alias default 0.10.20 #sets the default assumption of any project to that

curl https://npmjs.org/install.sh | sh

npm install -g yo

cd /vagrant && npm install && bower install
