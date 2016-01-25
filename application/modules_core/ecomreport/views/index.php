<div class="container-fluid minheight">

    <table id="user-dataTable" class="table table-striped table-bordered  no-wrap" cellspacing="0" width="100%">

        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Total Selling</th>
                <th>Details</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (!empty($result)) {

                foreach ($result as $result):

                    $que = $this->db->query("select quantity as cnt from customer_orders where product_id='" . $result->product_id . "' and response='success' ");
                    $cnt = $que->result();

                    $newcount = "0";
                    foreach ($cnt as $count) {
                        $newcount = $newcount + $count->cnt;
                    }
                    ?>
                    <tr>
                        <td><img class="img-thumbnail center-block" src="<?php echo htmlspecialchars($result->image1, ENT_QUOTES, 'UTF-8'); ?>" width="100px"/><span class="center"><?php echo htmlspecialchars($result->name, ENT_QUOTES, 'UTF-8'); ?></span></td>
                        <td> 

                            <div class="desc" id="desc<?php echo $result->id; ?>">
        <?php
        $strlen = strlen($result->description);
        if ($strlen > 530) {
            echo substr($result->description, 0, 530);
            ?>
                                    ..........<span class="moretext" onclick="getdesc(<?php echo $result->id; ?>)">More ></span>
                                    <?php
                                } else {
                                    echo $result->description;
                                }
                                ?>
                            </div>
                        </td>

                        <td><?php echo htmlspecialchars(round($result->price,2), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo $newcount; ?></td>
                        <td><a class="headline" style="cursor:pointer;" href="<?php echo site_url("ecomreport/sellingreport/" . $result->product_id . "/" . $uid); ?>">View Details</a></td>
                    </tr>
        <?php
    endforeach;
}
?>
        </tbody>

    </table>

            <?php if ($this->ion_auth->is_admin()) { ?>

        <a href="<?php echo site_url('ecomreport/allbuyers'); ?>" class="btn btn-primary">Go Back</a>

<?php } ?> 

</div>   

<script>
    $(document).ready(function() {
        $("#user-dataTable").DataTable({
            ordering: true,
            "pageLength": 10,
            responsive: true
        });
    });

    function getdesc(id)
    {
        $.ajax({url: "<?php echo site_url('ecomreport/getdescription'); ?>",
            type: "post",
            data: {id: id},
            success: function(html)
            {
                document.getElementById('desc' + id).innerHTML = html;
            }});
    }

    function hidedesc(id)
    {
        $.ajax({url: "<?php echo site_url('ecomreport/hidedescription'); ?>",
            type: "post",
            data: {id: id},
            success: function(html)
            {
                document.getElementById('desc' + id).innerHTML = html;
            }});
    }
</script>
