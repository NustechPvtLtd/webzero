<div class="container-fluid minheight">

    <table id="user-dataTable" class="table table-striped table-bordered  no-wrap" cellspacing="0" width="100%">

        <thead>
            <tr>
                <th>Invoice #</th>
                <th>Transaction #</th>
                <th>Invoice Date</th>
                <th>Due Date</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (!empty($results)) {

                foreach ($results as $result):

                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($result->invoice_id, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($result->transaction_id, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars(date("jS M, Y, g:i a", $result->invoice_date), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars(date("jS M, Y, g:i a", $result->due_date), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo '<i class="fa fa-inr"></i> '.htmlspecialchars($result->total_amount, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo ($result->status==0)?'<span class="label label-danger">Unpaid</span>':'<span class="label label-primary">Paid</span>'; ?></td>
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
</script>
