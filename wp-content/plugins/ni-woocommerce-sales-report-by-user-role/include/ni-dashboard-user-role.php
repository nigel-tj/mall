<?php 
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'Ni_Dashboard_User_Role' ) ) {
	class Ni_Dashboard_User_Role{
		function init(){
			?>
			<div class="parent_content">
				<div class="content">
					<div style="height:50px;">
					<div style="border-bottom:2px solid #e7eaec; padding-top:25px"></div>
				</div>
					
					<div class="ni-pro-info">
            	<h3 style="text-align:center; font-size:20px; padding:0px; margin:10px; color:#78909C ">
            	Monitor your sales and grow your online business
                </h3>
				
				<h1 style="text-align:center; color:#2cc185">Buy Ni WooCommerce Sales Report Pro @ $24.00</h1>
				<div style="width:33%; float:left; padding:5px">
					<ul>
						<li>Dashboard order Summary</li>
						<li>Order List - Display order list</li>
						<li>Order Detail - Display Product information</li>
                        <li style="font-weight:bold; color:#2cc185">Sold Product variation Report</li>
						<li>Customer Sales Report</li>
					</ul>
				</div>
				<div style="width:33%;padding:5px; float:left">
					<ul>
						<li>Payment Gateway Sales Report</li>
						<li>Country Sales Report</li>
						<li>Coupon Sales Report</li>
						<li>Order Status Sales Report</li>
                        <li style="font-weight:bold; color:#2cc185">Stock Report(Simple, Variable and Variation Product)</li>
					</ul>
				</div>
				<div>
					<ul>
						<li><span style="color:#26A69A">Email at: <a href="mailto:support@naziinfotech.com">support@naziinfotech.com</a></span></li>
						<li><a href="http://demo.naziinfotech.com?demo_login=woo_sales_report" target="_blank">View Demo</a>  </li>
						<li><a href="http://naziinfotech.com/?product=ni-woocommerce-sales-report-pro" target="_blank">Buy Now</a>  </li>
						<li>Coupon Code: <span style="color:#26A69A; font-size:16px"><span style="font-size:24px; font-weight:bold;color:#F00">ni24</span> Get 24% OFF </span></li>
						
					</ul>
				 </div>
				 
			   
				  <div style="clear:both"></div>
				  <div style="width:100%;padding:5px; float:left">
                  <p  style="width:100%;padding:5px; font-size:14px;color:#F00">
                  <strong>
                  We will create new custom report as per custom requirement, if you require more analytic report or require any customization in this report then please feel free to contact with us.
                  </strong>
                  </p>
               
				  <b> For any WordPress or woocommerce customization, queries and support please email at : <strong><a href="mailto:support@naziinfotech.com">support@naziinfotech.com</a></strong></b>
				  </div>
				  <div style="clear:both"></div>
				  
			</div>
					<div class="box-title"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard - Sales Analysis</div>
					<div style="border-bottom:1px solid #880E4F;"></div>
					<div class="box-data">
						<div class="columns-box">
							<div class="columns-title">Total Sales</div>
							<div>
								<div class="columns-icon" style="color:#BA68C8"><i class="fa fa-cart-plus fa-4x"></i></div>
								<div class="columns-value" style="color:#BA68C8"><?php  echo wc_price( $this->get_total_sales("ALL")); ?></div>	
							</div>
						</div>
						<div class="columns-box">
							<div class="columns-title">This Year Sales</div>
							<div>
								<div class="columns-icon"  style="color:#EF6C00"><i class="fa fa-cart-plus fa-4x"></i></div>
								<div class="columns-value"  style="color:#EF6C00"><?php  echo wc_price( $this->get_total_sales("YEAR")); ?></div>	
							</div>
						</div>
						<div class="columns-box">
							<div class="columns-title">This Month Sales</div>
							<div>
								<div class="columns-icon"  style="color:#00897B"><i class="fa fa-cart-plus fa-4x"></i></div>
								<div class="columns-value" style="color:#00897B"><?php  echo wc_price( $this->get_total_sales("MONTH")); ?></div>	
							</div>
						</div>
						<div class="columns-box">
							<div class="columns-title">This Week Sales</div>
							<div>
								<div class="columns-icon" style="color:#039BE5"><i class="fa fa-cart-plus fa-4x"></i></div>
								<div class="columns-value" style="color:#039BE5"><?php  echo wc_price( $this->get_total_sales("WEEK")); ?></div>	
							</div>
						</div>
						<div class="columns-box">
							<div class="columns-title">Today Sales</div>
							<div>
								<div class="columns-icon"  style="color:#795548"><i class="fa fa-cart-plus fa-4x"></i></div>
								<div class="columns-value"  style="color:#795548"><?php  echo wc_price( $this->get_total_sales("DAY")); ?></div>	
							</div>
	
						</div>
						<div style="clear:both"></div>
					</div>
					<div class="box-data">
						<div class="columns-box">
							<div class="columns-title">Total Sales Count</div>
							<div>
								<div class="columns-icon" style="color:#BA68C8"><i class="fa fa-line-chart fa-3x"></i></div>
								<div class="columns-value" style="color:#BA68C8"><?php echo $this->get_total_sales_count("ALL"); ?></div>	
							</div>
						</div>
						<div class="columns-box">
							<div class="columns-title">This Year Sales Count</div>
							<div>
								<div class="columns-icon" style="color:#EF6C00"><i class="fa fa-line-chart fa-3x"></i></div>
								<div class="columns-value" style="color:#EF6C00"><?php echo $this->get_total_sales_count("YEAR"); ?></div>	
							</div>
						</div>
						<div class="columns-box">
							<div class="columns-title">This Month Sales Count</div>
							<div>
								<div class="columns-icon"  style="color:#00897B"><i class="fa fa-line-chart fa-3x"></i></div>
								<div class="columns-value"  style="color:#00897B"><?php echo $this->get_total_sales_count("MONTH"); ?></div>
							</div>
						</div>
						<div class="columns-box">
							<div class="columns-title">This Week Sales Count</div>
							<div>
								<div class="columns-icon" style="color:#039BE5"><i class="fa fa-line-chart fa-3x"></i></div>
								<div class="columns-value" style="color:#039BE5"><?php echo $this->get_total_sales_count("WEEK"); ?></div>
							</div>
						</div>
						<div class="columns-box">
							<div class="columns-title">Today Sales Count</div>
							<div>
								<div class="columns-icon" style="color:#795548"><i class="fa fa-line-chart fa-3x"></i></div>
								<div class="columns-value" style="color:#795548"><?php echo $this->get_total_sales_count("DAY"); ?></div>
							</div>
						</div>
						<div style="clear:both"></div>
					</div>
					
                    <div class="box-title"><i class="fa fa-pie-chart" aria-hidden="true"></i><?php _e('Today  Sales Analysis', 'NiWooCommerceSalesReport'); ?> </div>
				<div style="border-bottom:4px solid #880E4F;"></div>
                <div class="box-data">
					<div class="columns-box" >
						<div class="columns-title"><?php _e('Today Order Count', 'NiWooCommerceSalesReport'); ?></div>
						<div>
							<div class="columns-icon" style="color:#BA68C8"><i class="fa fa-user-circle fa-3x"></i></div>
							<div class="columns-value" style="color:#BA68C8">
							
							<?php echo $this->get_total_sales_count("DAY"); ?>
                            </div>	
						</div>
					</div>
					<div class="columns-box">
						<div class="columns-title"><?php _e('Today Sales', 'NiWooCommerceSalesReport'); ?></div>
						<div>
							<div class="columns-icon" style="color:#EF6C00"><i class="fa fa-user fa-3x"></i></div>
							<div class="columns-value" style="color:#EF6C00"><?php echo wc_price( $this->get_total_sales("DAY")); ?></div>	
						</div>
					</div>
					<div class="columns-box">
						<div class="columns-title"><?php _e('Today Product Sold', 'NiWooCommerceSalesReport'); ?></div>
						<div>
							<div class="columns-icon"  style="color:#00897B"><i class="fa fa-product-hunt fa-3x"></i></div>
							<div class="columns-value"  style="color:#00897B"><?php echo $this->get_sold_product_count( date_i18n("Y-m-d"), date_i18n("Y-m-d")); ?></div>
						</div>
					</div>
					<div class="columns-box" >
						<div class="columns-title"><?php _e('Today Discount', 'NiWooCommerceSalesReport'); ?></div>
						<div>
							<div class="columns-icon" style="color:#039BE5"><i class="fa fa-minus-square fa-3x"></i></div>
							<div class="columns-value" style="color:#039BE5"><?php echo wc_price($this->get_total_discount(date_i18n("Y-m-d"), date_i18n("Y-m-d"))); ?></div>
						</div>
					</div>
					<div class="columns-box" >
						<div class="columns-title"><?php _e('Today Tax', 'NiWooCommerceSalesReport'); ?></div>
						<div>
							<div class="columns-icon" style="color:#795548"><i class="fa fa-plus-square fa-3x"></i></div>
							<div class="columns-value" style="color:#795548"><?php echo  wc_price($this->get_total_tax( date_i18n("Y-m-d"), date_i18n("Y-m-d"))); ?></div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
				</div>
				<div class="content">
					<div class="box-title"><i class="fa fa-pie-chart" aria-hidden="true"></i> recent orders</div>
					<div style="border-bottom:1px solid #880E4F;"></div>
					<div class="box-data">
						<table class="data-table">
							<tr>
							   <th>Order ID</th>
								<th>Order Date</th>
								<th>First Name</th>
								<th>Email</th>
								<th>Country</th>
								<th>Order Status</th>
								<th>Currency</th>
								<th>Order Total</th>
							</tr>
						   <?php $order_data = $this->get_recent_order_list();   ?>
						   <?php foreach($order_data as $key=>$v){ ?>
						   <tr>
								<td><?php echo $v->order_id; ?></td>
								<td><?php echo $v->order_date; ?></td>
								<td><?php echo $v->billing_first_name; ?></td>
								<td><?php echo $v->billing_email; ?></td>
								<td><?php echo $v->billing_country; ?></td>
								<td><?php echo  ucfirst ( str_replace("wc-","", $v->order_status)); ?></td>
								<td><?php echo $v->order_currency; ?></td>
								<td style="text-align:right"><?php echo wc_price($v->order_total); ?></td>
							</tr>
							<?php } ?>
						</table>
					</div>
				</div>
				<div style="height:50px;">
					<div style="border-bottom:2px solid #e7eaec; padding-top:25px"></div>
				</div>
			</div>
			<?php
			}
			function get_sold_product_count($start_date=NULL,$end_date =NULL){
				  global $wpdb;
				  $query = " SELECT  SUM(qty.meta_value) as sold_product_count  ";
				  $query .= " FROM {$wpdb->prefix}posts as posts ";
				  $query .= " LEFT JOIN  {$wpdb->prefix}woocommerce_order_items as line_item ON line_item.order_id=posts.ID  " ;
				  
				   $query .= "  LEFT JOIN  {$wpdb->prefix}woocommerce_order_itemmeta as qty ON qty.order_item_id=line_item.order_item_id  ";
				  
				  $query .= " WHERE 1=1 ";
				  
				  
				  $query .= " AND posts.post_type ='shop_order' ";
				  $query .= " AND qty.meta_key ='_qty' ";
				  $query .= " AND line_item.order_item_type ='line_item' ";
				  $query .= " AND posts.post_status IN ('wc-processing','wc-on-hold', 'wc-completed')";
				 /*Wooc Include refund item in sold product count*/
				// $query .= " AND posts.post_status IN ('wc-processing','wc-on-hold', 'wc-completed','wc-refunded')";
				  
				  if ($start_date && $end_date)
					$query .= " AND date_format( posts.post_date, '%Y-%m-%d') BETWEEN  '{$start_date}' AND '{$end_date}'";	
					
				$results = $wpdb->get_var($query);	
				$results = isset($results) ? $results : "0";	
				return $results;
				  
			}
			function get_total_discount($start_date= NULL ,$end_date=NULL){
				 global $wpdb;	
				 $query = "";
				 $query = " SELECT
						
						SUM(woocommerce_order_itemmeta.meta_value) as total_discount
						
						FROM {$wpdb->prefix}posts as posts			
						LEFT JOIN  {$wpdb->prefix}woocommerce_order_items as woocommerce_order_items ON woocommerce_order_items.order_id=posts.ID 
						
						LEFT JOIN  {$wpdb->prefix}woocommerce_order_itemmeta as woocommerce_order_itemmeta ON woocommerce_order_itemmeta.order_item_id=woocommerce_order_items.order_item_id 
						
						
						WHERE 1=1
						AND posts.post_type ='shop_order'  ";
						
				$query .= " AND woocommerce_order_items.order_item_type ='coupon' ";	
				
				$query .= " AND woocommerce_order_itemmeta.meta_key ='discount_amount' ";	
					
				$query .= " AND posts.post_status IN ('wc-processing','wc-on-hold', 'wc-completed') ";
				if ($start_date && $end_date)
					$query .= " AND date_format( posts.post_date, '%Y-%m-%d') BETWEEN  '{$start_date}' AND '{$end_date}'";	
				
				$results = $wpdb->get_var( $query);	
				return $results ;
				//$this->print_data($results);
			}
			function get_total_tax($start_date =NULL, $end_date=NULL){
			 global $wpdb;	
			 $query = "";
			 //shipping_tax_amount
			$query = " SELECT " ;
			
			//10.13		
			$query .= "	(ROUND(SUM(woocommerce_order_itemmeta.meta_value),2)+  ROUND(SUM(shipping_tax_amount.meta_value),2)) as total_tax ";
			
			//10.12
			//$query .= "	(SUM(ROUND(woocommerce_order_itemmeta.meta_value,2))+  SUM(ROUND(shipping_tax_amount.meta_value,2))) as total_tax ";
					
				$query .= "	 FROM {$wpdb->prefix}posts as posts			
					LEFT JOIN  {$wpdb->prefix}woocommerce_order_items as woocommerce_order_items ON woocommerce_order_items.order_id=posts.ID 
					
					LEFT JOIN  {$wpdb->prefix}woocommerce_order_itemmeta as woocommerce_order_itemmeta ON woocommerce_order_itemmeta.order_item_id=woocommerce_order_items.order_item_id 
					
					
					LEFT JOIN  {$wpdb->prefix}woocommerce_order_itemmeta as shipping_tax_amount ON shipping_tax_amount.order_item_id=woocommerce_order_items.order_item_id 
					
					
					
					WHERE 1=1
					AND posts.post_type ='shop_order'  ";
					
			$query .= " AND woocommerce_order_items.order_item_type ='tax' ";	
			
			$query .= " AND woocommerce_order_itemmeta.meta_key ='tax_amount' ";
			
			$query .= " AND shipping_tax_amount.meta_key ='shipping_tax_amount' ";	
				
			//$query .= " AND posts.post_status IN ('wc-processing','wc-on-hold', 'wc-completed','wc-pending') ";
			
			$query .= " AND posts.post_status IN ('wc-processing','wc-on-hold', 'wc-completed')";
			/*
			if ($this->report_order_status ==""){
					$query .= " AND posts.post_status IN ('wc-processing','wc-on-hold', 'wc-completed','wc-refunded')";
			}else{
				 $query .= " AND posts.post_status IN ('{$this->report_order_status}')";
			}
			*/
			
			if ($start_date && $end_date)
				$query .= " AND date_format( posts.post_date, '%Y-%m-%d') BETWEEN  '{$start_date}' AND '{$end_date}'";	
			
			$results = $wpdb->get_var( $query);	
			return $results;
			//$this->print_data($results);
		 }	
			function get_total_sales($period="CUSTOM",$start_date=NULL,$end_date=NULL){
				global $wpdb;	
				$query = "SELECT
						SUM(order_total.meta_value)as 'total_sales'
						FROM {$wpdb->prefix}posts as posts			
						LEFT JOIN  {$wpdb->prefix}postmeta as order_total ON order_total.post_id=posts.ID 
						
						WHERE 1=1
						AND posts.post_type ='shop_order' 
						AND order_total.meta_key='_order_total' ";
						
				$query .= " AND posts.post_status IN ('wc-pending','wc-processing','wc-on-hold', 'wc-completed')
							
							";
				if ($period =="DAY"){		
					$query .= " AND   date_format( posts.post_date, '%Y-%m-%d') > DATE_SUB(date_format(NOW(), '%Y-%m-%d'), INTERVAL 1 DAY) "; 
				}
				if ($period =="WEEK"){		
					$query .= " AND   date_format( posts.post_date, '%Y-%m-%d') > DATE_SUB(date_format(NOW(), '%Y-%m-%d'), INTERVAL 1 WEEK) "; 
				}
				if ($period =="MONTH"){		
					$query .= " AND   date_format( posts.post_date, '%Y-%m-%d') > DATE_SUB(date_format(NOW(), '%Y-%m-%d'), INTERVAL 1 MONTH) "; 
				}
				if ($period =="YEAR"){		
					$query .= " AND YEAR(date_format( posts.post_date, '%Y-%m-%d')) = YEAR(date_format(NOW(), '%Y-%m-%d')) "; 
				}
				
				
				//echo $query;		
						
				//$query .=" AND   date_format( posts.post_date, '%Y-%m-%d') BETWEEN '{$start_date}' AND '{$end_date}'";
						
				$results = $wpdb->get_var($query);
				$results = isset($results) ? $results : "0";
				return $results;
			}
			function get_total_sales_count($period="CUSTOM",$start_date=NULL,$end_date=NULL){
				global $wpdb;	
				$query = "SELECT
						count(order_total.meta_value)as 'sales_count'
						FROM {$wpdb->prefix}posts as posts			
						LEFT JOIN  {$wpdb->prefix}postmeta as order_total ON order_total.post_id=posts.ID 
						
						WHERE  1 = 1
						AND posts.post_type ='shop_order' 
						AND order_total.meta_key='_order_total' ";
						//if ($start_date!=NULL && $end_date!=NULL)
						//$query .=" AND   date_format( posts.post_date, '%Y-%m-%d') BETWEEN '{$start_date}' AND '{$end_date}'";
				$query .= " AND posts.post_status IN ('wc-pending','wc-processing','wc-on-hold', 'wc-completed') ";
				
				if ($period =="DAY"){		
					$query .= " AND   date_format( posts.post_date, '%Y-%m-%d') > DATE_SUB(date_format(NOW(), '%Y-%m-%d'), INTERVAL 1 DAY) "; 
				}
				if ($period =="WEEK"){		
					$query .= " AND   date_format( posts.post_date, '%Y-%m-%d') > DATE_SUB(date_format(NOW(), '%Y-%m-%d'), INTERVAL 1 WEEK) "; 
				}
				if ($period =="MONTH"){		
					$query .= " AND   date_format( posts.post_date, '%Y-%m-%d') > DATE_SUB(date_format(NOW(), '%Y-%m-%d'), INTERVAL 1 MONTH) "; 
				}
				if ($period =="YEAR"){		
					$query .= " AND YEAR(date_format( posts.post_date, '%Y-%m-%d')) = YEAR(date_format(NOW(), '%Y-%m-%d')) "; 
				}
				//echo $query;
				$results = $wpdb->get_var($query);	
				$results = isset($results) ? $results : "0";	
				return $results;
			}
			function get_recent_order_list(){
				global $wpdb;
				$query = "SELECT
					posts.ID as order_id
					,posts.post_status as order_status
					
					, date_format( posts.post_date, '%Y-%m-%d') as order_date 
					
					FROM {$wpdb->prefix}posts as posts			
					
					WHERE 
							posts.post_type ='shop_order' 
							
							AND posts.post_status IN ('wc-pending','wc-processing','wc-on-hold', 'wc-completed' ,'wc-cancelled' ,  'wc-refunded' ,'wc-failed')
							
							";
				$query .= " order by posts.post_date DESC";	
				$query .= " LIMIT 10 ";
				$order_data = $wpdb->get_results( $query);	
				if(count($order_data)> 0){
					foreach($order_data as $k => $v){
						
						/*Order Data*/
						$order_id =$v->order_id;
						$order_detail = $this->get_order_detail($order_id);
						foreach($order_detail as $dkey => $dvalue)
						{
								$order_data[$k]->$dkey =$dvalue;
							
						}
						
					}
				}
				else
				{
					echo "No Record Found";
				}
				return $order_data;
			}
			function get_order_status($start_date = NULL, $end_date= NULL ){
				global $wpdb;
				$query = "
					SELECT 
					posts.ID as order_id
					,posts.post_status as order_status
					,date_format( posts.post_date, '%Y-%m-%d') as order_date 
					,SUM(postmeta.meta_value) as 'order_total'
					,count(posts.post_status) as order_count
					FROM {$wpdb->prefix}posts as posts	";		
					
				$query .=
					"	LEFT JOIN  {$wpdb->prefix}postmeta as postmeta ON postmeta.post_id=posts.ID ";
				
				$query .= " WHERE 1=1 ";
				
				if ($start_date && $end_date)	
				
				$query .= " AND date_format( posts.post_date, '%Y-%m-%d') BETWEEN  '{$start_date}' AND '{$end_date}'";	
				
				
				
				$query .= " AND postmeta.meta_key ='_order_total' ";
				$query .= " AND posts.post_type ='shop_order' ";
				
				$query .= " GROUP BY posts.post_status ";
				
				
				$results = $wpdb->get_results( $query);	
				return $results;
			}
			function get_payment_gateway(){
				global $wpdb;	
				$query = "
					SELECT 
					payment_method_title.meta_value as 'payment_method_title'
					
					,SUM(order_total.meta_value) as 'order_total'
					,count(*) as order_count
					FROM {$wpdb->prefix}posts as posts	";		
					
			
					
				$query .= "	LEFT JOIN  {$wpdb->prefix}postmeta as order_total ON order_total.post_id=posts.ID ";
				
				$query .= "	LEFT JOIN  {$wpdb->prefix}postmeta as payment_method_title ON payment_method_title.post_id=posts.ID ";
				
				
				$query .=	"WHERE 1=1 ";
					
				$query .= " AND posts.post_type ='shop_order' ";
				$query .= " AND order_total.meta_key ='_order_total' ";
				$query .= " AND payment_method_title.meta_key ='_payment_method_title' ";
				$query .= " GROUP BY payment_method_title.meta_value";
				
				$data = $wpdb->get_results($query);	
				
				return $data;	
			}
			function get_order_detail($order_id){
				$order_detail	= get_post_meta($order_id);
				$order_detail_array = array();
				foreach($order_detail as $k => $v)
				{
					$k =substr($k,1);
					$order_detail_array[$k] =$v[0];
				}
				return 	$order_detail_array;
			}
		
		
	}
}
?>