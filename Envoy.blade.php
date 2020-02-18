@servers(['web' => $server])

@setup
    /**
     * Must be a valid repository name
     * @var string $exercise
     */

    /**
     * Url for public git repository
     * @var string $exercise_git_path
     */

    $coursePath = "~/exercises/$course";
    $exercisePath = "$coursePath/$exercise";
@endsetup

@task('launch-instance', ['on' => ['web']])
    echo '{{ $exercisePath }}';
    # Clone or update exercise
    if [ ! -d "{{ $exercisePath }}" ]; then
        git clone {{ $exercise_git_path }} "{{ $exercisePath }}"
    else
        cd "{{ $exercisePath }}"
        git pull
    fi

    # Set-up authorization by cookie
    { \
        echo "set $cookie_value '{{ $session_cookie }}';"; \
        echo 'if ($cookie_codecouasession != $cookie_value) {'; \
        echo '  return 200 'access denied';'; \
        echo '}'; \
    } > ~/vhost.d/{{ $domain }}

    # todo - replace theia to custom container image (which contain needed language & tools)
    containerId=$(docker run -it -d \
                    -e VIRTUAL_HOST={{ $domain }} \
                    -e VIRTUAL_PORT=3000 \
                    --init \
                    -v "$(pwd):/home/project:cached" \
                    theiaide/theia:next)
    echo "$containerId";
    docker cp "$exercisePath" "$containerId":"/home/project"

@endtask

@task('initialize-server')
    docker run -d -p 80:80 -p 443:443 \
            -v $home/vhost.d:/etc/nginx/vhost.d:ro \
            -v /var/run/docker.sock:/tmp/docker.sock:ro \
            jwilder/nginx-proxy
@endtask