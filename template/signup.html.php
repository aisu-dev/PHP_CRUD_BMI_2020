<div class="container mt-5">
<?php if(isset($err)){ ?>
    <div class="alert alert-danger">
        <ul>
        <?php 
            
                foreach($err as $e){
                    echo '<li>'.$e.'</li>';
                }
            
            ?>
        </ul>
    </div>
    <?php } ?>
    <form method="post">
        <div class="form-group">
            <label for="email">Name:</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control">
        </div>
        <p>go to sign in -> <a href="index.php?page=signin">click</a></p>
        <div class="form-group">
            <button type="submit" name="signup" class="btn btn-success form-control">SIGNUP</button>
        </div>
    </form>
</div>