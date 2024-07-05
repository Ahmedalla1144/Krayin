@extends('admin::layouts.anonymous-master')

@section('page_title')
    {{ __('admin::app.sessions.register.title') }}
@stop

@section('content')
    <div class="panel">
        <div class="panel-body">

            <div class="form-container">
                <h1>{{ __('admin::app.sessions.register.welcome') }}</h1>

                <form method="POST" action="{{ route('admin.session.register_store') }}" @submit.prevent="$root.onSubmit">
                    {!! view_render_event('admin.sessions.login.form_controls.before') !!}

                    @csrf

                    <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                        <label for="name">{{ __('admin::app.sessions.register.name') }}</label>

                        <input
                            type="text"
                            name="name"
                            class="control"
                            id="name"
                            value={{ fake()->name() }}
                            v-validate.disable="'required|min:3'"
                            data-vv-as="&quot;{{ __('admin::app.sessions.register.name') }}&quot;"
                            />

                        <span class="control-error" v-if="errors.has('name')">
                            @{{ errors.first('name') }}
                        </span>
                    </div>


                    <div class="form-group" :class="[errors.has('email') ? 'has-error' : '']">
                        <label for="email">{{ __('admin::app.sessions.login.email') }}</label>

                        <input
                            type="text"
                            name="email"
                            class="control"
                            id="email"
                            value="admin@example.com"
                            v-validate.disable="'required|email'"
                            data-vv-as="&quot;{{ __('admin::app.sessions.login.email') }}&quot;"
                            />

                        <span class="control-error" v-if="errors.has('email')">
                            @{{ errors.first('email') }}
                        </span>
                    </div>

                    <div class="form-group" :class="[errors.has('password') ? 'has-error' : '']">
                        <label for="password">{{ __('admin::app.sessions.login.password') }}</label>

                        <input
                            type="password"
                            name="password"
                            class="control"
                            id="password"
                            value="admin123"
                            v-validate.disable="'required|min:6'"
                            data-vv-as="&quot;{{ __('admin::app.sessions.login.password') }}&quot;"
                        />

                        <span class="control-error" v-if="errors.has('password')">
                            @{{ errors.first('password') }}
                        </span>
                    </div>

                    <div class="form-group" :class="[errors.has('confirm_password') ? 'has-error' : '']">
                        <label for="confirm_password">{{ __('admin::app.sessions.register.confirm-password') }}</label>

                        <input
                            type="password"
                            name="confirm_password"
                            class="control"
                            id="confirm_password"
                            value="admin123"
                            v-validate.disable="'required|min:6'"
                            data-vv-as="&quot;{{ __('admin::app.sessions.register.confirm-password') }}&quot;"
                        />


                        <span class="control-error" v-if="errors.has('confirm_password')">
                            @{{ errors.first('confirm_password') }}
                        </span>
                    </div>
                    <input type="password" name="role_id" class="control" hidden value="2">

                    {!! view_render_event('admin.sessions.login.form_controls.after') !!}

                    <a href="{{ route('admin.session.create') }}">{{ __('admin::app.sessions.login.login') }}</a>

                    <div class="button-group">
                        {!! view_render_event('admin.sessions.login.form_buttons.before') !!}

                        <button type="submit" class="btn btn-xl btn-primary">
                            {{ __('admin::app.sessions.register.register') }}
                        </button>

                        {!! view_render_event('admin.sessions.login.form_buttons.after') !!}
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(() => {
            $('input').keyup(({target}) => {
                if ($(target).parent('.has-error').length) {
                    $(target).parent('.has-error').addClass('hide-error');
                }
            });

            $('button').click(() => {
                $('.hide-error').removeClass('hide-error');
            });

            $(":input[name=name]").focus();
        });
    </script>
@endpush
