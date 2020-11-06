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
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control">
        </div>
        <p>go to sign up -> <a href="index.php?page=signup">click</a></p>
        <div class="form-group">
            <button type="submit" name="signin" class="btn btn-success form-control">SIGNIN</button>
        </div>
    </form>
</div>
