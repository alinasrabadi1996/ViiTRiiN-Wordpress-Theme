<?php
BEWPI();
?>
<div class="page-title page-title-2">
    <h1 class="title">سفارش های من</h1>
    <p class="desc">لیست سفارشات ثبت شده در ویترین</p>
</div>
<table id="collapse-table" class="table-order">
    <thead>
        <tr>
            <td>ردیف</td>
            <td>کد سفارش</td>
            <td>تاریخ</td>
            <td>مبلغ کل</td>
            <td>نوع</td>
            <td>وضعیت</td>
            <td>جزئیات</td>
        </tr>
    </thead>
    <tbody>
    <?php
    $args = array(
        'post_type'         => 'shop_order',
        'post_status'       => 'All',
        'posts_per_page'    => 999,
        'meta_query' => array(
            array(
                'key' => '_billing_phone',
                'value' => $_SESSION['verfied_mobile'],
                'compare' => '=',
            )
        )
    );
    $orders = get_posts( $args );
    $inc = 0;
    foreach ( $orders as $key => $value ) {
        $inc++;
        $order = wc_get_order( $value->ID );

        switch($order->get_status()) {
            case "failed" :
                $product_status = "ناموفق";
                $status_label = "label-danger";
                break;
            case "refunded" :
                $product_status = "مسترد شده";
                $status_label = "label-danger";
                break;
            case "cancelled" :
                $product_status = "لغو شده";
                $status_label = "label-danger";
                break;
            case "completed" :
                $product_status = "تکمیل شده";
                $status_label = "label-success";
                break;
            case "on-hold" :
                $product_status = "در انتظار بررسی";
                $status_label = "label-primary";
                break;
            case "processing" :
                $product_status = "در انتظار بررسی";
                $status_label = "label-info";
                break;
            case "pending" :
                $product_status = "در انتظار پرداخت";
                $status_label = "label-megna";
                break;
            default :
                $product_status = "در حال انجام";
                $status_label = "label-info";
        }

        ?>
        <tr class="order">
            <td><?php echo $inc; ?></td>
            <td><?php echo $order->get_order_number(); ?></td>
            <td><?php echo $order->order_date; ?></td>
            <td><?php echo wc_price($order->get_total()); ?></td>
            <td>سفارش</td>
            <td><span class="label <?php echo $status_label; ?>"><?php echo $product_status; ?></span></td>
            <td><a class="collapse-md" item-id="<?php echo $order->get_order_number(); ?>"><i class="icon icon-keyboard_arrow_down"></i></a></td>
        </tr>
        <tr class="tr-data" item-id="<?php echo $order->get_order_number(); ?>" style="display: none;">
            <td colspan="8">
                <div class="order-items">
                    <table class="table-order">
                        <thead>
                        <tr>
                            <td>کالا</td>
                            <td>تعداد</td>
                            <td>قیمت واحد</td>
                            <td>قیمت کل</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($order->get_items() as $item_key => $item_values):
                            ?>
                            <tr>
                                <?php
                                $item_id = $item_values->get_id();
                                $item_name = $item_values->get_name(); // Name of the product
                                $item_type = $item_values->get_type(); // Type of the order item ("line_item")

                                $product_id = $item_values->get_product_id(); // the Product id
                                $wc_product = $item_values->get_product(); // the WC_Product object
                                $item_data = $item_values->get_data();

                                $product_name = $item_data['name'];
                                $product_id = $item_data['product_id'];
                                $tax_class = $item_data['tax_class'];
                                $line_subtotal = $item_data['subtotal'];
                                $line_subtotal_tax = $item_data['subtotal_tax'];
                                $line_total = $item_data['total'];
                                $line_total_tax = $item_data['total_tax'];
                                $product_quantity = $item_data['quantity'];
                                ?>
                                <td><?php echo $product_name; ?></td>
                                <td><?php echo $product_quantity; ?></td>
                                <td><?php echo wc_price($line_subtotal); ?></td>
                                <td><?php echo wc_price($product_quantity * $line_subtotal); ?></td>
                            </tr>
                            <?php 
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
        <?php
    } // End Foreach
    ?>
    </tbody>
</table>
