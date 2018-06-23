<?php foreach ($changelog['versions'] as $version => $info): ?>
<dl class="dl-horizontal">
    <dt>
        <?php if (str_contains($version, ['unreleased', 'dev'])): ?>
            {{ $version }}
        <?php else: ?>
            <a href="{{ $changelog['url'].'/releases/tag/'.$version }}" target="_blank">
                <i class="fa fa-external-link-square"></i> {{ $version }}
            </a>
        <?php endif; ?>
    </dt>
    <dd>
        <?php if (isset($info['added'])): ?>
        @include('kantoku::admin.modules.partials.changelog-part', [
            'title' => trans('kantoku::modules.added'),
            'label' => 'success',
            'color' => 'green',
            'data' => $info['added']
        ])
        <?php endif; ?>
        <?php if (isset($info['changed'])): ?>
        @include('kantoku::admin.modules.partials.changelog-part', [
            'title' => trans('kantoku::modules.changed'),
            'label' => 'warning',
            'color' => 'orange',
            'data' => $info['changed']
        ])
        <?php endif; ?>
        <?php if (isset($info['removed'])): ?>
        @include('kantoku::admin.modules.partials.changelog-part', [
            'title' => trans('kantoku::modules.removed'),
            'label' => 'danger',
            'color' => 'red',
            'data' => $info['removed']
        ])
        <?php endif; ?>
    </dd>
</dl>
<?php endforeach; ?>
