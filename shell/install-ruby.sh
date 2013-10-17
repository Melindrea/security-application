#!/usr/bin/env bash

curl -L get.rvm.io | bash -s stable --auto-dotfiles

cat .bash_profile >> .bashrc
rm .bash_profile .zlogin .zshrc

source "$HOME/.rvm/scripts/rvm"

cp /vagrant/setup/gemrc ~/.gemrc

rvm requirements

rvm install 2.0.0
rvm use 2.0.0
rvm --default use 2.0.0-p247

gem update --system

cd /vagrant && bundle install
