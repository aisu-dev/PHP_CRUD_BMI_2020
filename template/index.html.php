<div class="container mt-5">

    <table class="table">
    
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>NAME</th>
                <th>HEIGHT( m. )</th>
                <th>WEIGHT( kg. )</th>
                <th>BMI</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($info as $item){
                    echo 
                        '<tr>'
                            .'<td>'.$item['id'].'</td>'
                            .'<td>'.$item['name'].'</td>'
                            .'<td>'.$item['height'].'</td>'
                            .'<td>'.$item['weight'].'</td>'
                            .'<td>'.$item['bmi'].'</td>'
                        .'</tr>'
                    ;
                }
            ?>
        </tbody>

    </table>

</div>