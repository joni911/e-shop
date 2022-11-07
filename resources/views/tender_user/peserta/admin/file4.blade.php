{{-- <h3 class="text-center">File RKK</h3> --}}
<table class="table">
    <tbody>
        <tr class="text-center">
            @if ($file_rkk)
                @forelse ($file_rkk as $rkk)
                <td>
                    @include('tender_user.peserta.admin.smkk')
                </td>
                <td>
                    @include('tender_user.peserta.admin.komitmen')
                </td>
                @empty

                @endforelse
                @endif

        </tr>

    </tbody>
</table>
