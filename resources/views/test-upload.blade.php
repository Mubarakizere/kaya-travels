<form action="/test-upload" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="thumbnail" required>
    <button type="submit">Upload Test Image</button>
</form>
