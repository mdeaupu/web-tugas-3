@props(['route', 'label' => 'Hapus'])

<form action="{{ $route }}" method="POST" class="inline-block"
    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:text-red-900">{{ $label }}</button>
</form>