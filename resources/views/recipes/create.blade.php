<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<h1>Recipes</h1>
<form action="/recipes" method="POST" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="name">Title</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  <div class="form-group">
    <label for="time">time</label>
    <input type="text" class="form-control" id="time" name="time" placeholder="time">
  </div>
  <div class="form-group">
    <label for="steps">stappenplan</label>
    <textarea class="form-control" name="steps" id="steps" placeholder="steps"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
