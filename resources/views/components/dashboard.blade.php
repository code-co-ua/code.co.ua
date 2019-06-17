<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $data->lessons_count }}</h3>

                <p>
                    {{ trans_choice('messages.lessons', $data->lessons_count) }}
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            <a href="{{ url('admin/lessons') }}" class="small-box-footer">
                Детальніше <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $data->users_count }}</h3>

                <p>
                    {{ trans_choice('messages.users', $data->users_count) }}
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="{{ url('admin/users') }}" class="small-box-footer">
                Детальніше <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $data->questions_count }}</h3>

                <p>
                    {{ trans_choice('messages.questions', $data->questions_count) }}
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-question-circle"></i>
            </div>
            <a href="{{ url('admin/questions') }}" class="small-box-footer">
                Детальніше <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ $data->exercises_count }}</h3>

                <p>
                    {{ trans_choice('messages.exercises', $data->exercises_count) }}
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-briefcase"></i>
            </div>
            <a href="{{ url('admin/exercises') }}" class="small-box-footer">
                Детальніше <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>