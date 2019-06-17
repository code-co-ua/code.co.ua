@extends('layouts.app')

@section('title', 'Історія змін')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Змінені дані</h2>
                <div class="alert alert-warning" role="alert">
                    <strong>Примітка:</strong> <span class="text-success">зеленим</span> кольором позначено нові дані, <span class="text-danger cm-strikethrough">червоним</span> - видалені
                </div>
                <div class="content">
                    @foreach($audit->old_values as $key => $value)
                        <diff one="{{ $value }}" other="{{ $audit->new_values[$key] }}"></diff>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection