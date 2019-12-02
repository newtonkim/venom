alias ls='ls -lahF --color=always'
alias dir='dir -F --color=always'
alias ll='ls -l'
alias cp='cp -iv'
alias rm='rm -i'
alias mv='mv -iv'
alias grep='grep --color=auto -in'
alias ..='cd ..'

alias ga="git add -A"
alias gac="git add -A && git commit -am"
alias gb="git branch"
alias gc="git commit -m"
alias gch="git checkout"
alias gchd="git checkout dev"
alias gchb="git checkout -b"
alias gd="git diff"
alias gdn="git diff --name-only"
alias glg="git log --graph --abbrev-commit --decorate --format=format:'%C(bold red)%h%C(reset) - %C(bold green)(%ar)%C(reset) %C(white)%s%C(reset) %C(dim white)- %an%C(reset)%C(bold yellow)%d%C(reset)' --all"
alias glo="git log --oneline --decorate"
alias garc="git add -A && git rebase --continue"
alias grc="git rebase --continue"
alias gir="git rebase -i HEAD~"
alias gs="git status"
alias gpuo="git push -u origin "

# composer/laravel aliases
alias cda="composer dump-autoload"
alias phpa="php artisan"
alias phpat="php artisan tinker"
alias phparl="php artisan route:list -vvv"
alias phpadbs="php artisan db:seed --class=DevDatabaseSeeder -vvv"
alias phpadbsdev="php artisan db:seed --class=DevDatabaseSeeder -vvv"
alias phpamr="php artisan migrate:refresh -vvv"
alias phpamrtest="php artisan migrate:refresh --env=testing -vvv"
alias phpacl="php artisan clear-compiled && php artisan auth:clear-resets && php artisan cache:clear && php artisan config:clear && php artisan debugbar:clear && php artisan route:clear && php artisan view:clear"
alias dbsdev="php artisan db:seed --class=DevDatabaseSeeder -vvv"
alias dbs="php artisan db:seed --class=DevDatabaseSeeder -vvv"
alias dbtr='echo "total db reset" && composer dump-autoload && mysql -u homestead --password=secret mobis4 -e "drop database mobis4; create database mobis4;" && php artisan migrate:refresh -vvv && php artisan db:seed --class="DevDatabaseSeeder" -vvv'
alias dbf="phpa migrate:fresh && phpa db:seed --class=DevDatabaseSeeder"
alias cdbf="composer dumpauto && phpa migrate:fresh && phpa db:seed --class=DevDatabaseSeeder"

alias mymy='mysql -u homestead --password=secret'

alias pus='phpunit --stop-on-failure --stop-on-error'
alias pusd='phpunit --stop-on-failure --stop-on-error --testdox'
alias puf='phpunit --stop-on-failure --stop-on-error --filter '
alias vbsh="vim ~/.bashrc"
alias sbsh="source ~/.bashrc && echo 'Sourced bash'"

alias phpunit="vendor/bin/phpunit"
