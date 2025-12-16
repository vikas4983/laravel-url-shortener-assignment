<form action="{{ $route }}" method="POST" onsubmit="return confirmDelete();">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="mdi mdi-delete"></i>
    </button>
</form>
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this company?');
    }
</script>
