<?php

require 'recipe/common.php';

server('main', '178.62.84.78', 22)
    ->path('/var/www/sarahperkins.eu')
    ->user('root')
    ->pubKey();

set('repository', 'git@github.com:allmarkedup/sarahperkins.eu.git');

task('deploy:grunt', function () {
    cd(env()->getReleasePath());
    write(run('pwd'));
    run("npm install --silent");
    run("grunt");
})->desc('Running grunt tasks');

task('deploy', [
    'deploy:start',
    'deploy:prepare',
    'deploy:update_code',
    'deploy:grunt',
    'deploy:vendors',
    'deploy:symlink',
    'cleanup',
    'deploy:end'
]);

