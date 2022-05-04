
@if ($message = Session::get('success'))

<x-adminlte-alert theme="success" title="Success" dismissable>
    <strong>{{ $message }}</strong>
</x-adminlte-alert>

@endif


@if ($message = Session::get('error'))
<x-adminlte-alert theme="danger" title="Danger" dismissable>
    <strong>{{ $message }}</strong>
</x-adminlte-alert>

@endif


@if ($message = Session::get('warning'))

<x-adminlte-alert theme="warning" title="Warning" dismissable>
    <strong>{{ $message }}</strong>
</x-adminlte-alert>


@endif


@if ($message = Session::get('info'))
<x-adminlte-alert theme="info" title="Info" dismissable>
    <strong>{{ $message }}</strong>
</x-adminlte-alert>

@endif



@if ($errors->any())
<x-adminlte-card title="Eror" theme="danger" icon="fas fa-lg fa-exclamation-circle" collapsible removable maximizable>
    <ul class="text-justify">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</x-adminlte-card>
@endif
