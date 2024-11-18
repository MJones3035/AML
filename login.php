<?php include("header.php"); ?>

<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-center pt-10">
    <form>
    <div class="form-group">
        <label for="userName">Username</label>
        <input type="text" class="form-control" id="userName" aria-describedby="nameHelp" placeholder="Enter user name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword2">Confirm Password</label>
        <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
     </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include("footer.php") ?>