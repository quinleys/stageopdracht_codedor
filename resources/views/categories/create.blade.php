<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<h1>Categories</h1>
<form action="/categories" method="POST" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>
  <div class="form-group">
    <label for="synopsis">synopsis</label>
    <textarea class="form-control" name="synopsis" id="synopsis" placeholder="synopsis"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
