@extends('layouts.master')

@section('content-header')
<h1>
    {{ trans('kantoku::themes.title') }}
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('user::users.breadcrumb.home') }}</a></li>
    <li class="active">{{ trans('kantoku::themes.breadcrumb.themes') }}</li>
</ol>
@stop

@push('css-stack')
    <style>
        .jsUpdateModule {
            transition: all .5s ease-in-out;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="data-table table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('kantoku::modules.table.name') }}</th>
                            <th width="15%">{{ trans('kantoku::themes.type') }}</th>
                            <th width="15%">{{ trans('kantoku::modules.table.version') }}</th>
                            <th width="15%">{{ trans('kantoku::modules.table.enabled') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($themes)): ?>
                            <?php foreach ($themes as $theme): ?>
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.kantoku.themes.show', [$theme->getName()]) }}">
                                            {{ $theme->getName() }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.kantoku.themes.show', [$theme->getName()]) }}">
                                            {{ $theme->type }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.kantoku.themes.show', [$theme->getName()]) }}">
                                            {{ theme_version($theme) }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.kantoku.themes.show', [$theme->getName()]) }}">
                                            <span class="label label-{{$theme->active ? 'success' : 'danger'}}">
                                                {{ $theme->active ? trans('kantoku::modules.enabled') : trans('kantoku::modules.disabled') }}
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>{{ trans('kantoku::modules.table.name') }}</th>
                            <th>{{ trans('kantoku::themes.type') }}</th>
                            <th>{{ trans('kantoku::modules.table.version') }}</th>
                            <th>{{ trans('kantoku::modules.table.enabled') }}</th>
                        </tr>
                        </tfoot>
                    </table>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
@stop

@push('js-stack')
    <?php $locale = locale(); ?>
    <script>
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "asc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                },
                "columns": [
                    null,
                    null,
                    null,
                    null,
                ]
            });
        });
    </script>
<script>
$( document ).ready(function() {
    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
    $('.jsUpdateModule').on('click', function(e) {
        $(this).data('loading-text', '<i class="fa fa-spinner fa-spin"></i> Loading ...');
        var $btn = $(this).button('loading');
        var token = '<?= csrf_token() ?>';
        $.ajax({
            type: 'POST',
            url: '<?= route('admin.kantoku.modules.update') ?>',
            data: {module: $btn.data('module'), _token: token},
            success: function(data) {
                console.log(data);
                if (data.updated) {
                    $btn.button('reset');
                    $btn.removeClass('btn-primary');
                    $btn.addClass('btn-success');
                    $btn.html('<i class="fa fa-check"></i> Module updated!')
                    setTimeout(function() {
                        $btn.removeClass('btn-success');
                        $btn.addClass('btn-primary');
                        $btn.html('Update')
                    }, 2000);
                }
            }
        });
    });
});
</script>
@endpush
