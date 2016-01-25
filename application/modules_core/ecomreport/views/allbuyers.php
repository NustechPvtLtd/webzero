<div class="container-fluid minheight">

    <table id="user-dataTable" class="table table-striped table-bordered  no-wrap" cellspacing="0" width="100%">

        <thead>
            <tr>
                <th>Sellers Name</th>
                <th>Email</th>
                <th>Site Url</th>
                <th>Total Products</th>
                <th>Total selling</th>
                <th>Selling Amount</th>
                <th>Details</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (!empty($results)) {

                foreach ($results as $result):

                    $que = $this->db->query("select remote_url as url from sites where sites_id='" . $result->site_id . "' ");
                    $site = $que->result();
                    
                    $query = $this->db->query("select * from customer_orders inner join users_products on customer_orders.product_id=users_products.product_id where customer_orders.response='success' and users_products.user_id='" . $result->user_id . "' ") or die(mysql_error());
                    $cnt = $query->result();
                    $totalproducts = count($this->ecomreportmodel->getallproducts($result->user_id));
                    $amt = "0";
                    $qty = "0";

                    foreach ($cnt as $res) {
                        $amt = $amt + $res->amount;
                        $qty = $qty + $res->quantity;
                    }
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($result->first_name.' '.$result->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($result->email, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><a href="<?php echo (!empty($site[0]))?$site[0]->url:''; ?>" target="_blank"><?php echo (!empty($site[0]))?$site[0]->url:''; ?></a></td>
                        <td><?php echo htmlspecialchars($totalproducts, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($qty, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($amt, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><a class="headline" href="<?php echo site_url("ecomreport/index/" . $result->user_id); ?>">View Products</a></td>
                    </tr>
                    <?php
                endforeach;
            }
            ?>
        </tbody>

    </table>

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
