<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( !$has_orders ) : ?>
<div class="ads-tabs">
    <ul class="tabs-header center">
        <li class="active">
            <button>Сдаю (7)</button>
        </li>
        <li>
            <button>Арендую (0)</button>
        </li>
    </ul>
    <div class="o-search">
        <form action="" class="form-search small" method="post">
            <input type="search" name="h-search" onkeyup="this.setAttribute('value', this.value);" value=""
                   placeholder="Номер заказа">
            <input type="submit" value="">
        </form>
    </div>
    <div class="tabs-content">
        <div class="content">
            <div class="orders-table">
                <div class="orders-table-header">
                    <div class="tr">
                        <div class="td">Статус аренды</div>
                        <div class="td" style="min-width: 270px;">Наименование</div>
                        <div class="td">Арендодатель</div>
                        <div class="td">Начало аренды</div>
                        <div class="td">Конец аренды</div>
                        <div class="td">Оплата</div>
                        <div class="td">Залог</div>
                    </div>
                </div>
                <div class="orders-table-body">
                    <div class="tr">
                        <div class="td">
                            <div class="status">Ждем арендодателя</div>
                            <div class="number">№231251</div>
                        </div>
                        <div class="td">
                            <div class="order-info">
                                <img src="https://rentclub.local/app/uploads/2021/03/beanie-2-324x324.jpg" alt="">
                                <div class="name">Детского автокресла Britax Romer Advansafix IV R</div>
                            </div>
                        </div>
                        <div class="td">
                            <div class="name">
                                Игорь Владимирович
                                Лысенко
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-start">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-end">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="price">350 руб.</div>
                            <div class="price-status">Оплачено</div>
                        </div>
                        <div class="td">
                            <div class="deposit">
                                0 руб.
                            </div>
                            <div class="deposit-status">Оплачено</div>
                        </div>
                    </div>
                    <div class="tr">
                        <div class="td">
                            <div class="status">Ждем арендодателя</div>
                            <div class="number">№231251</div>
                        </div>
                        <div class="td">
                            <div class="order-info">
                                <img src="https://rentclub.local/app/uploads/2021/03/beanie-2-324x324.jpg" alt="">
                                <div class="name">Детского автокресла Britax Romer Advansafix IV R</div>
                            </div>
                        </div>
                        <div class="td">
                            <div class="name">
                                Игорь Владимирович
                                Лысенко
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-start">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-end">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="price">350 руб.</div>
                            <div class="price-status">Оплачено</div>
                        </div>
                        <div class="td">
                            <div class="deposit">
                                0 руб.
                            </div>
                            <div class="deposit-status">Оплачено</div>
                        </div>
                    </div>
                    <div class="tr">
                        <div class="td">
                            <div class="status">Ждем арендодателя</div>
                            <div class="number">№231251</div>
                        </div>
                        <div class="td">
                            <div class="order-info">
                                <img src="https://rentclub.local/app/uploads/2021/03/beanie-2-324x324.jpg" alt="">
                                <div class="name">Детского автокресла Britax Romer Advansafix IV R</div>
                            </div>
                        </div>
                        <div class="td">
                            <div class="name">
                                Игорь Владимирович
                                Лысенко
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-start">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-end">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="price">350 руб.</div>
                            <div class="price-status">Оплачено</div>
                        </div>
                        <div class="td">
                            <div class="deposit">
                                0 руб.
                            </div>
                            <div class="deposit-status">Оплачено</div>
                        </div>
                    </div>
                    <div class="tr">
                        <div class="td">
                            <div class="status">Ждем арендодателя</div>
                            <div class="number">№231251</div>
                        </div>
                        <div class="td">
                            <div class="order-info">
                                <img src="https://rentclub.local/app/uploads/2021/03/beanie-2-324x324.jpg" alt="">
                                <div class="name">Детского автокресла Britax Romer Advansafix IV R</div>
                            </div>
                        </div>
                        <div class="td">
                            <div class="name">
                                Игорь Владимирович
                                Лысенко
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-start">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-end">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="price">350 руб.</div>
                            <div class="price-status">Оплачено</div>
                        </div>
                        <div class="td">
                            <div class="deposit">
                                0 руб.
                            </div>
                            <div class="deposit-status">Оплачено</div>
                        </div>
                    </div>
                    <div class="tr">
                        <div class="td">
                            <div class="status">Ждем арендодателя</div>
                            <div class="number">№231251</div>
                        </div>
                        <div class="td">
                            <div class="order-info">
                                <img src="https://rentclub.local/app/uploads/2021/03/beanie-2-324x324.jpg" alt="">
                                <div class="name">Детского автокресла Britax Romer Advansafix IV R</div>
                            </div>
                        </div>
                        <div class="td">
                            <div class="name">
                                Игорь Владимирович
                                Лысенко
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-start">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-end">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="price">350 руб.</div>
                            <div class="price-status">Оплачено</div>
                        </div>
                        <div class="td">
                            <div class="deposit">
                                0 руб.
                            </div>
                            <div class="deposit-status">Оплачено</div>
                        </div>
                    </div>
                    <div class="tr">
                        <div class="td">
                            <div class="status">Ждем арендодателя</div>
                            <div class="number">№231251</div>
                        </div>
                        <div class="td">
                            <div class="order-info">
                                <img src="https://rentclub.local/app/uploads/2021/03/beanie-2-324x324.jpg" alt="">
                                <div class="name">Детского автокресла Britax Romer Advansafix IV R</div>
                            </div>
                        </div>
                        <div class="td">
                            <div class="name">
                                Игорь Владимирович
                                Лысенко
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-start">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-end">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="price">350 руб.</div>
                            <div class="price-status">Оплачено</div>
                        </div>
                        <div class="td">
                            <div class="deposit">
                                0 руб.
                            </div>
                            <div class="deposit-status">Оплачено</div>
                        </div>
                    </div>
                    <div class="tr">
                        <div class="td">
                            <div class="status">Ждем арендодателя</div>
                            <div class="number">№231251</div>
                        </div>
                        <div class="td">
                            <div class="order-info">
                                <img src="https://rentclub.local/app/uploads/2021/03/beanie-2-324x324.jpg" alt="">
                                <div class="name">Детского автокресла Britax Romer Advansafix IV R</div>
                            </div>
                        </div>
                        <div class="td">
                            <div class="name">
                                Игорь Владимирович
                                Лысенко
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-start">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="date-end">
                                13.07.2020
                            </div>
                        </div>
                        <div class="td">
                            <div class="price">350 руб.</div>
                            <div class="price-status">Оплачено</div>
                        </div>
                        <div class="td">
                            <div class="deposit">
                                0 руб.
                            </div>
                            <div class="deposit-status">Оплачено</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="a-not-found">
                <div class="a-not-found-title">
                    Вы еще ничего не сдали в аренду
                </div>
                <div class="a-not-found-description">
                    Чем больше объявлений вы разместите тем чаще арендаторы будут обращаться к вам
                </div>
                <a href="/profile/ads/add" class="btn green" style="margin-top: 25px">Разместить объявление</a>
            </div>
        </div>
    </div>
</div>
<!--	<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">-->
<!--		<thead>-->
<!--			<tr>-->
<!--				--><?php //foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
<!--					<th class="woocommerce-orders-table__header woocommerce-orders-table__header---><?php //echo esc_attr( $column_id ); ?><!--"><span class="nobr">--><?php //echo esc_html( $column_name ); ?><!--</span></th>-->
<!--				--><?php //endforeach; ?>
<!--			</tr>-->
<!--		</thead>-->
<!---->
<!--		<tbody>-->
<!--			--><?php
//			foreach ( $customer_orders->orders as $customer_order ) {
//				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
//				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
//				?>
<!--				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status---><?php //echo esc_attr( $order->get_status() ); ?><!-- order">-->
<!--					--><?php //foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
<!--						<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell---><?php //echo esc_attr( $column_id ); ?><!--" data-title="--><?php //echo esc_attr( $column_name ); ?><!--">-->
<!--							--><?php //if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
<!--								--><?php //do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>
<!---->
<!--							--><?php //elseif ( 'order-number' === $column_id ) : ?>
<!--								<a href="--><?php //echo esc_url( $order->get_view_order_url() ); ?><!--">-->
<!--									--><?php //echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number() ); ?>
<!--								</a>-->
<!---->
<!--							--><?php //elseif ( 'order-date' === $column_id ) : ?>
<!--								<time datetime="--><?php //echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?><!--">--><?php //echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?><!--</time>-->
<!---->
<!--							--><?php //elseif ( 'order-status' === $column_id ) : ?>
<!--								--><?php //echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
<!---->
<!--							--><?php //elseif ( 'order-total' === $column_id ) : ?>
<!--								--><?php
//								/* translators: 1: formatted order total 2: total order items */
//								echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) );
//								?>
<!---->
<!--							--><?php //elseif ( 'order-actions' === $column_id ) : ?>
<!--								--><?php
//								$actions = wc_get_account_orders_actions( $order );
//
//								if ( ! empty( $actions ) ) {
//									foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
//										echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
//									}
//								}
//								?>
<!--							--><?php //endif; ?>
<!--						</td>-->
<!--					--><?php //endforeach; ?>
<!--				</tr>-->
<!--				--><?php
//			}
//			?>
<!--		</tbody>-->
<!--	</table>-->

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'woocommerce' ); ?></a>
		<?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
