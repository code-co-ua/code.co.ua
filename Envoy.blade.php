@servers(['web' => $server])

@include('app/Domain/Exercise/Enums/InstanceStatus.php')

@setup
    use Domain\Exercise\Enums\InstanceStatus;

    $basePath = '/home/ostap';
    $coursePath = "$basePath/exercises/$courseDirectory";
    $exercisePath = "$coursePath/$exerciseDirectory";
    $authConfigPath = "$basePath/vhost.d/$domain";

    /** @see LaunchExerciseContainerJob::class */
    $messageDelimiter = ':!%:';
@endsetup

@task('launch-instance', ['on' => ['web']])
    echo 'Status{{ $messageDelimiter.InstanceStatus::UPDATING }}';
    mkdir -p {{ $coursePath }}

    # Clone or update exercise
    if [ ! -d "{{ $exercisePath }}" ]; then
        git clone {{ $exercise_git_path }} "{{ $exercisePath }}"
    else
        cd {{ $exercisePath }}
        git pull
    fi

    echo 'Status{{ $messageDelimiter.InstanceStatus::SETTING_AUTH }}';

    mkdir -p {{ $exercisePath }}
    cd {{ $exercisePath }}

    {
        echo "set $cookie_value '{{ $session_cookie }}';"; \
        echo "if ($cookie_codecouasession != $cookie_value) {"; \
        echo "  return 200 'access denied';"; \
        echo "}"; \
    } >> {{ $authConfigPath }}

    echo 'Status{{ $messageDelimiter.InstanceStatus::RUNNING_IDE }}';

    # todo - replace theia to custom container image (which contain needed language & tools)
    containerId=$(docker run -it -d \
                    -e VIRTUAL_HOST={{ $domain }} \
                    -e VIRTUAL_PORT=3000 \
                    --init \
                    -v "$(pwd):/home/project:cached" \
                    theiaide/theia:next)
    docker cp "{{ $exercisePath }}" "$containerId":"/home/project"
    echo "Container{{ $messageDelimiter }}$containerId";
@endtask

@task('initialize-server')
    docker run -d -p 80:80 -p 443:443 \
            -v $home/vhost.d:/etc/nginx/vhost.d:ro \
            -v /var/run/docker.sock:/tmp/docker.sock:ro \
            jwilder/nginx-proxy
    mkdir ~/exercises
@endtask