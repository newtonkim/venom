echo "The Batmobile is Ready"

# ~/.bashrc: executed by bash(1) for non-login shells.
# see /usr/share/doc/bash/examples/startup-files (in the package bash-doc)
# for examples
[ -r /etc/bashrc ] && source /etc/bashrc
[ -r /etc/bash_completion ] && source /etc/bash_completion
[ -r ~/.git-completion.bash ] && source ~/.git-completion.bash
[ -r ~/.git-prompt.sh ] && source ~/.git-prompt.sh
[ -r /usr/local/rvm/scripts/rvm ] && source /usr/local/rvm/scripts/rvm

# If not running interactively, don't do anything
case $- in
    *i*) ;;
      *) return;;
esac

# don't put duplicate lines or lines starting with space in the history.
# See bash(1) for more options
HISTCONTROL=ignoreboth

# append to the history file, don't overwrite it
shopt -s histappend

# for setting history length see HISTSIZE and HISTFILESIZE in bash(1)
HISTSIZE=1000
HISTFILESIZE=2000

# check the window size after each command and, if necessary,
# update the values of LINES and COLUMNS.
shopt -s checkwinsize

# If set, the pattern "**" used in a pathname expansion context will
# match all files and zero or more directories and subdirectories.
#shopt -s globstar

# make less more friendly for non-text input files, see lesspipe(1)
[ -x /usr/bin/lesspipe ] && eval "$(SHELL=/bin/sh lesspipe)"

# set variable identifying the chroot you work in (used in the prompt below)
if [ -z "${debian_chroot:-}" ] && [ -r /etc/debian_chroot ]; then
    debian_chroot=$(cat /etc/debian_chroot)
fi

# set a fancy prompt (non-color, unless we know we "want" color)
case "$TERM" in
    xterm-color|*-256color) color_prompt=yes;;
esac

# uncomment for a colored prompt, if the terminal has the capability; turned
# off by default to not distract the user: the focus in a terminal window
# should be on the output of commands, not on the prompt
#force_color_prompt=yes

if [ -n "$force_color_prompt" ]; then
    if [ -x /usr/bin/tput ] && tput setaf 1 >&/dev/null; then
    # We have color support; assume it's compliant with Ecma-48
    # (ISO/IEC-6429). (Lack of such support is extremely rare, and such
    # a case would tend to support setf rather than setaf.)
    color_prompt=yes
    else
    color_prompt=
    fi
fi

#if [ "$color_prompt" = yes ]; then
#    PS1='${debian_chroot:+($debian_chroot)}\[\033[01;32m\]\u@\h\[\033[00m\]:\[\033[01;34m\]\w\[\033[00m\]\$ '
#else
#    PS1='${debian_chroot:+($debian_chroot)}\u@\h:\w\$ '
#fi
unset color_prompt force_color_prompt

# If this is an xterm set the title to user@host:dir
case "$TERM" in
xterm*|rxvt*)
    PS1="\[\e]0;${debian_chroot:+($debian_chroot)}\u@\h: \w\a\]$PS1"
    ;;
*)
    ;;
esac

# enable color support of ls and also add handy aliases
if [ -x /usr/bin/dircolors ]; then
    test -r ~/.dircolors && eval "$(dircolors -b ~/.dircolors)" || eval "$(dircolors -b)"
    alias ls='ls --color=auto'
    #alias dir='dir --color=auto'
    #alias vdir='vdir --color=auto'

    alias grep='grep --color=auto'
    alias fgrep='fgrep --color=auto'
    alias egrep='egrep --color=auto'
fi

# colored GCC warnings and errors
#export GCC_COLORS='error=01;31:warning=01;35:note=01;36:caret=01;32:locus=01:quote=01'

# Add an "alert" alias for long running commands.  Use like so:
#   sleep 10; alert
alias alert='notify-send --urgency=low -i "$([ $? = 0 ] && echo terminal || echo error)" "$(history|tail -n1|sed -e '\''s/^\s*[0-9]\+\s*//;s/[;&|]\s*alert$//'\'')"'

# enable programmable completion features (you don't need to enable
# this, if it's already enabled in /etc/bash.bashrc and /etc/profile
# sources /etc/bash.bashrc).
if ! shopt -oq posix; then
  if [ -f /usr/share/bash-completion/bash_completion ]; then
    . /usr/share/bash-completion/bash_completion
  elif [ -f /etc/bash_completion ]; then
    . /etc/bash_completion
  fi
fi

__has_parent_dir () {
    # Utility function so we can test for things like .git/.hg without firing up a
    # separate process
    test -d "$1" && return 0;

    current="."
    while [ ! "$current" -ef "$current/.." ]; do
        if [ -d "$current/$1" ]; then
            return 0;
        fi
        current="$current/..";
    done

    return 1;
}

__git_dirty() {
  local status=$(git status --porcelain 2> /dev/null)
  if [[ "$status" != "" ]]; then
    echo '🍄 '
  else
    echo '☀️ '
  fi
}

__vcs_name() {
    if [ -d .svn ]; then
        echo " [svn]";
    elif __has_parent_dir ".git"; then
        echo " [$(__git_ps1 'git %s')]";
    elif __has_parent_dir ".hg"; then
        echo " [hg $(hg branch)]"
    fi
}

black=$(tput -Txterm setaf 0)
red=$(tput -Txterm setaf 1)
green=$(tput -Txterm setaf 2)
yellow=$(tput -Txterm setaf 3)
dk_blue=$(tput -Txterm setaf 4)
pink=$(tput -Txterm setaf 5)
lt_blue=$(tput -Txterm setaf 6)
bold=$(tput -Txterm bold)
reset=$(tput -Txterm sgr0)
# Nicely formatted terminal prompt
# export PS1='\n\[$bold\]\[$black\][\[$dk_blue\]\@\[$black\]]-[\[$green\]\u\[$yellow\]@\[$green\]\h\[$black\]]-[\[$pink\]\w\[$black\]]\[\033[0;33m\]$(__vcs_name) \[\033[00m\]\[$reset\]\n\[$reset\]\$ '
export PS1='\[\033[01;32m\]\u\[\033[00m\] \[$bold\]\[$lt_blue\]\W\[$reset\]\[$red\]$(__vcs_name) 🍄  \[$reset\]'
# like: vagrant ~ [master]

# Put composer installs on the path
export PATH=$PATH:/home/vagrant/.config/composer/vendor/bin
export VISUAL=vim
export EDITOR=$VISUAL
export HISTTIMEFORMAT="%d/%m/%y %T "
#export MYSQL_PWD=secret

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
