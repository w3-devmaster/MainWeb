@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            alertify.set('notifier', 'position', 'bottom-right');
            alertify.error('{{ $error }}')
            console.log('{{ session('msg') }}');
        </script>
    @endforeach
@endif

@if (session('alert'))
    @if (session('resp') == 'success')
        <script>
            alertify.set('notifier', 'position', 'bottom-right');
            alertify.success('{{ session('msg') }}')
            console.log('{{ session('msg') }}');
        </script>
    @endif

    @if (session('resp') == 'error')
        <script>
            alertify.set('notifier', 'position', 'bottom-right');
            alertify.error('{{ session('msg') }}')
            console.log('{{ session('msg') }}');
        </script>
    @endif
@endif
