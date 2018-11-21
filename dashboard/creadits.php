<div class="page-title page-title-2">
    <h1 class="title">امتیاز های من</h1>
    <p class="desc">لیست امتیاز های کسب شده</p>
</div>

<div id="page-creadits">
    <?php
    $args = array(
        'post_type'         => 'shop_order',
        'post_status'       => 'All',
        'posts_per_page'    => 9999,
        'meta_query' => array(
            array(
                'key' => '_billing_phone',
                'value' => $_SESSION['verfied_mobile'],
                'compare' => '=',
            )
        )
    );
    $orders = get_posts( $args );
    $point_sum = 0;

    foreach ( $orders as $key => $value ) :
        $order_point = 0;
        $order = wc_get_order( $value->ID );
        if( !empty(get_post_meta($value->ID, "_order_point", true)) ) {
            $order_point = get_post_meta($value->ID, "_order_point", true);
            $point_sum += $order_point;
        }
    endforeach;

    ?>

    <div id="current-point">
        <h5 class="_txt">شما تاکنون</h5>
        <span class="_point"><?php echo $point_sum; ?></span>
        <h5 class="_txt">امتیاز کسب کرده‌‌اید!</h5>
    </div>

    <table id="collapse-table" class="table-order">
        <thead>
            <tr>
                <td>ردیف</td>
                <td>عنوان</td>
                <td>تاریخ</td>
                <td>امتیاز کسب شده</td>
            </tr>
        </thead>
        <tbody>
    <?php
    $c = 1;
    foreach ( $orders as $key => $value ) :
        $order_point = 0;
        $order = wc_get_order( $value->ID );
        if( !empty(get_post_meta($value->ID, "_order_point", true)) ) {
            $order_point = get_post_meta($value->ID, "_order_point", true);
        }
        if($order_point > 0) {
        ?>
        <tr>
            <td><?php echo $c; ?></td>
            <td>سفارش با کد <?php echo $value->ID; ?></td>
            <td><?php echo $order->order_date; ?></td>
            <td style="width: 15%;"><?php echo $order_point; ?></td>
        </tr>
        <?php } $c++; ?>
    <?php endforeach; ?>
        </tbody>
    </table>
</div>
