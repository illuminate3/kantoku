{!! Form::open(['route' => 'admin.kantoku.workbench.seed.index', 'method' => 'post']) !!}
    <div class="box-body">
        <div class='form-group{{ $errors->has('module') ? ' has-error' : '' }}'>
            {!! Form::label('module', trans('kantoku::workbench.form.module name')) !!}
            {!! Form::select('module', $modules, null, ['class' => 'form-control']) !!}
            {!! $errors->first('module', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-flat">{{ trans('kantoku::workbench.button.seed') }}</button>
    </div>
{!! Form::close() !!}