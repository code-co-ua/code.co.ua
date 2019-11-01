@servers(['web' => $server])

@task('server-prepare', ['on' => ['web']])
    git clone https://github.com/code-co-ua/exercises-server
    cd exercises-server
    make install
@endtask

@task('server-update', ['on' => ['web']])
    cd exercises-server
    make update
@endtask

@task('launch-instance')
    cd $HOME/exercises/exercises-{{ $language }}
    make launch-instance exercise={{ $exercise }}
@endtask